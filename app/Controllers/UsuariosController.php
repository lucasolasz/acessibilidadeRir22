<?php

class UsuariosController extends Controller
{
    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        //Redireciona para tela de login caso usuario nao esteja logado
        if (!IsLoged::estaLogado()) {
            //Está vazio, para retornar ao diretorio raiz
            Redirecionamento::redirecionar('LoginController/login');
        }

        $this->usuarioModel = $this->model("Usuario");
    }


    //Método padrão que é invocado ao chamar a controller
    public function index()
    {
        $dados = [
            'usuarios' =>  $this->usuarioModel->visualizarUsuarios()
        ];

        //Retorna para a view
        $this->view('usuarios/index', $dados);
    }


    public function cadastrar()
    {
        $perfilUsuario = $this->usuarioModel->listarPerfilUsuario();

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {


            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtEmail' => trim($formulario['txtEmail']),
                'txtSenha' => trim($formulario['txtSenha']),
                'txtConfirmaSenha' => trim($formulario['txtConfirmaSenha']),
                'cboPerfilUsuario' => $formulario['cboPerfilUsuario'],
                'perfilUsuario' => $perfilUsuario
            ];

            // var_dump($dados['cboEditoriaUsuario']);
            // exit();

            if (in_array("", $formulario)) {

                //Verifica se está vazio
                if (empty($formulario['txtNome'])) {
                    $dados['nome_erro'] = "Preencha o Nome";
                }
                if (empty($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Preencha o email";
                }
                if (empty($formulario['txtSenha'])) {
                    $dados['senha_erro'] = "Preencha a senha";
                }
                if (empty($formulario['txtConfirmaSenha'])) {
                    $dados['confirma_senha_erro'] = "Preencha a confirmação de senha";
                }
            } else {
                //Invoca método estatico da classe 
                if (Checa::checarNome($formulario['txtNome'])) {
                    $dados['nome_erro'] = "Nome inválido";
                } elseif (Checa::checarEmail($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Email inválido";
                } elseif ($this->usuarioModel->checarEmailUsuario($dados)) {
                    $dados['email_erro'] = "Email já está sendo utilizado";
                } elseif (strlen($formulario['txtSenha']) < 6) {
                    $dados['senha_erro'] = "A senha precisa ter no mínimo 6 caracteres";
                } elseif ($formulario['txtSenha'] != $formulario['txtConfirmaSenha']) {
                    $dados['confirma_senha_erro'] = "As senhas são diferentes";
                } else {

                    //Criptografa a senha com hash em php
                    $dados['txtSenha'] = password_hash($formulario['txtSenha'], PASSWORD_DEFAULT);

                    if ($this->usuarioModel->armazenarUsuario($dados)) {

                        //Para exibir mensagem success , não precisa informar o tipo de classe
                        Alertas::mensagem('usuario', 'Usuário cadastrado com sucesso');
                        Redirecionamento::redirecionar('UsuariosController');
                    } else {
                        //Para exibir mensagem success , não precisa informar o tipo de classe
                        Alertas::mensagem('usuario', 'Erro ao cadastrar usuário', 'alert alert-danger');
                        Redirecionamento::redirecionar('UsuariosController');
                    }
                }
            }
        } else {

            $dados = [
                'txtNome' => '',
                'txtEmail' => '',
                'txtSenha' => '',
                'txtConfirmaSenha' => '',
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => '',
                'perfilUsuario' => $perfilUsuario
            ];
        }

        //Retorna para a view
        $this->view('usuarios/cadastrar', $dados);
    }

    public function editar($id)
    {

        $usuario = $this->usuarioModel->lerUsuarioPorId($id);
        $perfilUsuario = $this->usuarioModel->listarPerfilUsuario();

        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtNome' => trim($formulario['txtNome']),
                'txtEmail' => trim($formulario['txtEmail']),
                'txtSenha' => trim($formulario['txtSenha']),
                'txtConfirmaSenha' => trim($formulario['txtConfirmaSenha']),
                'cboPerfilUsuario' => $formulario['cboPerfilUsuario'],
                'perfilUsuario' => $perfilUsuario,
                'id_usuario' => $id,
                'usuario' => $usuario
            ];


            //Verifica se está vazio
            if (empty($formulario['txtNome'])) {
                $dados['nome_erro'] = "Preencha o Nome";
            }
            if (empty($formulario['txtEmail'])) {
                $dados['email_erro'] = "Preencha o email";
            } else {

                if (Checa::checarNome($formulario['txtNome'])) {
                    $dados['nome_erro'] = "Nome inválido";
                } elseif (Checa::checarEmail($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Email inválido";
                } else {

                    if ($formulario['txtSenha'] == "" && $formulario['txtConfirmaSenha'] == "") {
                        if ($this->usuarioModel->atualizarUsuariosSemSenha($dados)) {
                            //Para exibir mensagem success , não precisa informar o tipo de classe
                            Alertas::mensagem('usuario', 'Usuário atualizado com sucesso');
                            Redirecionamento::redirecionar('UsuariosController');
                        }
                    } else {

                        if (strlen($formulario['txtSenha']) < 6) {
                            $dados['senha_erro'] = "A senha precisa ter no mínimo 6 caracteres";
                        } elseif ($formulario['txtSenha'] != $formulario['txtConfirmaSenha']) {
                            $dados['confirma_senha_erro'] = "As senhas são diferentes";
                        } else {

                            //Criptografa a senha com hash em php
                            $dados['txtSenha'] = password_hash($formulario['txtSenha'], PASSWORD_DEFAULT);

                            if ($this->usuarioModel->atualizarUsuariosComSenha($dados)) {
                                //Para exibir mensagem success , não precisa informar o tipo de classe
                                Alertas::mensagem('usuario', 'Usuário atualizado com sucesso');
                                Redirecionamento::redirecionar('UsuariosController');
                            }
                        }
                    }
                }
            }
        } else {


            $dados = [
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => '',
                'usuario' => $usuario,
                'perfilUsuario' => $perfilUsuario
            ];
        }
        //Retorna para a view
        $this->view('usuarios/editar', $dados);
    }

    public function deletar($id)
    {

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if ($id && $metodo == 'POST') {

            if ($this->usuarioModel->deletarUsuario($id)) {

                //Para exibir mensagem success , não precisa informar o tipo de classe
                Alertas::mensagem('usuario', 'Usuário deletado com sucesso');
                Redirecionamento::redirecionar('UsuariosController');
            } else {
                Alertas::mensagem('usuario', 'Erro ao deletar usuário', 'alert alert-danger');
                Redirecionamento::redirecionar('UsuariosController');
            }
        } else {
            Alertas::mensagem('usuario', 'Não foi possível deletar o usuário', 'alert alert-danger');
            Redirecionamento::redirecionar('UsuariosController');
        }
    }
}
