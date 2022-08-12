<?php

class CadeiraRodasController extends Controller
{

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        //Redireciona para tela de login caso usuario nao esteja logado
        if (!IsLoged::estaLogado()) {
            //Está vazio, para retornar ao diretorio raiz
            Redirecionamento::redirecionar('LoginController/login');
        }

        $this->cadeiraRodasModel = $this->model("CadeiraRodas");
    }

    //Método padrão que é invocado ao chamar a controller
    public function index()
    {


        $dados = [
            'cadeiraRodas' =>  $this->cadeiraRodasModel->visualizarCadeiraRodas()            
        ];

        //Retorna para a view
        $this->view('cadeiraRodas/index', $dados);
    }

    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            $dados = [
                'txtCadeiraRodas' => trim($formulario['txtCadeiraRodas'])
            ];

            if (empty($formulario['txtCadeiraRodas'])) {
                $dados['cadeira_erro'] = "Preencha o número de uma cadeira";
            } else {
                
                if ($this->cadeiraRodasModel->armazenarCadeiraRodas($dados)) {

                    Alertas::mensagem('cadeiraRodas', 'Cadeira cadastrada com sucesso');
                    Redirecionamento::redirecionar('CadeiraRodasController');
                } else {
                    Alertas::mensagem('cadeiraRodas', 'Não foi possível cadastrar a cadeira', 'alert alert-danger');
                    Redirecionamento::redirecionar('CadeiraRodasController');
                }
            }
        } else {

            $dados = [
                'txtCadeiraRodas' => ''
            ];
        }

        //Retorna para a view
        $this->view('cadeiraRodas/cadastrar', $dados);
    }

    public function editar($id)
    {
        $cadeiraRodas =  $this->cadeiraRodasModel->lerCadeiraPorId($id);

        // var_dump($id);
        // exit();

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = [
                'txtCadeiraRodas' => trim($formulario['txtCadeiraRodas']),
                'id_cadeira_rodas' => $id
            ];

            if ($this->cadeiraRodasModel->editarCadeiraRodas($dados)) {

                echo 'cheguei';

                Alertas::mensagem('cadeiraRodas', 'Cadeira atualizada com sucesso');
                Redirecionamento::redirecionar('CadeiraRodasController');
            } else {
                Alertas::mensagem('cadeiraRodas', 'Não foi possível atualizar a cadeira', 'alert alert-danger');
                Redirecionamento::redirecionar('CadeiraRodasController');
            }
        } else {

            $dados = [
                'cadeiraRodas' => $cadeiraRodas
            ];
        }

        //Retorna para a view
        $this->view('cadeiraRodas/editar', $dados);
    }

    public function deletar($id)
    {

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $dados = [            
            'id_cadeira' => $id,
        ];

        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if ($id && $metodo == 'POST') {

            if ($this->cadeiraRodasModel->deletarCadeira($dados)) {

                //Para exibir mensagem success , não precisa informar o tipo de classe
                Alertas::mensagem('cadeiraRodas', 'Cadeira deletada com sucesso');
                Redirecionamento::redirecionar('CadeiraRodasController');
            } else {
                Alertas::mensagem('cadeiraRodas', 'Não foi possível deletar a cadeira', 'alert alert-danger');
                Redirecionamento::redirecionar('CadeiraRodasController');
            }
        } else {
            Alertas::mensagem('cadeiraRodas', 'Não foi possível deletar a cadeira', 'alert alert-danger');
            Redirecionamento::redirecionar('CadeiraRodasController');
        }
    }

    public function deletarImagem($id)
    {
        $fotoAdesao = $this->espectadorModel->lerAnexosPorId($id);

        $dados = [
            'fotoAdesao' => $fotoAdesao
        ];

        if ($this->espectadorModel->deletarFoto($dados)) {
            Alertas::mensagem('imagem', 'Imagem deletada com sucesso.');
            Redirecionamento::redirecionar('EspectadorController/editar/' . $fotoAdesao[0]->fk_espectador);
        } else {
            Alertas::mensagem('imagem', 'Não foi deletar a imagem', 'alert alert-danger');
            Redirecionamento::redirecionar('EspectadorController/editar/' . $fotoAdesao[0]->fk_espectador);
        }
    }
}
