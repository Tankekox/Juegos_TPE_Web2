<?php
require_once "./app/models/modelGames.php";
require_once "./app/views/viewGames.php";


class controllerGames{
    private $model;
    private $view;
    
    function __construct(){
        $this->model = new modelGames();
        $this->view = new viewGames();
    }
    public function getGame($id_game){

        $game = $this->model->getGame($id_game);
        
        if(!isset($game) || empty($game)){
            $error = 'El juego señalado no existe';
            $this->view->displayError($error);
        }else{
            $this->view->displayGame($game[0]);
        }
    }

    public function getGames(){
        $games = $this->model->getGames();
        $this->view->displayGames($games);
    }
    public function addGame(){
        if(isset($_POST["title"]) && isset($_POST["genre"]) && isset($_POST["distributor"]) && isset($_POST["launch_date"]) && isset($_POST["price"])){

            $title = $_POST["title"];
            $genre = $_POST["genre"];
            $distributor = $_POST["distributor"];
            $launch_date = $_POST["launch_date"];
            $price = $_POST["price"];

            $new_game = $this->model->addGame($title, $genre, $distributor, $launch_date, $price);
            $this->view->displayGames($new_game);
        }else{
            $this->view->displayError('complete el formulario');
        }
        header("location: " . BASE_URL . "/administracion");
    }
    public function deleteGame($id){
        $this->model->deleteGame($id);
        header("location: " . BASE_URL . "/administracion");
    }
    public function updateGame($id){
        $changed_game = $this ->model->updateGame($id);
        $this->view->changedGame($changed_game);
        header("location: " . BASE_URL . "/administracion");
    }
}