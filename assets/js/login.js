// Wait until the DOM is ready before executing any JS
$(document).ready(function ()
{
    // Attempt to log the user in when they press the login button
    $("#loginSubmitButton").click(function ()
    {
        $.ajax({
            url: 'assets/php/UserService.php',
            type: 'POST',
            data: {
                'username': $("#username").val(),
                'password': $("#password").val()
            },
            success: function (result) {
                // Redirect if successful otherwise display an error
                if (result === "Success")
                    window.location.href = "index.php";
                else
                    alert(result);
            },
            error: function () {
                pass;
            }
        });
    })
});