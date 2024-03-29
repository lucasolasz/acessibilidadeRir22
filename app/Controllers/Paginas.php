<?php

class Paginas extends Controller
{

    public function __construct()
    {      
        $this->espectadorModel = $this->model("Espectador");
    }

    public function index()
    {

        //Parâmetros enviados para o método do controller VIEW
        $dados = [
            'tituloPagina' => 'Página Inicial',
        ];

        //Chamada do novo objeto PAGINAS 
        $this->view('paginas/home', $dados);
    }


    public function guardaVolumes()
    {
        
        $dados = [
            'espectador' =>  $this->espectadorModel->relacAcessoServicoGuardaVol()
            // 'guardaVolumes' =>  $this->espectadorModel->lerGuardaVolumes()
        ];

        //Chamada do novo objeto PAGINAS 
        $this->view('paginas/guardaVolumes', $dados);
    }


    public function sobre()
    {

        //Parâmetros enviados para o método do controller VIEW
        $dados = [
            'tituloPagina' => 'Sobre nós'
        ];

        //Chamada do novo objeto PAGINAS 
        $this->view('paginas/sobre', $dados);
    }
}
