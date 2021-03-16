// Wait until the DOM is ready before executing any JS
$(document).ready(function ()
{
    // Attempt to create the user account when the sign up button is pressed
    $("#signupSubmitButton").click(function ()
    {
        /*
        Access the GET parameter from the URL instead of setting a JS variable in the signup.php file

        Code taken from:
        https://stackoverflow.com/questions/5448545/how-to-retrieve-get-parameters-from-javascript#answer-5448595
         */
        let offer = null;
        let tmp = [];

        location.search
            .substr(1)
            .split("&")
            .forEach(function (item)
            {
                tmp = item.split("=");
                offer = decodeURIComponent(tmp[1]);
            });

        // Send an AJAX call to create the account and increment the offer signups if offer is set
        $.ajax({
            url: "assets/php/create_account.php",
            type: "POST",
            data: {
                "username": $("#username").val(),
                "password": $("#password").val(),
                "offer": offer

            },
            success: function (result)
            {
                alert(result);
                window.location.href = "login.php";
            }
        });
    })
});