function calculateTotal() {

    var start = -1;
    var end = -1;

    var m = $('.pm').val();
    if (m < 10) {
        m = '0'+m;
    }
    var d = $('.pd').val();
    if (d < 10) {
        d = '0'+d;
    }
    var h = $('.ph').val();
    if (h < 10) {
        h = '0'+h;
    }
    start = $('.py').val()+m+d+h;
    m = $('.nm').val();
    if (m < 10) {
        m = '0'+m;
    }
    d = $('.nd').val();
    if (d < 10) {
        d = '0'+d;
    }
    h = $('.nh').val();
    if (h < 10) {
        h = '0'+h;
    }
    end = $('.ny').val()+m+d+h;
    if (end > start) {
        temp = end;
        end = start;
        start = temp;
    }

    $.ajax({ url: '/phpModel/getStatisticsModel.php',
        data: {action: 'totalIncome',
               ssum: start,
               lsum: end},
        type: 'post',
        success: function(output) {
            // console.log(output);
            $('.result12').html(output);
        }
    });

}

function userReport() {


    $.ajax({ url: '/phpModel/getStatisticsModel.php',
        data: {action: 'player',
               user: $('.user_name').val()},
        type: 'post',
        success: function(output) {
            console.log(output);
            $('.result3').html(output);
        }
    });


}
