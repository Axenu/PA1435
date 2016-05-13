function searchStringChnged() {
    if ($('.searchBar').val() != '') {
        $.ajax({ url: '/phpModel/searchModel.php',
            data: {action: 'search',
                   query: $('.searchBar').val()},
            type: 'post',
            success: function(output) {
                console.log(output);
                $('.searchResulContainer').html(output);
            }
        });
    } else {
        $('.searchResulContainer').html("");
    }
}

function showResults(senderObj) {
    console.log($(senderObj).text())
    var query = $(senderObj).text()
    window.location.href = "/searchView.php?query="+query;
}
