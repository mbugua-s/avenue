<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        $css = [
            'file_1' => 'user_login'
        ];

        $dynamic_details = [
            'files' => $css,
            'title' => 'Login'
        ];

        if($this -> request -> getMethod() == 'post')
        {
            $model = new UserModel();
            $email = $_POST['login_email'];
            $details = $model -> getUser($email);
            $hashed_password = $details['pass_word'];

            if(isset($details) && password_verify($_POST['login_password'], $hashed_password))
            {
                session_start();
                $_SESSION['firstName'] = $details['firstname'];
                $home = new Home();
                return $home->index();
            }

            else
            {
                $incorrectCredentials = true;
                return $incorrectCredentials;
            }
        }

        else
        {
            return view('login', $dynamic_details);
        }
    }

    public function register()
    {
        $css = [
            'file_1' => 'user_login'
        ];

        $dynamic_details = [
            'files' => $css,
            'title' => 'Register'
        ];

        if($this -> request -> getMethod() == 'post')
        {
            $model = new UserModel();
            $hashed_password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
            $data = [
                'email_address' => $_POST['reg_email'],
                'firstname' => $_POST['reg_firstname'],
                'lastname' => $_POST['reg_lastname'],
                'pass_word' => $hashed_password,
                'gender' => $_POST['reg_gender']
            ];

            if($model -> addUser($data))
            {
                session_start();
                $_SESSION['firstName'] = $_POST['reg_firstname'];
                $home = new Home();
                return $home->index();
            }

            else
            {
                $isRegistered = false;
                return $isRegistered;
            }
        }

        else
        {   
            return view('register', $dynamic_details);
        }
    }
}
