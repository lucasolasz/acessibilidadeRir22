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

            // var_dump($formulario);

            $dados = [
                'txtNomeEspectador' => trim($formulario['txtNomeEspectador']),
                'txtDocumento' => trim($formulario['txtDocumento']),
                'txtIdade' => trim($formulario['txtIdade']),
                'txtTelefone' => trim($formulario['txtTelefone']),
                'acessoServico' => $acessoServico,
                'chkKitLivre' => $formulario['chkKitLivre'],
                'tipoDeficiencia' => $tipoDeficiencia,
                'guardaVolumes' => $guardaVolumes,
                'condicao' => $condicao,
                'cadeiraDeRodas' => $cadeiraDeRodas,
                'outrosDados' => $formulario,
            ];


            //Todos estes issets foram necessários, pois são os campos disabled
            if (isset($_FILES['fileTermoAdesao'])) {
                $dados['arquivo'] = $_FILES['fileTermoAdesao'];
            }else{
                $dados['arquivo'] = "";
            }

            if (isset($formulario['radioCondicao'])) {
                $dados['radioCondicao'] = $formulario['radioCondicao'];
            } else {
                $dados['radioCondicao'] = NULL;
            }

            if (isset($formulario['chkAcompanhante'])) {
                $dados['chkAcompanhante'] = $formulario['chkAcompanhante'];
            }else{
                $dados['chkAcompanhante'] = 'N';
            }

            if (isset($formulario['txtNomeAcompanhante'])) {
                $dados['txtNomeAcompanhante'] = $formulario['txtNomeAcompanhante'];
            }else {
                $dados['txtNomeAcompanhante'] = "";
            }

            if (isset($formulario['txtDocumentoAcompanhante'])) {
                $dados['txtDocumentoAcompanhante'] = $formulario['txtDocumentoAcompanhante'];
            }else{
                $dados['txtDocumentoAcompanhante'] = "";
            }

            if (isset($formulario['txtTelefoneAcompanhante'])) {
                $dados['txtTelefoneAcompanhante'] = $formulario['txtTelefoneAcompanhante'];
            } else{
                $dados['txtTelefoneAcompanhante'] = "";
            }

            if (isset($formulario['chkAcompanhanteMenor'])) {
                $dados['chkAcompanhanteMenor'] = $formulario['chkAcompanhanteMenor'];
            } else{
                $dados['chkAcompanhanteMenor'] = 'N';
            }

            if (isset($formulario['txtQuantidadeMenor'])) {
                $dados['txtQuantidadeMenor'] = $formulario['txtQuantidadeMenor'];
            } else {
                $dados['txtQuantidadeMenor'] = '';
            }

            if (isset($formulario['cboCadeiraDerodas'])) {
                $dados['cboCadeiraDerodas'] = $formulario['cboCadeiraDerodas'];
            }else{
                $dados['cboCadeiraDerodas'] = NULL;
            }

            // var_dump($dados);
            // echo "<br>";
            // exit();

            if (empty($formulario['txtNomeEspectador'])) {
                $dados['nome_espectador_erro'] = "Preencha um nome";
            } else {
                //Invoca método estatico da classe 
                if ($this->espectadorModel->existeEspectador($dados)) {
                    $dados['documento_erro'] = "Já existe Espectador cadastrado com esse documento";
                } else {

                    if ($this->espectadorModel->armazenarEspectador($dados)) {

                        Alertas::mensagem('espectador', 'Espectador cadastrado com sucesso');
                        Redirecionamento::redirecionar('EspectadorController');
                    } else {
                        Alertas::mensagem('espectador', 'Não foi possível cadastrar o espectador', 'alert alert-danger');
                        Redirecionamento::redirecionar('EspectadorController');
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
                'radioCondicao' => '',
                'condicao' => $condicao,
                'acessoServico' => $acessoServico,
                'chkKitLivre' => '',
                'tipoDeficiencia' => $tipoDeficiencia,
                'chkAcompanhante' => '',
                'txtNomeAcompanhante' => '',
                'nome_acompanhante_erro' => '',
                'txtDocumentoAcompanhante' => '',
                'documento_acompanhante_erro' => '',
                'txtTelefoneAcompanhante' => '',
                'telefone_acompanhante_erro' => '',
                'chkAcompanhanteMenor' => '',
                'txtQuantidadeMenor' => '',
                'quantidade_menor_erro' => '',
                'cadeiraDeRodas' => $cadeiraDeRodas,
                'cadeira_de_rodas_erro' => '',
                'chkGuardaVolume' => '',
                'guardaVolumes' => $guardaVolumes
            ];
        }


        //Retorna para a view
        $this->view('espectador/cadastrar', $dados);
    }

    public function editar($id)
    {
        $condicao = $this->espectadorModel->lerCondicao();
        $acessoServico = $this->espectadorModel->lerAcessoServico();
        $tipoDeficiencia = $this->espectadorModel->lerTipoDeficiencia();
        $cadeiraDeRodas = $this->espectadorModel->lerCadeiraDeRodas();
        $guardaVolumes = $this->espectadorModel->lerGuardaVolumes();
        $espectador = $this->espectadorModel->lerEspectadorPorId($id);


        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($formulario)) {
            $dados = [];
        } else {

            $dados = [

                'espectador' => $espectador,
                'condicao' => $condicao,
                'acessoServico' => $acessoServico,
                'tipoDeficiencia' => $tipoDeficiencia,
                'cadeiraDeRodas' => $cadeiraDeRodas,
                'guardaVolumes' => $guardaVolumes
            ];
        }

        //Retorna para a view
        $this->view('espectador/editar', $dados);
    }
}
