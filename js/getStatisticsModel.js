function calculateTotal() {

    var start = -1;
    var end = -1;

    $.ajax({ url: '/phpModel/getStatisticsModel.php',
        data: {action: 'totalIncome',
               py: $('.py').val(),
               pm: $('.pm').val(),
               pd: $('.pd').val(),
               ph: $('.ph').val(),
               ny: $('.ny').val(),
               nm: $('.nm').val(),
               nd: $('.nd').val(),
               nh: $('.nh').val()
           },
        type: 'post',
        success: function(output) {
            console.log(output);
        }
    });

}
