$(function()
{
    var $registerForm = $("#register");

    if($registerForm.length)
    {
        $registerForm.validate
        ({
            rules:
            {
                reg_email:
                {
                    required: true
                },

                reg_firstname:
                {
                    required: true
                },

                reg_lastname:
                {
                    required: true
                },

                reg_ini_password:
                {
                    required: true
                },

                reg_password:
                {
                    required: true,
                    equalTo: "#reg_ini_password"
                },

                reg_gender:
                {
                    required: true
                },

                reg_usertype:
                {
                    required: true
                }
            },

            messages:
            {
                reg_email:
                {
                    required: 'Please add an email address'
                },

                reg_firstname:
                {
                    required: 'Please add your first name'
                },

                reg_lastname:
                {
                    required: 'Please add your last name'
                },

                reg_ini_password:
                {
                    required: 'Please key in a password'
                },

                reg_password:
                {
                    required: 'Please confirm your password',
                    equalTo: "Passwords don't match"
                },

                reg_gender:
                {
                    required: 'Please choose a gender'
                },

                reg_usertype:
                {
                    required: 'Please choose a usertype'
                }
            },

            errorElement: "em",
        })
    }
})

$(function()
{
    var $loginForm = $("#login");

    if($loginForm.length)
    {
        $loginForm.validate
        ({
            rules:
            {
                login_email:
                {
                    required: true
                },

                login_password:
                {
                    required: true
                }
            },

            messages:
            {
                login_email:
                {
                    required: 'Input an email address'
                },
                
                login_password:
                {
                    required: 'Input a password'
                }
            },

            errorElement: "em",
        })
    }
})