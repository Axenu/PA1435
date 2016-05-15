

function checkAvailability(element) {
    var i = $(element).attr('id');
    window.location.href = "/bookingView.php?date="+i+"&num=1";
}

function checkAvailabilityGame(element, game_id, date_id) {
    // console.log(game_id);
    // console.log(date_id);
    window.location.href = "/bookingView.php?date="+date_id+"&game="+game_id+"&num=1";
}

function prepareBooking(element, game_id, date_id, acc_id) {
    window.location.href = "/bookingView.php?date="+date_id+"&game="+game_id+"&num=1&acc="+acc_id;
    //login or use guest
}

function confirmBooking(element, game_id, date_id, acc_id, user_id, mentor, num) {
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
    	}
	});
}
