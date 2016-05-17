

function checkAvailability(element) {
    var i = $(element).attr('id');
    var num = $('.numberOfPlayers').val();
    window.location.href = "/bookingView.php?date="+i+"&num="+num;
}

function checkAvailabilityGame(element, game_id, date_id, num) {
    // console.log(game_id);
    // console.log(date_id);
    window.location.href = "/bookingView.php?date="+date_id+"&game="+game_id+"&num="+num;
}

function prepareBooking(element, game_id, date_id, acc_id, num) {
    var mentor = $('.selectMentor').is(':checked');
    window.location.href = "/bookingView.php?date="+date_id+"&game="+game_id+"&num="+num+"&acc="+acc_id+"&mentor="+mentor;
    //login or use guest
}

function confirmBooking(element, game_id, date_id, acc_id, user_id, men, num) {
    console.log('test');
    var mentor = 0;
    if (men == 'true') {
        mentor = 1;
    }

    $.ajax({ url: '/phpModel/bookingModel.php',
        data: {game_id: game_id,
        date_id: date_id,
        acc_id: acc_id,
        user_id: user_id,
        mentor: mentor,
        num: num},
        type: 'post',
        success: function(output) {
            console.log(output);
            window.location.href = "/bookingView.php?confirm=1";
    	}
	});
}

function removeBooking(b_id) {
    if (confirm("Ary you sure you want to remove booking?")) {
        $.ajax({ url: '/phpModel/removeBookingModel.php',
            data: {b_id: b_id},
            type: 'post',
            success: function(output) {
                // console.log(output);
                window.location.href = "/userView.php";
        	}
    	});
    }
}
