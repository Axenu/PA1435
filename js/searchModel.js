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
    }
}
