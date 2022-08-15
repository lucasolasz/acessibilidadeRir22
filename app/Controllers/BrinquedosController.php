<?php

class BrinquedosController extends Controller
{

    //Construtor do model do Usuário que fará o acesso ao banco
    public function __construct()
    {
        //Redireciona para tela de login caso usuario nao esteja logado
        if (!IsLoged::estaLogado()) {
            //Está vazio, para retornar ao diretorio raiz
            Redirecionamento::redirecionar('LoginController/login');
        }

        $this->brinquedosModel = $this->model("Brinquedos");
        $this->espectadorModel = $this->model("Espectador");
    }

    //Método padrão que é invocado ao chamar a controller
    public function index()
    {
        $dados = [
            'agendamentos' =>  $this->brinquedosModel->visualizarAgendamntos()
        ];

        //Retorna para a view
        $this->view('brinquedos/index', $dados);
    }

    public function cadastrar()
    {
        $espectador = $this->espectadorModel->visualizarEspectador();
        $brinquedos = $this->brinquedosModel->visualizarBrinquedos();
        $horaTirolesa = $this->brinquedosModel->visualizarHoraTirolesa();
        $horaRodaGigante = $this->brinquedosModel->visualizarHoraRogaGigante();
        $trintaMinMontanhaRussa = $this->brinquedosModel->visualizarTrintaMinMontanhaRussa();
        $quinzeMinCabum = $this->brinquedosModel->visualizarQuinzeMinCabum();

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {     

            //Converte valores vazios para NULL para salvar no banco
            $dados['cboEspectador'] = !$formulario['cboEspectador'] == "" ? $formulario['cboEspectador'] : NULL;
            $dados['cboHoraTirolesa'] = !$formulario['cboHoraTirolesa'] == "" ? $formulario['cboHoraTirolesa'] : NULL;
            $dados['cboTrintaMinMontanhaRussa'] = !$formulario['cboTrintaMinMontanhaRussa'] == "" ? $formulario['cboTrintaMinMontanhaRussa'] : NULL;
            $dados['cboQuinzeMinCabum'] = !$formulario['cboQuinzeMinCabum'] == "" ? $formulario['cboQuinzeMinCabum'] : NULL;
            $dados['cboHoraRodaGigante'] = !$formulario['cboHoraRodaGigante'] == "" ? $formulario['cboHoraRodaGigante'] : NULL;
            $dados['chkBrinquedo'] = isset($formulario['chkBrinquedo']) ? $formulario['chkBrinquedo'] : NULL;


            if ($dados['cboEspectador'] == NULL) {

                $dados = [
                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum
                ];    

                $dados['espectador_erro'] = "Selecione um espectador";

            } else {

                if ($this->brinquedosModel->armazenarAgendamentoBrinquedo($dados)) {

                    Alertas::mensagem('brinquedos', 'Agendamento cadastrado com sucesso');
                    Redirecionamento::redirecionar('BrinquedosController');
                } else {
                    Alertas::mensagem('brinquedos', 'Não foi possível agendar o brinquedo', 'alert alert-danger');
                    Redirecionamento::redirecionar('BrinquedosController');
                }
            }
        } else {

            $dados = [
                
                'espectador' => $espectador,
                'brinquedos' => $brinquedos,
                'horaTirolesa' => $horaTirolesa,
                'horaRodaGigante' => $horaRodaGigante,
                'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                'quinzeMinCabum' => $quinzeMinCabum
            ];
        }

        //Retorna para a view
        $this->view('brinquedos/cadastrar', $dados);
    }

    public function editar($id)
    {
        
        $agendamento = $this->brinquedosModel->lerAgendamentoPorId($id);
        $brinquedos = $this->brinquedosModel->visualizarBrinquedos();
        $horaTirolesa = $this->brinquedosModel->visualizarHoraTirolesa();
        $horaRodaGigante = $this->brinquedosModel->visualizarHoraRogaGigante();
        $trintaMinMontanhaRussa = $this->brinquedosModel->visualizarTrintaMinMontanhaRussa();
        $quinzeMinCabum = $this->brinquedosModel->visualizarQuinzeMinCabum();

        // var_dump($agendamento);
        // exit();


        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            var_dump($formulario);
            exit();


            $dados = [
                'txtCadeiraRodas' => trim($formulario['txtCadeiraRodas']),
                'id_cadeira_rodas' => $id
            ];

            if ($this->brinquedosModel->editarAgendamento($dados)) {



                Alertas::mensagem('brinquedos', 'Agendamento atualizado com sucesso');
                Redirecionamento::redirecionar('CadeiraRodasController');
            } else {
                Alertas::mensagem('brinquedos', 'Não foi possível atualizar o agendamento', 'alert alert-danger');
                Redirecionamento::redirecionar('CadeiraRodasController');
            }
        } else {

            $dados = [
                'agendamento' => $agendamento,
                'brinquedos' => $brinquedos,
                'horaTirolesa' => $horaTirolesa,
                'horaRodaGigante' => $horaRodaGigante,
                'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                'quinzeMinCabum' => $quinzeMinCabum
            ];
        }

        //Retorna para a view
        $this->view('brinquedos/editar', $dados);
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
