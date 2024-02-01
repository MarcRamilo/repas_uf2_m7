<?php
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/User.php");
include_once(__DIR__ . "../../Core/Store.php");
include_once(__DIR__ . "/../Core/Mailer.php");

class userController extends Controller
{
    public function home()
    {

        $params['title'] = 'Benvingut/da!';
        $userModel = new User;
        $params['users'] = $userModel->getAll();

        $this->render("user/home", $params, "site");
    }
    public function login()
    {
        $params["title"] = "Login d'usuari";
        $this->render("user/authenticate", $params, "site");
    }
    public function authenticate()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new User;
        $result = $userModel->validateUserLogin($username, $password);

        if ($result !== null) {
            $_SESSION['logged_user'] = $result;
            header('Location: /user/list');
        } else {
            $_SESSION['missatge_flash'] = "Credencials incorrectes";
            header('Location: /user/login');
        }
    }
    public function signup()
    {
        $params["title"] = "Registre d'usuari";
        $this->render("user/create", $params, "site");
    }
    public function store()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $birthdate = $_POST['date'];
        $points = 0;
        $password = $_POST['password'];
        $timeReigster = date('Y-m-d');

        $userModel = new User;

        $validateUser =  $userModel->validateUser($name, $username, $mail, $birthdate, $password);

        if ($validateUser !== null) {
            $_SESSION['missatge_flash'] = $validateUser;
            header('Location: /user/signup');
            return;
        }

        $origen = $_FILES['profile_image']['tmp_name'];
        $desti = "images/profile_images/";
        $array = explode(".", $_FILES['profile_image']['name']);
        $extensio = end($array);
        $nomFitxer = $username . "." . $extensio;

        $storeImage = Store::store($origen, $desti, $nomFitxer);


        if ($storeImage === false) {
            $_SESSION['missatge_flash'] = "No s'ha pogut carregar la imatge";
            header('Location: /user/signup');
            return;
        }
        $user = [
            "id_user" => $_SESSION['id_user']++,
            "name" => $name,
            "username" => $username,
            "mail" => $mail,
            "birthdate" => $birthdate,
            "points" => $points,
            "profile_image" => $nomFitxer,
            "password" => $password,
            "timeRegister" => $timeReigster
        ];

        $userModel->create($user);
        $_SESSION['missatge_flash'] = "Usuari Creat Correctament";
        header("Location: /user/login");
    }
    public function list()
    {
        $userModel = new User;
        $users = $userModel->getAll();
        $params['users'] = $users;
        $params['title'] = "Llista d'usuaris";

        $this->render("user/list", $params, "site");
    }

    public function logout()
    {
        unset($_SESSION['logged_user']);
        header('Location: /user/login');
    }

    public function delete()
    {
        $id = $_GET['id_user'];
        $userModel = new User;
        $usreDelted = $userModel->deleteById($id);
        if ($usreDelted) {
            header('Location: /user/list');
        } else {
            $_SESSION['missatge_flash'] = "No s'ha pogut eliminar el usuari";
            header("Location: /user/list");
        }
        return;
    }


    public function edit()
    {
        $id = $_GET['id_user'];
        $userModel = new User;
        $userSelected = $userModel->getUserById($id);
        $_SESSION['user_to_edit'] = $userSelected;
        header('Location: /user/userEdit');
    }

    public function userEdit()
    {

        $params['title'] = "Editar usuari";

        $this->render("user/edit", $params, "site");
    }
    public function storeEditUser(){
        $id_user = $_POST['id_user'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $mail = $_POST['mail'];
        $birthdate = $_POST['date'];
        $points = 0;
        $password = $_POST['password'];
        $timeReigster = date('Y-m-d');

        $userModel = new User;


   
        $origen = $_FILES['profile_image']['tmp_name'];
        $desti = "images/profile_images/";
        $array = explode(".", $_FILES['profile_image']['name']);
        $extensio = end($array);
        $nomFitxer = $username . "." . $extensio;

        $storeImage = Store::store($origen, $desti, $nomFitxer);


        if ($storeImage === false) {
            $_SESSION['missatge_flash'] = "No s'ha pogut carregar la imatge";
            header('Location: /user/signup');
            return;
        }
        $user = [
            "id_user" =>$id_user,
            "name" => $name,
            "username" => $username,
            "mail" => $mail,
            "birthdate" => $birthdate,
            "points" => $points,
            "profile_image" => $nomFitxer,
            "password" => $password,
            "timeRegister" => $timeReigster
        ];

        $userModel->updateUser($user);
        $_SESSION['missatge_flash'] = "Usuari Creat Correctament";
        header("Location: /user/login");
    }
}
