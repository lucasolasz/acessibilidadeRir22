<?php

class EditoriasController extends Controller
{

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        //Redireciona para tela de login caso usuario nao esteja logado
        if (!IsLoged::estaLogado()) {
            //Está vazio, para retornar ao diretorio raiz
            Redirecionamento::redirecionar('LoginController/login');
        }

        $this->editoriasModel = $this->model("Editorias");
    }


    //Método padrão que é invocado ao chamar a controller
    public function index()
    {
        $dados = [
            'editorias' =>  $this->editoriasModel->visualizarEditorias()
        ];

        //Retorna para a view
        $this->view('editorias/index', $dados);
    }


    public function cadastrar()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = [
                'txtEditoria' => trim($formulario['txtEditoria'])
            ];

            if (in_array("", $formulario)) {

                if (empty($formulario['txtEditoria'])) {
                    $dados['editoria_erro'] = "Preencha uma editoria";
                }
            } else {

                //Invoca método estatico da classe 
                if (Checa::checarNome($formulario['txtEditoria'])) {
                    $dados['editoria_erro'] = "Nome de editoria inválida";
                } else if ($this->editoriasModel->existeEditoria($dados)) {
                    $dados['editoria_erro'] = "Nome de editoria já existe";
                } else {
                    if ($this->editoriasModel->armazenarEditoria($dados)) {

                        Alertas::mensagem('editorias', 'Editoria cadastrada com sucesso');
                        Redirecionamento::redirecionar('EditoriasController');
                    } else {
                        die("Erro ao armazenar editoria no banco de dados");
                    }
                }
            }
        } else {

            $dados = [
                'txtEditoria' => ''
            ];
        }


        //Retorna para a view
        $this->view('editorias/cadastrar', $dados);
    }

    public function editar($id)
    {
        $editoria = $this->editoriasModel->lerEditoriaPorId($id);

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtEditoria' => trim($formulario['txtEditoria']),
                'id_editoria' => $id,
                'editoria' => $editoria,
            ];

            // var_dump($dados);

            if (empty($formulario['txtEditoria'])) {
                $dados['editoria_erro'] = "Preencha a Editora";
            } else {
                if (Checa::checarNome($formulario['txtEditoria'])) {
                    $dados['editoria_erro'] = "Nome de editoria inválida";
                } else {
                    if ($this->editoriasModel->editarEditoria($dados)) {

                        Alertas::mensagem('editorias', 'Editoria atualizada com sucesso');
                        Redirecionamento::redirecionar('EditoriasController');
                    } else {
                        die("Erro ao atualizar editoria no banco de dados");
                    }
                }
            }
        } else {

            $dados = [
                'txtEditoria' => '',
                'editoria' =>  $editoria
            ];
        }
        //Retorna para a view
        $this->view('editorias/editar', $dados);
    }

    public function deletar($id)
    {

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if ($id && $metodo == 'POST') {

            if ($this->editoriasModel->deletarEditoria($id)) {

                //Para exibir mensagem success , não precisa informar o tipo de classe
                Alertas::mensagem('editorias', 'Editoria deletada com sucesso');
                Redirecionamento::redirecionar('EditoriasController');
            } else {
                die("Erro ao deletar a editoria no banco de dados");
            }
        } else {
            Alertas::mensagem('editorias', 'Não foi possível deletar a diretoria', 'alert alert-danger');
            Redirecionamento::redirecionar('EditoriasController');
        }
    }
}
