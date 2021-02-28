$(document).ready(function ()
{
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