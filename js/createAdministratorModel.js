function SelectUser(game) {

    $('.selectedGame').removeClass('selectedGame');
    $(game).addClass('selectedGame');

}

function displayAddUserForm() {
    if ($("#contain").find(".gameForm").length) {
        $('.gameForm').remove();
    }
	$("#contain").append('<form method="post" class="gameForm" action="phpModel/createAdministratorModel.php" enctype="multipart/form-data"></form>');
    $(".gameForm").append('<p>Username: </p><input type="text" name="username" id="username" placeholder="Username"/>');
    $(".gameForm").append('<p>Email: </p><input type="text" name="email" id="email" placeholder="Email"/>');
    $(".gameForm").append('<p>Password: </p><input type="password" name="password" id="password" placeholder="Password"/>');
    $(".gameForm").append('<p>Repeat password: </p><input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password"/>');
    $(".gameForm").append('<p>First Name: </p><input type="text" name="firstName" id="firstName" placeholder="First Name" autocomplete="firstName"/>');
    $(".gameForm").append('<p>Last Name: </p><input type="text" name="lastName" id="lastName" placeholder="Last Name" autocomplete="lastName"/>');
    $(".gameForm").append('<p>Address: </p><input type="text" name="address" placeholder="Address" autocomplete="address" id="address"/>');
    $(".gameForm").append('<p>City: </p><input type="text" name="city" placeholder="City" autocomplete="city" id="city"/>');
    $(".gameForm").append('<p>Postal code: </p><input type="text" name="postnr" placeholder="postal code" autocomplete="postnr" id="postnr"/>');
    $(".gameForm").append('<p>Postal code: </p><input type="text" name="birth" placeholder="postal code" autocomplete="birth" id="birth"/>');
    $(".gameForm").append('<p>Role: </p><select name="role" id="role"><option value="0">User<option value="1">Employe<option value="2">Manager</select>');
    $(".gameForm").append('<input type="button" value="Register" class="submit" onclick="return regformhash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" />');
    $(".gameForm").append('<input type="button" onclick="cancel()" value="Cancel">');

}

function displayEditUserForm() {
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
