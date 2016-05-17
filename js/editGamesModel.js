function SelectGame(game) {

    $('.selectedGame').removeClass('selectedGame');
    $(game).addClass('selectedGame');

}

function displayAddGameForm() {
    if ($("#contain").find(".gameForm").length) {
        $('.gameForm').remove();
    }
	$("#contain").append('<form method="post" class="gameForm" action="phpModel/editGamesModel.php" enctype="multipart/form-data"></form>');
    $(".gameForm").append('<input autofocus="autofocus" maxlength="100" autocomplete="off" type="text" name="title" id="title" placeholder="Title">');
    $(".gameForm").append('<input autocomplete="off" type="text" name="description" placeholder="Description" id="description">');
    $(".gameForm").append('<input type="file" name="fileToUpload" id="fileToUpload">');
    $(".gameForm").append('<input type="hidden" name="action" id="action" value="add">');
    $(".gameForm").append('<input type="submit" value="Save">');
    $(".gameForm").append('<input type="button" onclick="cancel()" value="Cancel">');
}

function displayEditGameForm() {
    if (!$('.selectedGame').length) {
        alert("You have not selected any game");
        return;
    }
    if ($("#contain").find(".gameForm").length) {
        $('.gameForm').remove();
    }
    var selected = $('.selectedGame');
    $("#contain").append('<form method="post" class="gameForm" action="phpModel/editGamesModel.php" enctype="multipart/form-data"></form>');
    $(".gameForm").append('<input autofocus="autofocus" maxlength="100" autocomplete="off" type="text" name="title" id="title" placeholder="Title" value="'+selected.find('h3').text()+'">');
    $(".gameForm").append('<input autocomplete="off" type="text" name="description" placeholder="Description" id="description" value="'+selected.find('p').text()+'">');
    // $(".gameForm").append('<input type="file" name="fileToUpload" id="fileToUpload">');
    $(".gameForm").append('<input type="hidden" name="action" id="action" value="edit">');
    $(".gameForm").append('<input type="hidden" name="game_id" id="game_id" value="'+selected.attr('id')+'">');
    $(".gameForm").append('<input type="submit" value="Save">');
    $(".gameForm").append('<input type="button" onclick="cancel()" value="Cancel">');
}

function deleteSelected() {
    if (!$('.selectedGame').length) {
        alert("You have not selected any game");
        return;
    }
    if (confirm("Are you sure you want to delete "+$('.selectedGame').find('h3').text())) {
        $.ajax({ url: '/phpModel/editGamesModel.php',
            data: {action: 'delete',
                   game_id: $('.selectedGame').attr('id')},
            type: 'post',
            success: function(output) {
                window.location.href = "/editGamesView.php";
            }
        });
    }
}

function cancel() {
    $('.gameForm').remove();
}
