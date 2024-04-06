function add_member() {
    c++;
    var a = $(".form-group").find(".m").length;
    if (a > 9) alert("Nevar būt vairāk par 10 dalībniekiem!");
    else {
        var b =
            '<div id="d_' +
            c +
            '" class="m"><input type="text" class="form-control" name="d[]"><span class="label label-danger pull-right" onclick="javascript:remove_member(' +
            c +
            ');">Noņemt</span></div>';
        $("#show_members").append(b);
    }
}
function remove_member(a) {
    $("#d_" + a).remove();
}
var c = 0;
$(document).ready(function () {
    $("#rules").modal("hide");
});

var run;

function game() {
    $.get(base + "game/action", function (result) {
        let data = jQuery.parseJSON(result);
        const display = $(".random").html(data.display).show();

        console.log(data.random);

        if (data.stop) {
            display;
            stop_game();

            if (data.audio.length) {
                //new Audio(base + 'audio/' + data.audio + '.mp3').play();
                console.log('Play.. ' + data.audio);
            }

        } else {
            display.delay(2000).fadeOut("slow");
        }

        if (data.random == "inc_one" || data.random == "inc_two" || data.random == "dec_one" || data.random == "noone") {
            $("#memb_" + data.player).text(data.count);
        } else if (data.random == "inc_all") {
            //
        } else if (data.random == "bomb") {
            //
        } else {
            restart_game();
        }
    });
}

function set_game() {
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
    console.log("Starting game");
}

function pause_game(act) {
    $(".pause").hide();
    $(".random").hide();
    $("#pause").fadeIn("slow");
    $(".continue").show();

    clearInterval(run);
    console.log("Game paused");
}

function stop_game() {
    $(".reset").show();
    $(".pause").hide();
    clearInterval(run);
    console.log("Game paused. Waiting for action..");
}

function next_round() {
    $(".reset").hide();
    $(".random").hide();
    $(".refresh").text(0);

    set_game();

    console.log("Next round");
}

function restart_game() {
    stop_game();
    run_game();
    console.log("Restarting game");
}

$("#update_stats").click(function(){
    $.get(base + 'game/stats', function (data) {
        $('#show_stats').html(data);
        console.log("Update statistics");
    });
});

$(document).ready(function () {
    if (window.location.pathname == "/game") {
        run_game();
    }
});
