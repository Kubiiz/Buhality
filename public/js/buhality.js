let run;

// Add new player input field
function player(text) {
    const player = $(".player_list").find(".input_player");

    // Can't add new player inputs more than 10
    if (player.length <= 9) {
        const add_player =
            '<div class="input_player">' +
                '<input type="text" class="form-control" name="player[]">' +
                '<span class="label label-danger pull-right remove" onclick="player_remove(this);">' + text + '</span>' +
            '</div>';

        $("#show_players").append(add_player);
    }
}

// Remove player input field
function player_remove(value) {
    const player = $(".player_list").find(".input_player");

    // If player input fields aren't below two, allowed to remove
    if (player.length > 2) {
        const parent = value.parentNode;

        if (parent.nextElementSibling && parent.nextElementSibling.className != 'input_player')
            parent.nextElementSibling.remove();

        value.parentNode.remove();
    }
}

//  Run the game and waiting for the actions
function game() {
    $.getJSON(base + "game/action", function (data) {
        const display = $(".random").html(data.display).show();
        const count = data.count;

        // Game is stopped.
        if (data.stop) {
            // Play an audio if necessary
            if (data.audio.length) {
                new Audio(base + 'audio/' + data.audio + '.mp3').play();
            }

            // Display random player and action
            display;
            stop_game();
        } else {
            display.delay(2000).fadeOut("slow");
        }

        // Update player count
        count.forEach((e) => {
            $("#memb_" + e.id).text(e.count);
        });
    });
}

// Set the game to refresh every 3sec
function set_game() {
    clearInterval(run);
    game();
    run = setInterval(game, 3000);

    $(".pause").show();
}

// After coutdown start the game
function run_game() {
    $(".reset").hide();
    $(".continue").hide();
    $(".random").hide();
    $("#pause").hide();

    // Countdown
    $('.random').fadeOut('slow', function(){
        $(this).html(3).show().fadeOut('slow', function(){
            $(this).html(2).show().fadeOut('slow', function(){
                $(this).html(1).show().fadeOut('slow', function(){
                    set_game();
                });
            });
        });
    });
}

// Pause the game
function pause_game(act) {
    $(".pause").hide();
    $(".random").hide();
    $("#pause").fadeIn("slow");
    $(".continue").show();

    clearInterval(run);
}

// Stop the game
function stop_game() {
    $(".reset").show();
    $(".pause").hide();
    $("#pause").fadeOut("slow");
    clearInterval(run);
}

// Start next round
function next_round() {
    $(".reset").hide();
    $(".random").hide();
    $(".refresh").text(0);

    set_game();
}

// Reset players count (except shots)
function reset_counter() {
    $.get(base + 'game/reset', function (data) {
        if (data) {
            stop_game();
            $(".memb_counter .shots").text(0);
            run_game();
        }
    });
}

// Refresh game statistics and show modal (shots)
$("#update_stats").click(function(){
    $.get(base + 'game/stats', function (data) {
        if (data) {
            $('#show_stats').html(data);
        }
    });
});

// Hide alcohol use warning in page bottom
$("#alko .close").click(function(){
    if (!sessionStorage.getItem("alko")) {
        sessionStorage.setItem("alko", true);
        $("#alko").hide();
    }
});

$(document).ready(function () {
    // Check if user is in /game page and start new game
    if (window.location.pathname == "/game" || window.location.pathname == "/game/") {
        run_game();
    }

    // Check if exists session "alko" and remove text about alcohol usage
    if (sessionStorage.getItem("alko")) {
        $("#alko").hide();
    }
});
