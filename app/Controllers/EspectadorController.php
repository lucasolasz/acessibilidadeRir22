<?php

class EspectadorController extends Controller
{

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        //Redireciona para tela de login caso usuario nao esteja logado
        if (!IsLoged::estaLogado()) {
            //Está vazio, para retornar ao diretorio raiz
            Redirecionamento::redirecionar('LoginController/login');
        }

        $this->espectadorModel = $this->model("Espectador");
    }

    //Método padrão que é invocado ao chamar a controller
    public function index()
    {
        $dados = [
            'espectador' =>  $this->espectadorModel->visualizarEspectador()
        ];

        //Retorna para a view
        $this->view('espectador/index', $dados);
    }

    public function cadastrar()
    {   
        $condicao = $this->espectadorModel->lerCondicao();
        $acessoServico = $this->espectadorModel->lerAcessoServico();
        $tipoDeficiencia = $this->espectadorModel->lerTipoDeficiencia();
        $cadeiraDeRodas = $this->espectadorModel->lerCadeiraDeRodas();
        $guardaVolumes = $this->espectadorModel->lerGuardaVolumes();

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = [
                'txtNomeEspectador' => trim($formulario['txtNomeEspectador']),
                'txtDocumento' => trim($formulario['txtDocumento']),
            ];

            if (in_array("", $formulario)) {

                if (empty($formulario['txtNomeEspectador'])) {
                    $dados['nome_espectador_erro'] = "Preencha um nome";
                }
            } else {

                //Invoca método estatico da classe 
                if (Checa::checarNome($formulario['txtNomeEspectador'])) {
                    $dados['nome_espectador_erro'] = "Nome de espectador inválida";
                } else if ($this->espectadorModel->existeEspectador($dados)) {
                    $dados['documento_erro'] = "Já existe Espectador cadastrado com esse documento";
                } else {
                    if ($this->espectadorModel->armazenarEspectador($dados)) {

                        Alertas::mensagem('espectador', 'Espectador cadastrado com sucesso');
                        Redirecionamento::redirecionar('EspectadorController');
                    } else {
                        die("Erro ao armazenar espectador no banco de dados");
                    }
                }
            }
        } else {

            $dados = [
                'txtNomeEspectador' => '',
                'nome_espectador_erro' => '',
                'txtDocumento' => '',
                'documento_erro' => '',
                'txtIdade' => '',
                'idade_erro' => '',
                'txtTelefone' => '',
                'telefone_erro' => '',
                'condicao' => $condicao,
                'acessoServico' => $acessoServico,
                'tipoDeficiencia' => $tipoDeficiencia,
                'txtNomeAcompanhante' => '',
                'nome_acompanhante_erro' => '',
                'txtDocumentoAcompanhante' => '',
                'documento_acompanhante_erro' => '',
                'txtTelefoneAcompanhante' => '',
                'telefone_acompanhante_erro' => '',
                'txtQuantidadeMenor' => '',
                'quantidade_menor_erro' => '',
                'cadeiraDeRodas' => $cadeiraDeRodas,
                'guardaVolumes' => $guardaVolumes

            ];
        }


        //Retorna para a view
        $this->view('espectador/cadastrar', $dados);
    }
}
