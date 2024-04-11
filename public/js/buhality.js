let run;

function player() {
    const player = $(".player_list").find(".input_player");

    if (player.length <= 9) {
        const add_player =
            '<div class="input_player">' +
                '<input type="text" class="form-control" name="player[]">' +
                '<span class="label label-danger pull-right" onclick="player_remove(this);">Noņemt</span>' +
            '</div>';

        $("#show_players").append(add_player);
    }
}

function player_remove(value) {
    const player = $(".player_list").find(".input_player");

    if (player.length > 2) {
        const parent = value.parentNode;

        if (parent.nextElementSibling.className == 'help-block')
            parent.nextElementSibling.remove();

        value.parentNode.remove();
    }
}

function game() {
    $.get(base + "game/action", function (result) {
        const data = jQuery.parseJSON(result);
        const display = $(".random").html(data.display).show();
        const count = data.count;

        if (data.stop) {
            if (data.audio.length) {
                new Audio(base + 'audio/' + data.audio + '.mp3').play();
            }

            display;
            stop_game();
        } else {
            display.delay(2000).fadeOut("slow");
        }

        if (Array.isArray(data.count)) {
            count.forEach((e) => {
                $("#memb_" + e.id).text(e.count);
            });
        } else {
           $("#memb_" + data.player).text(data.count);
        }
    });
}

function set_game() {
    clearInterval(run);
    game();
    run = setInterval(game, 3000);

    $(".pause").show();
}

function run_game() {
    $(".reset").hide();
    $(".continue").hide();
    $(".random").hide();
    $("#pause").hide();

    $('.random').fadeOut('slow', function(){
        $(this).html(3).show().fadeOut('slow', function(){
            $(this).html(2).show().fadeOut('slow', function(){
                $(this).html(1).show().fadeOut('slow', function(){
                    set_game();
                });
            });
        });
    });
    //console.log("Starting game");
}

function pause_game(act) {
    $(".pause").hide();
    $(".random").hide();
    $("#pause").fadeIn("slow");
    $(".continue").show();

    clearInterval(run);
    //console.log("Game paused");
}

function stop_game() {
    $(".reset").show();
    $(".pause").hide();
    clearInterval(run);
    //console.log("Game paused. Waiting for action..");
}

function next_round() {
    $(".reset").hide();
    $(".random").hide();
    $(".refresh").text(0);

    set_game();
    //console.log("Next round");
}

function reset_counter() {
    $.get(base + 'game/reset', function (data) {
        if (data) {
            stop_game();
            $(".memb_counter .shots").text(0);
            run_game();
            //console.log("Counter resets.");
        }
    });
}

$("#update_stats").click(function(){
    $.get(base + 'game/stats', function (data) {
        if (data) {
            $('#show_stats').html(data);
            //console.log("Update statistics");
        }
    });
});

$(document).ready(function () {
    if (window.location.pathname == "/game") {
        run_game();
    }

    $("#rules").modal("hide");
});
