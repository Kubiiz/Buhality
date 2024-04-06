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
    $('#memb_shots_' + data.player).text(Number($('#memb_shots_' + data.player).text()) + 1);
    $('.plus').hide();
    $('#memb_' + data.player).text(number);

    $.get( base + 'game/run?do=drink&member=' + data.id);

    stop_game();

    new Audio(base + 'audio/drink.mp3').play();
} else {
    $('.random').html(data.display).show().delay(2000).fadeOut('slow');
    $('#memb_' + data.player).text(number < 0 ? 0 : number);
}
