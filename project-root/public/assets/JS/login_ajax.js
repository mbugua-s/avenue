$(document).ready(function()
{
    $("#login").submit(function (event)
    {
        event.preventDefault()
        var login_email = document.getElementById("login_email").value
        var login_password = document.getElementById("login_password").value

        $.post("/app/Controllers/User.php", {
            login_email: login_email,
            login_password: login_password,
        }, function(incorrectCredentials)
        {
            if(incorrectCredentials)
            {
                alert("Incorrect Credentials");
            }
        })
    })
})