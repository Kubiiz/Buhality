let i = 0;
var run;

function add_member() {
    i++;
    const player = $(".form-group").find(".m").length;

    if (player > 9) alert("Nevar būt vairāk par 10 dalībniekiem!");
    else {
        let add_player = '<div id="d_' + i +'" class="m"><input type="text" class="form-control" name="d[]"><span class="label label-danger pull-right" onclick="javascript:remove_member(' + i + ');">Noņemt</span></div>';

        $("#show_members").append(add_player);
    }
}
function remove_member(value) {
    $("#d_" + value).remove();
}

function add_player(value) {
    i++;
    const player = $(".form-group").find(".m").length;

    if (player > 9) alert("Nevar būt vairāk par 10 dalībniekiem!");
    else {
        let add_player = '<div id="' + value + i +'" class="m"><input type="text" class="form-control" name="' + value + '[]"><span class="label label-danger pull-right" onclick="javascript:remove_member(' + value + i + ');">Noņemt</span></div>';
        console.log('Added new edit player input: ' + value + i);
        $("#show_players").append(add_player);
    }
}
function remove_player(value) {
    $("#" + value).remove();
}

function game() {
    $.get(base + "game/action", function (result) {
        const data = jQuery.parseJSON(result);
        const display = $(".random").html(data.display).show();
        const count = data.count;
        //console.log(data.random);

        if (data.stop) {
            if (data.audio.length) {
                new Audio(base + 'audio/' + data.audio + '.mp3').play();
                //console.log('Play.. ' + data.audio);
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
