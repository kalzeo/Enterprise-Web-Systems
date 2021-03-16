<?php

require "Database Functions.php";

/**
 * Class User.
 * Self explanatory.
 */
class User
{
    private int $_id;
    private string $_username;
    private string $_permission;

    /**
     * User constructor.
     * Fetches the details of a user from the database based on the username.
     *
     * @param $username - The username of the user that will have it's details outputted from the database.
     */
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
                $this->_id = $row->id;
                $this->_username = $row->username;
                $this->_permission = $row->permission;
            }
        }
    }

    /**
     * Display the username of a User object.
     * @return mixed - Returns the username.
     */
    public function GetUsername()
    {
        return $this->_username;
    }

    /**
     * Display the permission of a User object.
     * @return mixed - Returns the permission.
     */
    public function GetPermission()
    {
        return $this->_permission;
    }

    /**
     * Display the ID of a User object.
     * @return mixed - Returns the ID.
     */
    public function GetID()
    {
        return $this->_id;
    }
}