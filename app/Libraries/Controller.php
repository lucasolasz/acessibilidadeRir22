<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/Models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $dados = [])
    {
        include APP . '/Views/topo.php';

        $this->viewCrua($view, $dados);

        include APP . '/Views/rodape.php';
    }

    public function viewCrua($view, $dados = [])
    {
        $arquivo = ('../app/Views/' . $view . '.php');

        if (file_exists($arquivo)) {
            require_once $arquivo;
        } else {
            die('O arquivo de view não existe!');
        }
    }
}
