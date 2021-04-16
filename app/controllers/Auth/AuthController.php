<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

class AuthController
{
    protected $pageTitle;

    public function index()
    {
        if (Auth::isAuthenticated()) {
            redirect('home');
        }

        $pageTitle = "Login";
        return view('auth/login', compact('pageTitle'));
    }

    public function authenticate()
    {
        $request = Request::validate('login', [
            'username' => 'required',
            'password' => 'required'
        ]);

        $userDdata = App::get('database')->select("*", "users", "username = '$request[username]' AND password = md5('$request[password]')");

        Auth::authenticate($userDdata);
    }

    public function logout()
    {
        session_destroy();
        redirect('login');
    }

    public function forgotPassword()
    {
        if (Auth::isAuthenticated()) {
            redirect('home');
        }

        $pageTitle = "Forgot Password";
        return view('auth/forgot-password', compact('pageTitle'));
    }

    public function sendResetLink()
    {
        $request = Request::validate('forgot/password', [
            'reset-email' => 'required',
        ]);

        $isEmailExist = App::get('database')->select("*", "users", "email = '" . $request['reset-email'] . "'");

        if (!$isEmailExist) {
            redirect('forgot/password', ['E-mail not found in the server.', 'danger']);
        } else {

            $token = md5(randChar('10'));

            $subject = "Sprnva password reset link";
            $emailTemplate = file_get_contents(__DIR__ . '/../../../system/Email/stubs/email.stubs');

            $app_name = ["{{app_name}}", "{{username}}", "{{link_token}}", "{{year}}"];
            $values = [App::get('config')['app']['name'], $isEmailExist['fullname'], "localhost/sprnva/reset/password/" . $token, date('Y')];
            $body_content = str_replace($app_name, $values, $emailTemplate);

            $body = $body_content;
            $isSent = sendMail($subject, $body, $request['reset-email']);

            if ($isSent[1] == "success") {
                $insertData = [
                    'email' => $request['reset-email'],
                    'token' => $token,
                    'created_at' => date("Y-m-d H:i:s")
                ];
                App::get('database')->insert('password_resets', $insertData);
            }

            redirect('forgot/password', $isSent);
        }
    }

    public function resetPassword($token)
    {
        $pageTitle = "Reset Password";
        return view('auth/password-reset', compact('pageTitle', 'token'));
    }

    public function passwordStore()
    {
        $request = Request::validate('reset/password/' . $_POST['token'], [
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        $isTokenLegit = App::get('database')->select("email", "password_resets", "token = '$request[token]'");
        if ($isTokenLegit) {
            if ($request["new_password"] == $request["confirm_password"]) {
                $reset_password = [
                    'password' => md5($request['new_password']),
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                App::get('database')->update("users", $reset_password, "email = '$isTokenLegit[email]'");
                App::get('database')->delete("password_resets", "email = '$isTokenLegit[email]' AND token = '$request[token]'");
                redirect('login', ["Success reset password", "success"]);
            } else {
                redirect('reset/password/' . $request['token'], ["Passwords must match.", "danger"]);
            }
        } else {
            redirect('reset/password/' . $request['token'], ["Token is not authorized.", "danger"]);
        }
    }
}
