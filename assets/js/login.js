// Wait until the DOM is ready before executing any JS
$(document).ready(function()
{
    // Attempt to login in the user when the submit button is pressed on the login page
    $("#loginSubmitButton").click(function()
    {
        $.ajax({
            url: 'assets/php/UserService.php',
            type: 'POST',
            data: {
                'username': $("#username").val(),
                'password': $("#password").val()
            },
            success: function(result)
            {
                if(result === "Success")
                    window.location.href = "index.php";
                else
                    alert("Invalid Credentials");
            },
            error: function()
            {
                pass;
            }
        });
    })
});