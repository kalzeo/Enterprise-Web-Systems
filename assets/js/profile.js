// Wait until the DOM is ready to execute the JS
$(document).ready(function ()
{
    // Delete a user account when the user presses the delete account button on their profile
    $("#delete_account_button").click(function ()
    {
        $.ajax({
            url: 'assets/php/delete_account.php',
            type: 'POST',
            data: {
                'user_id': userID
            },
            success: function ()
            {
                alert("Your account has been removed. You will now be redirected.")
                window.location.href = "login.php";
            }
        });
    });
});