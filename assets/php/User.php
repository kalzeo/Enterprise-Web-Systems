<?php

require_once "Database Functions.php";

class User
{
    private $_username;
    private $_permission;
    private $_preservedUsername;

    public function __construct($username)
    {
        $this->_username = SanitizeString($username);
        $this->_FetchDetails();
    }

    private function _FetchDetails()
    {
        $result = SelectFromTable("heroku_7e12094ae71a8cd.users", "*", "username = '{$this->GetUsername()}'");
        if(NumRows($result) != 0)
        {
            while($row = mysqli_fetch_object($result))
            {
                $row = SanitizeRowObject($row);
                $this->_preservedUsername = $row->username;
                $this->_permission = $row->permission;
            }
        }
    }

    public function SetUsername($username)
    {
        $this->_username = $username;
    }


    public function SetPermission($permission)
    {
        $this->_permission = $permission;
    }


    public function GetUsername()
    {
        return $this->_username;
    }

    public function GetPreservedUsername()
    {
        return $this->_preservedUsername;
    }

    public function GetPermission()
    {
        return $this->_permission;
    }
}

class Admin extends User
{
    public function __construct($username)
    {
        parent::__construct($username);
    }
}
