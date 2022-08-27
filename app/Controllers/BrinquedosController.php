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

    public function cadastrar($id = null)
    {
        // $espectador = $this->espectadorModel->visualizarEspectadorNaoAgendado();
        $espectador = $this->espectadorModel->lerEspectadorPorId($id);
        $brinquedos = $this->brinquedosModel->visualizarBrinquedos();
        $horaTirolesa = $this->brinquedosModel->visualizarHoraTirolesa();
        $horaRodaGigante = $this->brinquedosModel->visualizarHoraRogaGigante();
        $trintaMinMontanhaRussa = $this->brinquedosModel->visualizarTrintaMinMontanhaRussa();
        $quinzeMinCabum = $this->brinquedosModel->visualizarQuinzeMinCabum();

        
        $temErroCadastro = false;
        $horarioErroCadastro = '';

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            $dados = ['fk_espectador' => $id];

            $dados['cboHoraTirolesaNA'] = NULL;
            $dados['cboTrintaMinMontanhaRussaNA'] = NULL;
            $dados['cboQuinzeMinCabumNA'] = NULL;
            $dados['cboHoraRodaGiganteNA'] = NULL;

            //Converte valores vazios para NULL para salvar no banco
            $dados['hidIdExpectador'] = !$formulario['hidIdExpectador'] == "" ? $formulario['hidIdExpectador'] : NULL;
            $dados['cboHoraTirolesa'] = !$formulario['cboHoraTirolesa'] == "" ? $formulario['cboHoraTirolesa'] : NULL;
            $dados['cboTrintaMinMontanhaRussa'] = !$formulario['cboTrintaMinMontanhaRussa'] == "" ? $formulario['cboTrintaMinMontanhaRussa'] : NULL;
            $dados['cboQuinzeMinCabum'] = !$formulario['cboQuinzeMinCabum'] == "" ? $formulario['cboQuinzeMinCabum'] : NULL;
            $dados['cboHoraRodaGigante'] = !$formulario['cboHoraRodaGigante'] == "" ? $formulario['cboHoraRodaGigante'] : NULL;
            $dados['chkBrinquedo'] = isset($formulario['chkBrinquedo']) ? $formulario['chkBrinquedo'] : NULL;

            //Termo responsabilidade
            $dados['fileTermoResponsabilidade'] = !$_FILES['fileTermoResponsabilidade']['name'] == "" ? $_FILES['fileTermoResponsabilidade'] : "";



            if ($dados['fileTermoResponsabilidade'] == "") {

                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                ];

                $dados['termoErro'] = 'Necessário o envio de um termo de responsabilidade';
            } elseif(!$this->brinquedosModel->validaHorariosTirolsa($dados)) {

                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                ];
                
                $horarioErroCadastro = "Tirolesa";
                $temErroCadastro = true;

            } elseif(!$this->brinquedosModel->validaHorariosMontanha($dados)){

                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                ];

                $horarioErroCadastro = "Montanha Russa";
                $temErroCadastro = true;
            } elseif(!$this->brinquedosModel->validaHorariosKabum($dados)) {
                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                ];

                $horarioErroCadastro = "Kabum";
                $temErroCadastro = true;
            } elseif(!$this->brinquedosModel->validaHorariosRodaGigante($dados)){
                
                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                ];

                $horarioErroCadastro = "Roda Gigante";
                $temErroCadastro = true;
            }
            
            
            
            else {
                // exit();
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
                'quinzeMinCabum' => $quinzeMinCabum,
                'termoErro' => '',
                'tirolesaErro' => ''
            ];
        }

        if ($temErroCadastro) {
            Alertas::mensagem('horarioErroCadastrar', 'Horário selecionado do brinquedo <b>' . $horarioErroCadastro . '</b> já em uso. <br> Favor escolher outro', 'alert alert-danger');
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
        $termoResponsabilidade = $this->brinquedosModel->lerAnexosPorId($id);

        $temErroEditar = false;
        $horarioErroEditar = '';

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = ['fk_espectador' => $id];
            //Brinquedos agendados
            $dados['cboHoraTirolesa'] = isset($formulario['cboHoraTirolesa']) ? $formulario['cboHoraTirolesa'] : NULL;
            $dados['cboTrintaMinMontanhaRussa'] = isset($formulario['cboTrintaMinMontanhaRussa']) ? $formulario['cboTrintaMinMontanhaRussa'] : NULL;
            $dados['cboQuinzeMinCabum'] = isset($formulario['cboQuinzeMinCabum']) ? $formulario['cboQuinzeMinCabum'] : NULL;
            $dados['cboHoraRodaGigante'] = isset($formulario['cboHoraRodaGigante']) ? $formulario['cboHoraRodaGigante'] : NULL;

            //Brinquedos não agendados
            $dados['chkBrinquedo'] = isset($formulario['chkBrinquedo']) ? $formulario['chkBrinquedo'] : NULL;
            $dados['cboHoraTirolesaNA'] = !$formulario['cboHoraTirolesaNA'] == "" ? $formulario['cboHoraTirolesaNA'] : NULL;
            $dados['cboTrintaMinMontanhaRussaNA'] = !$formulario['cboTrintaMinMontanhaRussaNA'] == "" ? $formulario['cboTrintaMinMontanhaRussaNA'] : NULL;
            $dados['cboQuinzeMinCabumNA'] = !$formulario['cboQuinzeMinCabumNA'] == "" ? $formulario['cboQuinzeMinCabumNA'] : NULL;
            $dados['cboHoraRodaGiganteNA'] = !$formulario['cboHoraRodaGiganteNA'] == "" ? $formulario['cboHoraRodaGiganteNA'] : NULL;

            //Termo responsabilidade input
            $dados['fileTermoResponsabilidade'] = !$_FILES['fileTermoResponsabilidade']['name'] == "" ? $_FILES['fileTermoResponsabilidade'] : "";

            //Termo anexo
            $dados['termoResponsabilidade'] = empty($termoResponsabilidade) ? "" : $termoResponsabilidade;


            if ($dados['fileTermoResponsabilidade'] == "" && $dados['termoResponsabilidade'] == "") {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];

                $dados['termoErro'] = "Necessário o envio de um termo de responsabilidade";
            } else if (!$this->brinquedosModel->validaHorariosTirolsa($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['tirolesaErro'] = "Horário Tirolesa já esta em uso";
                $horarioErroEditar = "Tirolesa";
                $temErroEditar = true;
            } elseif (!$this->brinquedosModel->validaHorariosMontanha($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['montanhaErro'] = "Horário Montanha Russa já esta em uso";
                $horarioErroEditar = "Montanha russa";
                $temErroEditar = true;
            } elseif (!$this->brinquedosModel->validaHorariosKabum($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['kabumErro'] = "Horário Kabum já esta em uso";
                $horarioErroEditar = "Kabum";
                $temErroEditar = true;
            } elseif (!$this->brinquedosModel->validaHorariosRodaGigante($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                    'quinzeMinCabum' => $quinzeMinCabum,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['rodaGiganteErro'] = "Horário Roda Gigante já esta em uso";
                $horarioErroEditar = "Roda Gigante";
                $temErroEditar = true;
            } else {

                // var_dump($dados);
                // exit();

                if ($this->brinquedosModel->editarAgendamentoBrinquedo($dados)) {

                    Alertas::mensagem('brinquedos', 'Agendamento atualizado com sucesso');
                    Redirecionamento::redirecionar('BrinquedosController');
                } else {
                    Alertas::mensagem('brinquedos', 'Não foi possível atualizar o agendamento', 'alert alert-danger');
                    Redirecionamento::redirecionar('BrinquedosController');
                }
            }
        } else {

            $dados = [
                'agendamento' => $agendamento,
                'brinquedos' => $brinquedos,
                'horaTirolesa' => $horaTirolesa,
                'horaRodaGigante' => $horaRodaGigante,
                'trintaMinMontanhaRussa' => $trintaMinMontanhaRussa,
                'quinzeMinCabum' => $quinzeMinCabum,
                'termoResponsabilidade' => $termoResponsabilidade,
                'termoErro' => ''
            ];
        }

        if ($temErroEditar) {
            Alertas::mensagem('horarioErroEditar', 'Horário selecionado do brinquedo <b>' . $horarioErroEditar . '</b> já em uso. <br> Favor escolher outro', 'alert alert-danger');
        }


        //Retorna para a view
        $this->view('brinquedos/editar', $dados);
    }


    public function apagarAgendamento($id_brinquedo)
    {


        $dados = [
            'id_brinquedo' => $id_brinquedo,
            'id_espectador' => $_GET['id_espectador']
        ];

        if ($this->brinquedosModel->apagarAgendamentoPorId($dados)) {

            //Se vazio, todos os agendamentos foram removidos
            if (empty($this->brinquedosModel->lerAgendamentoPorId($dados['id_espectador']))) {

                //Se vazio ja remove a o termo de responsabilidade
                $this->deletarImagem($dados['id_espectador']);

                Alertas::mensagem('brinquedos', 'Todos os agendamentos foram removidos com sucesso.');
                Redirecionamento::redirecionar('BrinquedosController');
            } else {
                Alertas::mensagem('remocaoAgendamento', 'Remoção do agendamento do brinquedo realizado com sucesso.');
                Redirecionamento::redirecionar('BrinquedosController/editar/' . $dados['id_espectador']);
            }
        } else {
            Alertas::mensagem('remocaoAgendamento', 'Não foi possível remover o agendamento do brinquedo', 'alert alert-danger');
            Redirecionamento::redirecionar('BrinquedosController/editar/' . $dados['id_espectador']);
        }
    }

    public function deletar($id)
    {

        $id = filter_var($id, FILTER_VALIDATE_INT);
        $termoResponsabilidade = $this->brinquedosModel->lerAnexosPorId($id);

        $dados = [
            'id_espectador' => $id,
            'termoResponsabilidade' => $termoResponsabilidade
        ];

        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if ($id && $metodo == 'POST') {

            if ($this->brinquedosModel->apagarAgendamentos($dados)) {

                //Para exibir mensagem success , não precisa informar o tipo de classe
                Alertas::mensagem('brinquedos', 'Agendamentos deletados com sucesso');
                Redirecionamento::redirecionar('BrinquedosController');
            } else {
                Alertas::mensagem('brinquedos', 'Não foi possível apagar os agendamentos do usuário', 'alert alert-danger');
                Redirecionamento::redirecionar('BrinquedosController');
            }
        } else {
            Alertas::mensagem('brinquedos', 'Não foi possível apagar os agendamentos do usuário', 'alert alert-danger');
            Redirecionamento::redirecionar('BrinquedosController');
        }
    }

    public function deletarImagem($id)
    {
        $termoResponsabilidade = $this->brinquedosModel->lerAnexosPorId($id);

        $dados = [
            'termoResponsabilidade' => $termoResponsabilidade
        ];

        if ($this->brinquedosModel->deletarFoto($dados)) {
            Alertas::mensagem('imagemResponsabilidade', 'Imagem deletada com sucesso.');
            Redirecionamento::redirecionar('BrinquedosController/editar/' . $termoResponsabilidade[0]->fk_espectador);
        } else {
            Alertas::mensagem('imagemResponsabilidade', 'Não foi deletar a imagem', 'alert alert-danger');
            Redirecionamento::redirecionar('BrinquedosController/editar/' . $termoResponsabilidade[0]->fk_espectador);
        }
    }
}
