<?php
class User {
    public $username;
    public $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public static function authenticate($username, $password) {
        $usersData = file_get_contents('data/users.json');
        $usersArray = json_decode($usersData, true);

        foreach ($usersArray as $user) {
            if ($user['username'] == $username && $user['password'] == $password) {
                return true;
            }
        }
        return false;
    }
}
