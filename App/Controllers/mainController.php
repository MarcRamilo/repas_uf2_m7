<?php

class mainController extends Controller{

    public function index(){
        $params['title'] = "Home";
        $this->render("home/index", $params, "site");
    }

}

?>