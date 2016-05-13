function searchStringChnged() {
    if ($('.searchBar').val() != '') {
        $.ajax({ url: '/phpModel/searchModel.php',
            data: {action: 'search',
                   query: $('.searchBar').val()},
            type: 'post',
            success: function(output) {
                $('.searchResulContainer').html(output);
            }
        });
    } else {
        $('.searchResulContainer').html("");
    }
}

function showResults(senderObj) {
    var query = $(senderObj).text()
    window.location.href = "/searchView.php?query="+query;
}
