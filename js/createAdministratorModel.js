function SelectUser(game) {

    $('.selectedUser').removeClass('selectedUser');
    $(game).addClass('selectedUser');

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
    $(".gameForm").append('<p>Birth Date: </p><input type="text" name="birth" placeholder="Birthdate" autocomplete="birth" id="birth"/>');
    $(".gameForm").append('<p>Role: </p><select name="role" id="role"><option value="0">User<option value="1">Employe<option value="2">Manager</select>');
    $(".gameForm").append('<input type="hidden" name="action" id="action" value="add">');
    $(".gameForm").append('<input type="button" value="Register" class="submit" onclick="return regformhash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" />');
    $(".gameForm").append('<input type="button" onclick="cancel()" value="Cancel">');

}

function displayEditUserForm() {

if (!$('.selectedUser').length) {
    alert("You have not selected any user");
    return;
}
    $.ajax({ url: '/phpModel/createAdministratorModel.php',
        data: {action: 'getInfo',
               user_id: $('.selectedUser').attr('id')},
        type: 'post',
        success: function(output) {
            var info = JSON.parse(output);
            if ($("#contain").find(".gameForm").length) {
                $('.gameForm').remove();
            }
            var selected = $('.selectedUser');
            $("#contain").append('<form method="post" class="gameForm" action="phpModel/createAdministratorModel.php" enctype="multipart/form-data"></form>');
            $(".gameForm").append('<p>Username: </p><input type="text" name="username" id="username" placeholder="Username" value="'+info.username+'"/>');
            $(".gameForm").append('<p>Email: </p><input type="text" name="email" id="email" placeholder="Email" value="'+info.email+'"/>');
            $(".gameForm").append('<p>Password: </p><input type="password" name="password" id="password" placeholder="Password"/>');
            $(".gameForm").append('<p>Repeat password: </p><input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password"/>');
            $(".gameForm").append('<p>First Name: </p><input type="text" name="firstName" id="firstName" placeholder="First Name" autocomplete="firstName" value="'+info.fname+'"/>');
            $(".gameForm").append('<p>Last Name: </p><input type="text" name="lastName" id="lastName" placeholder="Last Name" autocomplete="lastName" value="'+info.lname+'"/>');
            $(".gameForm").append('<p>Address: </p><input type="text" name="address" placeholder="Address" autocomplete="address" id="address" value="'+info.address+'"/>');
            $(".gameForm").append('<p>City: </p><input type="text" name="city" placeholder="City" autocomplete="city" id="city" value="'+info.city+'"/>');
            $(".gameForm").append('<p>Postal code: </p><input type="text" name="postnr" placeholder="postal code" autocomplete="postnr" id="postnr" value="'+info.pcode+'"/>');
            $(".gameForm").append('<p>Birth Date: </p><input type="text" name="birth" placeholder="Birthdate" autocomplete="birth" id="birth" value="'+info.birth+'"/>');
            $(".gameForm").append('<p>Role: </p><select name="role" id="role"><option value="0">User<option value="1">Employe<option value="2">Manager</select>');
            $(".gameForm").find('select').val(info.perm);
            $(".gameForm").append('<input type="hidden" name="action" id="action" value="edit">');
            $(".gameForm").append('<input type="hidden" name="u_id" id="u_id" value="'+$('.selectedUser').attr('id')+'">');
            $(".gameForm").append('<input type="button" value="Save" class="submit" onclick="return updateFormHash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" />');
            $(".gameForm").append('<input type="button" onclick="cancel()" value="Cancel">');

        }
    });
}

function deleteSelected() {
    if (!$('.selectedUser').length) {
        alert("You have not selected any user");
        return;
    }
    if (confirm("Are you sure you want to delete "+$('.selectedUser').text())) {
        $.ajax({ url: '/phpModel/createAdministratorModel.php',
            data: {action: 'delete',
                   user_id: $('.selectedUser').attr('id')},
            type: 'post',
            success: function(output) {
                // console.log(output);
                window.location.href = "/createAdministratorView.php";
            }
        });
    }
}

function cancel() {
    $('.gameForm').remove();
}
