function removeAccount(user_id) {
    if (confirm("Are you sure you want to delete your account?")) {
        $.ajax({ url: '/phpModel/removeAccount.php',
            data: {u_id: user_id},
            type: 'post',
            success: function(output) {
                console.log(output);
                window.location.href = "/index.php";
            }
        });
    }
}
