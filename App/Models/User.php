<?php

include_once("Orm.php");

class User extends Orm
{

    public function __construct()
    {
        parent::__construct('users');
        if (!isset($_SESSION['id_user'])) {
            $_SESSION['id_user'] = 1;
            $adminUser = $this->getByUsername('admin');
            $actual_time = new DateTime();

            if (!$adminUser) {
                $adminUserData = array(
                    "id_user" => 0,
                    "name" => 'ADMIN',
                    "username" => "admin",
                    "mail" => 'admin@admin.com',
                    "birthdate" => $actual_time,
                    "points" => 0,
                    "profile_image" => "angel.jpg",
                    "password" => 1234,
                    "timeRegister" => $actual_time,

                );

                $this->create($adminUserData);
            }
        }
    }
    public function getByUsername($username)
    {
        foreach ($_SESSION[$this->model] as $user) {
            if ($user['username'] == $username) {
                return $user;
            }
        }
        return null;
    }
    public function getByMail($mail)
    {
        foreach ($_SESSION[$this->model] as $user) {
            if ($user['mail'] == $mail) {
                return $user;
            }
        }
        return null;
    }
    public function validateUser($name, $username, $mail, $birthdate, $password)
    {
        if (!isset($name) && !isset($username) && !isset($mail) && !isset($birthdate) && !isset($password)) {
            return "Has d'omplir totes les dades";
        }
        $exisitngUser = $this->getByUsername($username);
        if ($exisitngUser !== null) {
            return "L'usauri ja existeix";
        }
        $exitingMail = $this->getByMail($mail);
        if ($exitingMail !== null) {
            return "El correu ja està registrat";
        }
        $currenDate = new DateTime();
        $birthdate = new DateTime($birthdate);
        if ($birthdate > $currenDate) {
            return "La data no pot ser futura a l'actual";
        }
        $difEdat = $currenDate->diff($birthdate);
        $age = $difEdat->y;
        if ($age < 18) {
            return "L'usuari ha de ser major d'edat (més de 18 anys)";
        }
        if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password)) {
            return "La contrassenya no compleix els minims: Més de 8 caracters, una mayus, una minus, un numero.";
        }
        return null;
    }

    public function validateUserLogin($username, $pass)
    {
        foreach ($_SESSION[$this->model] as $users) {
            if ($users['username'] == $username && $users['password'] == $pass) {
                return $users;
            }
        }
        return null;
    }
    public function deleteById($id)
    {
        foreach ($_SESSION[$this->model] as $key => $value) {
            if ($value['id_user'] == $id) {
                unset($_SESSION[$this->model][$key]);
                return true;
            }
        }
        return null;
    }
    public function getUserById($id)
    {
        foreach ($_SESSION[$this->model] as $u) {
            if ($u['id_user'] == $id) {
                return $u;
            }
        }
        return null;
    }
    public function updateUser($user)
    {
        foreach ($_SESSION[$this->model] as $key => $value) {
            if ($value['username'] == $user['username']) {
                $_SESSION[$this->model][$key] = $user;
                return  $_SESSION[$this->model][$key];
            }
        }
        return null;
    }
 
}
