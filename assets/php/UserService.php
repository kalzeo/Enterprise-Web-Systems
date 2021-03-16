<?php
require_once "User.php";
require_once "Database Functions.php";

$userService = new UserService($_POST["username"], $_POST["password"]);
$userService->Login();

/**
 * Class UserService.
 * A class to handle logging a user into the web system. User credentials are validated to make sure inputs are
 * sanitized, have no errors, and are correct.
 */
class UserService
{
    private string $_username;
    private string $_password;

    /**
     * UserService constructor.
     * @param $username - The username of the account logging in.
     * @param $password - The password of the account logging in.
     */
    public function __construct($username, $password)
    {
        $this->_username = SanitizeString($username);
        $this->_password = hash("sha256", SanitizeString($password));
    }

    /**
     * Attempt to log the user in.
     *
     * If the credentials are correct then store a serialized User object in the session.
     */
    public function Login()
    {
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

    /**
     * Check the credentials of the user account are correct.
     * @return bool - Return true if correct otherwise False.
     */
    private function _CheckCredentials()
    {
        $result = SelectFromTable("heroku_7e12094ae71a8cd.users","*", "username = '{$this->_GetUsername()}' AND password = '{$this->_GetPassword()}'");
        return NumRows($result) != 0;
    }

    /**
     * Get the username currently set in the UserService object.
     * @return mixed|string - Returns the username.
     */
    private function _GetUsername()
    {
        return $this->_username;
    }

    /**
     * Get the password currently set in the UserService object.
     * @return string - Returns the password.
     */
    private function _GetPassword()
    {
        return $this->_password;
    }
}
