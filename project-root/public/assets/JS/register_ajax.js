$(document).ready(function()
{
    $("#register").submit(function (event)
    {
        event.preventDefault()
        var reg_email = document.getElementById("reg_email").value
        var reg_firstname = document.getElementById("reg_firstname").value
        var reg_lastname = document.getElementById("reg_lastname").value
        var reg_password = document.getElementById("reg_password").value
        var reg_gender = document.getElementsByName("reg_gender").value

        $.post("/app/Controllers/User.php", {
            reg_email: reg_email,
            reg_firstname : reg_firstname,
            reg_lastname: reg_lastname,
            reg_password: reg_password,
            reg_gender: reg_gender
        }, function(isRegistered)
        {
            if(!isRegistered)
            {
                alert("Registration Successfull")
            }
        })
    })
})