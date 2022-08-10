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
            'espectador' =>  $this->espectadorModel->visualizarEspectador(),
            'acessoServico' => $this->espectadorModel->lerAcessoServico()
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
        $cadeiraDeRodasUsadas = $this->espectadorModel->lerCadeiraDeRodasUsadas();

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = [
                'txtNomeEspectador' => trim($formulario['txtNomeEspectador']),
                'txtDocumento' => trim($formulario['txtDocumento']),
                'txtTelefone' => trim($formulario['txtTelefone']),
                'chkKitLivre' => $formulario['chkKitLivre'],
                'chkAcompanhante' => $formulario['chkAcompanhante'],
                'txtNomeAcompanhante' => $formulario['txtNomeAcompanhante'],
                'txtDocumentoAcompanhante' => $formulario['txtDocumentoAcompanhante'],
                'txtTelefoneAcompanhante' => $formulario['txtTelefoneAcompanhante'],
                'chkAcompanhanteMenor' => $formulario['chkAcompanhanteMenor'],
                'txtQuantidadeMenor' => $formulario['txtQuantidadeMenor'],
                'acessoServico' => $acessoServico,
                'tipoDeficiencia' => $tipoDeficiencia,
                'guardaVolumes' => $guardaVolumes,
                'condicao' => $condicao,
                'cadeiraDeRodas' => $cadeiraDeRodas,
                'cadeiraDeRodasUsadas' => $cadeiraDeRodasUsadas
            ];

            $dados['txtIdade'] = !$formulario['txtIdade'] == "" ? $formulario['txtIdade'] : NULL;
            $dados['cboCadeiraDerodas'] = !$formulario['cboCadeiraDerodas'] == "" ? $formulario['cboCadeiraDerodas'] : NULL;
            $dados['chkAcessoServico'] = isset($formulario['chkAcessoServico']) ? $formulario['chkAcessoServico'] : "";
            $dados['chkTipoDeficiencia'] = isset($formulario['chkTipoDeficiencia']) ? $formulario['chkTipoDeficiencia'] : "";
            $dados['radioCondicao'] = isset($formulario['radioCondicao']) ? $formulario['radioCondicao'] : NULL;
            $dados['chkGuardaVolume'] = isset($formulario['chkGuardaVolume']) ? $formulario['chkGuardaVolume'] : "";
            $dados['fileTermoAdesao'] = isset($_FILES['fileTermoAdesao']) ? $_FILES['fileTermoAdesao'] : "";

            if ($this->espectadorModel->armazenarEspectador($dados)) {

                Alertas::mensagem('espectador', 'Espectador cadastrado com sucesso');
                Redirecionamento::redirecionar('EspectadorController/index');
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
                'guardaVolumes' => $guardaVolumes,
                'cadeiraDeRodasUsadas' => $cadeiraDeRodasUsadas
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
        $cadeiraDeRodasUsadas = $this->espectadorModel->lerCadeiraDeRodasUsadas();

        $relacAcessoServico = $this->espectadorModel->relacAcessoServicoPorid($id);
        $relacGuardaVolumes = $this->espectadorModel->relacGuardaVolumesPorid($id);
        $relacTipoDeficiencia = $this->espectadorModel->relacTipoDeficienciaPorid($id);
        $fotoAdesao = $this->espectadorModel->lerAnexosPorId($id);


        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = [
                'txtNomeEspectador' => trim($formulario['txtNomeEspectador']),
                'txtDocumento' => trim($formulario['txtDocumento']),
                'txtTelefone' => trim($formulario['txtTelefone']),
                'chkKitLivre' => $formulario['chkKitLivre'],
                'chkAcompanhante' => $formulario['chkAcompanhante'],
                'txtNomeAcompanhante' => $formulario['txtNomeAcompanhante'],
                'txtDocumentoAcompanhante' => $formulario['txtDocumentoAcompanhante'],
                'txtTelefoneAcompanhante' => $formulario['txtTelefoneAcompanhante'],
                'txtQuantidadeMenor' => $formulario['txtQuantidadeMenor'],
                'id_espectador' => $id,
                'acessoServico' => $acessoServico,
                'tipoDeficiencia' => $tipoDeficiencia,
                'guardaVolumes' => $guardaVolumes,
                'condicao' => $condicao,
                'cadeiraDeRodas' => $cadeiraDeRodas,
                'cadeiraDeRodasUsadas' => $cadeiraDeRodasUsadas,
                'fotoAdesao' => $fotoAdesao
            ];



            $dados['fk_acompanhante'] = !$espectador->fk_acompanhante == NULL ? $espectador->fk_acompanhante : NULL;
            $dados['txtIdade'] = !$formulario['txtIdade'] == "" ? $formulario['txtIdade'] : NULL;

            if ($espectador->fk_cadeira_rodas == NULL) {
                $dados['cboCadeiraDerodas'] = !$formulario['cboCadeiraDerodas'] == "" ? $formulario['cboCadeiraDerodas'] : NULL;
            } else {
                $dados['cboCadeiraDerodas'] = !$formulario['cboCadeiraDerodas'] == "" ?  $formulario['cboCadeiraDerodas'] : $espectador->fk_cadeira_rodas;
            }

            $dados['chkAcompanhanteMenor'] = isset($formulario['chkAcompanhanteMenor']) ? $formulario['chkAcompanhanteMenor'] : "N";
            $dados['chkAcessoServico'] = isset($formulario['chkAcessoServico']) ? $formulario['chkAcessoServico'] : "";
            $dados['chkTipoDeficiencia'] = isset($formulario['chkTipoDeficiencia']) ? $formulario['chkTipoDeficiencia'] : "";
            $dados['radioCondicao'] = isset($formulario['radioCondicao']) ? $formulario['radioCondicao'] : NULL;
            $dados['chkGuardaVolume'] = isset($formulario['chkGuardaVolume']) ? $formulario['chkGuardaVolume'] : "";
            $dados['fileTermoAdesao'] = isset($_FILES['fileTermoAdesao']) ? $_FILES['fileTermoAdesao'] : "";

            if ($this->espectadorModel->editarEspectador($dados)) {

                Alertas::mensagem('espectador', 'Espectador atualizado com sucesso');
                Redirecionamento::redirecionar('EspectadorController');
            } else {
                Alertas::mensagem('espectador', 'Não foi possível atualizar o espectador', 'alert alert-danger');
                Redirecionamento::redirecionar('EspectadorController');
            }
        } else {

            $dados = [

                'espectador' => $espectador,
                'condicao' => $condicao,
                'acessoServico' => $acessoServico,
                'tipoDeficiencia' => $tipoDeficiencia,
                'cadeiraDeRodas' => $cadeiraDeRodas,
                'cadeiraDeRodasUsadas' => $cadeiraDeRodasUsadas,
                'guardaVolumes' => $guardaVolumes,
                'relacAcessoServico' => $relacAcessoServico,
                'relacGuardaVolumes' => $relacGuardaVolumes,
                'relacTipoDeficiencia' => $relacTipoDeficiencia,
                'fotoAdesao' => $fotoAdesao

            ];
        }

        //Retorna para a view
        $this->view('espectador/editar', $dados);
    }

    public function deletar($id)
    {

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $fotoAdesao = $this->espectadorModel->lerAnexosPorId($id);
        $espectador = $this->espectadorModel->lerEspectadorPorId($id);

        $dados = [
            'fotoAdesao' => $fotoAdesao,
            'id_espectador' => $id,
            'espectador' => $espectador
        ];

        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if ($id && $metodo == 'POST') {

            if ($this->espectadorModel->deletarEspectador($dados)) {

                //Para exibir mensagem success , não precisa informar o tipo de classe
                Alertas::mensagem('espectador', 'Espectador deletado com sucesso');
                Redirecionamento::redirecionar('EspectadorController');
            } else {
                Alertas::mensagem('espectador', 'Não foi possível deletar o espectador', 'alert alert-danger');
                Redirecionamento::redirecionar('EspectadorController');
            }
        } else {
            Alertas::mensagem('espectador', 'Não foi possível deletar o espectador', 'alert alert-danger');
            Redirecionamento::redirecionar('EspectadorController');
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
