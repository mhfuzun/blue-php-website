
<?php

require_once __DIR__ . '/../core/Controller.php';

class RegisterController extends Controller {

    public function registerPage() {
        $this->view('pages/register', ['title' => 'Register']);
    }

    public function registerPost() {
        $nick = common::cleanInput($_POST['nick']);
        $username = common::cleanInput($_POST['username']);
        $email = common::cleanInput($_POST['email']);
        $password = common::cleanInput($_POST['password']);
        $password_confirm = common::cleanInput($_POST['password_confirm']);
        $termsCheck = common::getInputCheckbox('termsCheck');

        $error = true;
        $resion = "An Error Occours...";

        if (!$termsCheck) {
            $error = true;
            $resion = "Our terms must be accepted.";
        } else if (!UserManager::checkPasswordConfirmation($password, $password_confirm)) {
            $error = true;
            $resion = "Passwords do not match.";
        } else {
            $ret = $this->auth_service->createUser($nick, $username, $email, $password);

            if ($ret[0] === true) {
                $error = false;
                $resion = "Successfully registered. You can login now.";
            } else {
                $error = true;
                $resion = $ret[1];
            }
        }
        
        $this->view('pages/register', ['title' => 'Register', 'registrationError' => $error, 'resion' => $resion]);
    }
}

?>
