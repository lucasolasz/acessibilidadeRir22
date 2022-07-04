<?php

class LoginController extends Controller
{
    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        $this->usuarioModel = $this->model("Usuario");
    }

    public function login()
    {
        //Evita que codigos maliciosos sejam enviados pelos campos
        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {

            $dados = [
                'txtEmail' => trim($formulario['txtEmail']),
                'txtSenha' => trim($formulario['txtSenha'])
            ];

            if (in_array("", $formulario)) {

                //Verifica se está vazio
                if (empty($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Preencha o email";
                }
                if (empty($formulario['txtSenha'])) {
                    $dados['senha_erro'] = "Preencha a senha";
                }
            } else {
                //Invoca método estatico da classe 
                if (Checa::checarEmail($formulario['txtEmail'])) {
                    $dados['email_erro'] = "Email inválido";
                } elseif (strlen($formulario['txtSenha']) < 6) {
                    $dados['senha_erro'] = "A senha precisa ter no mínimo 6 caracteres";
                } else {

                    $usuario = $this->usuarioModel->checarLogin($formulario['txtEmail'], $formulario['txtSenha']);

                    if ($usuario) {
                        $this->criarSessaoUsuario($usuario);
                    } else {
                        Alertas::mensagem('usuario', 'Usuário ou senha inválidos', 'alert alert-danger');
                    }
                }
            }
        } else {
            $dados = [
                'txtNome' => '',
                'txtEmail' => '',
                'email_erro' => '',
                'senha_erro' => ''
            ];
        }

        //Retorna para a view
        $this->view('usuarios/login', $dados);
    }

    //Destroi todas as variáveis de sessão para efetuar logof
    public function sair()
    {
        unset($_SESSION['id_usuario']);
        unset($_SESSION['ds_nome_usuario']);
        unset($_SESSION['ds_email_usuario']);      
       
        session_destroy();

        Redirecionamento::redirecionar('LoginController/login');
    }

    //Cria as variaveis de sessao ao fazer login, resgatando informações do usuário
    private function criarSessaoUsuario($usuario)
    {
        $_SESSION['id_usuario'] = $usuario->id_usuario;
        $_SESSION['ds_nome_usuario'] = $usuario->ds_nome_usuario;
        $_SESSION['ds_email_usuario'] = $usuario->ds_email_usuario;

        Redirecionamento::redirecionar('Paginas/home');
    }
}
