<?php
require_once "User.php";
require_once "Database Functions.php";

$userService = new UserService($_POST["username"], $_POST["password"]);
$userService->Login();

class UserService
{
    private $_username;
    private $_password;

    public function __construct($username, $password)
    {
        $this->_username = SanitizeString($username);
        $this->_password = hash("sha256", SanitizeString($password));
    }

    public function Login()
    {
        // put validation in for blanks
        if ($this->_CheckCredentials())
        {
            session_start();
            $user = new User($this->_GetUsername());
            $_SESSION["user"] = serialize($user);
            echo "Success";
        }
        else
        {
            echo "Invalid Credentials";
        }
    }

    private function _CheckCredentials()
    {
        $result = SelectFromTable("heroku_7e12094ae71a8cd.users","*", "username = '{$this->_GetUsername()}' AND password = '{$this->_GetPassword()}'");
        return NumRows($result) != 0;
    }

    private function _GetUsername()
    {
        return $this->_username;
    }

    private function _GetPassword()
    {
        return $this->_password;
    }
}
