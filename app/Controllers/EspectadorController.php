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
            // exit();

            $dados = [
                'txtNomeEspectador' => trim($formulario['txtNomeEspectador']),
                'txtDocumento' => trim($formulario['txtDocumento']),
                'txtIdade' => trim($formulario['txtIdade']),
                'txtTelefone' => trim($formulario['txtTelefone']),
                'chkKitLivre' => $formulario['chkKitLivre'],
                'chkAcompanhante' => $formulario['chkAcompanhante'],
                'txtNomeAcompanhante' => $formulario['txtNomeAcompanhante'],
                'txtDocumentoAcompanhante' => $formulario['txtDocumentoAcompanhante'],
                'txtTelefoneAcompanhante' => $formulario['txtTelefoneAcompanhante'],
                'chkAcompanhanteMenor' => $formulario['chkAcompanhanteMenor'],
                'txtQuantidadeMenor' => $formulario['txtQuantidadeMenor'],
                // 'cboCadeiraDerodas' => $formulario['cboCadeiraDerodas'],
                'acessoServico' => $acessoServico,
                'tipoDeficiencia' => $tipoDeficiencia,
                'guardaVolumes' => $guardaVolumes,
                'condicao' => $condicao,
                'cadeiraDeRodas' => $cadeiraDeRodas
            ];

            $dados['cboCadeiraDerodas'] = !$formulario['cboCadeiraDerodas'] == "" ? $formulario['cboCadeiraDerodas'] : NULL;
            $dados['chkAcessoServico'] = isset($formulario['chkAcessoServico']) ? $formulario['chkAcessoServico'] : "";
            $dados['chkTipoDeficiencia'] = isset($formulario['chkTipoDeficiencia']) ? $formulario['chkTipoDeficiencia'] : "";
            $dados['radioCondicao'] = isset($formulario['radioCondicao']) ? $formulario['radioCondicao'] : NULL;
            $dados['chkGuardaVolume'] = isset($formulario['chkGuardaVolume']) ? $formulario['chkGuardaVolume'] : "";
            $dados['fileTermoAdesao'] = isset($_FILES['fileTermoAdesao']) ? $_FILES['fileTermoAdesao'] : "";

            // var_dump($dados);
            // echo "<br>";
            // exit();

            if ($this->espectadorModel->armazenarEspectador($dados)) {

                Alertas::mensagem('espectador', 'Espectador cadastrado com sucesso');
                Redirecionamento::redirecionar('EspectadorController');
            } else {
                Alertas::mensagem('espectador', 'Não foi possível cadastrar o espectador', 'alert alert-danger');
                Redirecionamento::redirecionar('EspectadorController');
            }
            
        } else {

            $dados = [
                'txtNomeEspectador' => '',                
                'txtDocumento' => '',                
                'txtIdade' => '',                
                'txtTelefone' => '',                
                'radioCondicao' => '',
                'condicao' => $condicao,
                'acessoServico' => $acessoServico,
                'chkKitLivre' => '',
                'tipoDeficiencia' => $tipoDeficiencia,
                'chkAcompanhante' => '',
                'txtNomeAcompanhante' => '',                
                'txtDocumentoAcompanhante' => '',                
                'txtTelefoneAcompanhante' => '',                
                'chkAcompanhanteMenor' => '',
                'txtQuantidadeMenor' => '',                
                'cadeiraDeRodas' => $cadeiraDeRodas,                
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
