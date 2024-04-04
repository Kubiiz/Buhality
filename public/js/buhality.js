function add_member(){c++;var a=$(".form-group").find(".m").length;if(a>9)alert("Nevar būt vairāk par 10 dalībniekiem!");else{var b='<div id="d_'+c+'" class="m"><input type="text" class="form-control" name="d[]"><span class="label label-danger pull-right" onclick="javascript:remove_member('+c+');">Noņemt</span></div>';$("#show_members").append(b)}}function remove_member(a){$("#d_"+a).remove()}var c=0;$(document).ready(function(){$("#rules").modal("hide")}),function(a,b,c,d,e,f,g){a.GoogleAnalyticsObject=e,a[e]=a[e]||function(){(a[e].q=a[e].q||[]).push(arguments)},a[e].l=1*new Date,f=b.createElement(c),g=b.getElementsByTagName(c)[0],f.async=1,f.src=d,g.parentNode.insertBefore(f,g)}(window,document,"script","https://www.google-analytics.com/analytics.js","ga"),ga("create","UA-28201819-1","auto"),ga("send","pageview");

var run;

function game(){
    $.get( base + 'game/run', function (result){
        var data = jQuery.parseJSON(result);
        var number = Number($('#memb_' + data.id).text()) + (data.plus == 3 ? 0 : data.plus);

        if (data.plus == 3) {
            $('.random').html(data.random).show();
            $('.counter span.shots').text(data.count);

            $('.memb_stats').each(function(i) {
                $(this).find('span').text(Number($(this).find('span').text()) + 1);
            });

            stop_game();

            $.get( base + 'game/run?do=bomba');

            new Audio(base + 'audio/bomba.mp3').play();
        } else if (data.plus == 4) {
            var i = -1, ids = [], member = [];

            $('.memb_counter').each(function() {
                i++;
                var num = Number($(this).find('span.shots').text()) + 1;
                $(this).find('span.shots').text(num);

                if (num >= data.count) {
                    ids.push(i);
                    member.push($(this).find('#memb').text());

                    $('#memb_shots_' + i).text(Number($('#memb_shots_' + i).text()) + 1);
                }
            });

            if (member.length > 0) {
                $.get( base + 'game/run?do=drink&member=' + ids.toString());

                $('.random').html('<span class="x2 text-primary">Dzer</span> ' + member.join(', ')).show();

                stop_game();

                new Audio(base + 'audio/drink.mp3').play();
            }
            else
                $('.random').html(data.random).show().delay(2000).fadeOut('slow');
        } else if (data.plus == 5) {
            $('.random').html(data.random).show().delay(2000).fadeOut('slow');
        } else if (number >= data.count) {
            $('.random').html('<span class="x2 text-primary">Dzer</span> ' + data.random).show();
            $('#memb_shots_' + data.id).text(Number($('#memb_shots_' + data.id).text()) + 1);
            $('.plus').hide();
            $('#memb_' + data.id).text(number);

            $.get( base + 'game/run?do=drink&member=' + data.id);

            stop_game();

            new Audio(base + 'audio/drink.mp3').play();
        } else {
            $('.random').html(data.random).show().delay(2000).fadeOut('slow');
            $('#memb_' + data.id).text(number < 0 ? 0 : number);
        }
    });
}

function run_game(){
    $('.reset').hide();
    $('.pause').show();
    $('.counter span.shots').text(0);

    game();
    run = setInterval(game, 3000);
}

function pause_game(act){
    if (act == true) {
        $('.pause').hide();
        $('.random').hide();
        $('#pause').fadeIn('slow');
        $('.continue').show();

        clearInterval(run);
    } else {
        $('.pause').show();
        $('#pause').hide();
        $('.continue').hide();

        game();
        run = setInterval(game, 3000);
    }
}

function stop_game(){
    $('.reset').show();
    $('.pause').hide();
    clearInterval(run);
}

$(document).ready(function(){
    if (window.location.pathname == '/game') {
        run_game();

        // $('.random').html(3).fadeOut('slow', function(){
        //     $(this).html(2).show().fadeOut('slow', function(){
        //         $(this).html(1).show().fadeOut('slow', function(){
        //             $(this).html('Sākam!').show().delay(1000).fadeOut('slow', function(){
        //                 run_game();
        //             });
        //         });
        //     });
        // });
    }
});

 window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-28201819-1');
