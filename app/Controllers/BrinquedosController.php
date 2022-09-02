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
        $horaMontanhaRussa = $this->brinquedosModel->visualizarHoraMontanhaRussa();
        $quinzeMinMegaDrop = $this->brinquedosModel->visualizarQuinzeMinMegaDrop();
        $quinzeMinCarrosel = $this->brinquedosModel->visualizarQuinzeMinCarrosel();
        $quinzeMinDiscovery = $this->brinquedosModel->visualizarQuinzeMinDiscovery();

        
        $temErroCadastro = false;
        $horarioErroCadastro = '';

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            $dados = ['fk_espectador' => $id];

            //Precisou colocar estes campos null no cadastro, pois as funções de validações necessitam deles 
            $dados['cboHoraTirolesaNA'] = NULL;
            $dados['cboHoraMontanhaRussaNA'] = NULL;
            $dados['cboQuinzeMinMegaDropNA'] = NULL;
            $dados['cboHoraRodaGiganteNA'] = NULL;
            $dados['cboQuinzeCarroselNA'] = NULL;
            $dados['cboQuinzeDiscoveryNA'] = NULL;

            //Converte valores vazios para NULL para salvar no banco
            $dados['hidIdExpectador'] = !$formulario['hidIdExpectador'] == "" ? $formulario['hidIdExpectador'] : NULL;
            $dados['cboHoraTirolesa'] = !$formulario['cboHoraTirolesa'] == "" ? $formulario['cboHoraTirolesa'] : NULL;
            $dados['cboHoraMontanhaRussa'] = !$formulario['cboHoraMontanhaRussa'] == "" ? $formulario['cboHoraMontanhaRussa'] : NULL;
            $dados['cboQuinzeMinMegaDrop'] = !$formulario['cboQuinzeMinMegaDrop'] == "" ? $formulario['cboQuinzeMinMegaDrop'] : NULL;
            $dados['cboHoraRodaGigante'] = !$formulario['cboHoraRodaGigante'] == "" ? $formulario['cboHoraRodaGigante'] : NULL;
            $dados['cboQuinzeCarrosel'] = !$formulario['cboQuinzeCarrosel'] == "" ? $formulario['cboQuinzeCarrosel'] : NULL;
            $dados['cboQuinzeDiscovery'] = !$formulario['cboQuinzeDiscovery'] == "" ? $formulario['cboQuinzeDiscovery'] : NULL;
            $dados['chkBrinquedo'] = isset($formulario['chkBrinquedo']) ? $formulario['chkBrinquedo'] : NULL;

            //Termo responsabilidade
            $dados['fileTermoResponsabilidade'] = !$_FILES['fileTermoResponsabilidade']['name'] == "" ? $_FILES['fileTermoResponsabilidade'] : "";



            if ($dados['fileTermoResponsabilidade'] == "") {

                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery
                ];

                $dados['termoErro'] = 'Necessário o envio de um termo de responsabilidade';
            } elseif(!$this->brinquedosModel->validaHorariosTirolsa($dados)) {

                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery

                ];
                
                $horarioErroCadastro = "Tirolesa";
                $temErroCadastro = true;

            } elseif(!$this->brinquedosModel->validaHorariosMontanha($dados)){

                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery

                ];

                $horarioErroCadastro = "Montanha Russa";
                $temErroCadastro = true;
            } elseif(!$this->brinquedosModel->validaHorariosMegaDrop($dados)) {
                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery
                ];

                $horarioErroCadastro = "Mega drop";
                $temErroCadastro = true;
            } elseif(!$this->brinquedosModel->validaHorariosRodaGigante($dados)){
                
                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery
                ];

                $horarioErroCadastro = "Roda Gigante";
                $temErroCadastro = true;
            } elseif(!$this->brinquedosModel->validaHorariosCarrosel($dados)){
                
                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery
                ];

                $horarioErroCadastro = "Carrosel";
                $temErroCadastro = true;
            } elseif(!$this->brinquedosModel->validaHorariosDiscovery($dados)){
                
                $dados = [

                    'espectador' => $espectador,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery
                ];

                $horarioErroCadastro = "Discovery";
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
                'horaMontanhaRussa' => $horaMontanhaRussa,
                'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                'quinzeMinCarrosel' => $quinzeMinCarrosel,
                'quinzeMinDiscovery' => $quinzeMinDiscovery,
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
        $horaMontanhaRussa = $this->brinquedosModel->visualizarHoraMontanhaRussa();
        $quinzeMinMegaDrop = $this->brinquedosModel->visualizarQuinzeMinMegaDrop();
        $quinzeMinCarrosel = $this->brinquedosModel->visualizarQuinzeMinCarrosel();
        $quinzeMinDiscovery = $this->brinquedosModel->visualizarQuinzeMinDiscovery();
        $termoResponsabilidade = $this->brinquedosModel->lerAnexosPorId($id);

        $temErroEditar = false;
        $horarioErroEditar = '';

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = ['fk_espectador' => $id];
            //Brinquedos agendados
            $dados['cboHoraTirolesa'] = isset($formulario['cboHoraTirolesa']) ? $formulario['cboHoraTirolesa'] : NULL;
            $dados['cboHoraMontanhaRussa'] = isset($formulario['cboHoraMontanhaRussa']) ? $formulario['cboHoraMontanhaRussa'] : NULL;
            $dados['cboHoraRodaGigante'] = isset($formulario['cboHoraRodaGigante']) ? $formulario['cboHoraRodaGigante'] : NULL;
            $dados['cboQuinzeMinMegaDrop'] = isset($formulario['cboQuinzeMinMegaDrop']) ? $formulario['cboQuinzeMinMegaDrop'] : NULL;
            $dados['cboQuinzeCarrosel'] = isset($formulario['cboQuinzeCarrosel']) ? $formulario['cboQuinzeCarrosel'] : NULL;
            $dados['cboQuinzeDiscovery'] = isset($formulario['cboQuinzeDiscovery']) ? $formulario['cboQuinzeDiscovery'] : NULL;
            

            //Brinquedos não agendados
            $dados['chkBrinquedo'] = isset($formulario['chkBrinquedo']) ? $formulario['chkBrinquedo'] : NULL;
            $dados['cboHoraTirolesaNA'] = !$formulario['cboHoraTirolesaNA'] == "" ? $formulario['cboHoraTirolesaNA'] : NULL;
            $dados['cboHoraMontanhaRussaNA'] = !$formulario['cboHoraMontanhaRussaNA'] == "" ? $formulario['cboHoraMontanhaRussaNA'] : NULL;
            $dados['cboQuinzeMinMegaDropNA'] = !$formulario['cboQuinzeMinMegaDropNA'] == "" ? $formulario['cboQuinzeMinMegaDropNA'] : NULL;            
            $dados['cboHoraRodaGiganteNA'] = !$formulario['cboHoraRodaGiganteNA'] == "" ? $formulario['cboHoraRodaGiganteNA'] : NULL;
            $dados['cboQuinzeCarroselNA'] = !$formulario['cboQuinzeCarroselNA'] == "" ? $formulario['cboQuinzeCarroselNA'] : NULL;
            $dados['cboQuinzeDiscoveryNA'] = !$formulario['cboQuinzeDiscoveryNA'] == "" ? $formulario['cboQuinzeDiscoveryNA'] : NULL;

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
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];

                $dados['termoErro'] = "Necessário o envio de um termo de responsabilidade";
            } else if (!$this->brinquedosModel->validaHorariosTirolsa($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery,
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
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['montanhaErro'] = "Horário Montanha Russa já esta em uso";
                $horarioErroEditar = "Montanha russa";
                $temErroEditar = true;
            } elseif (!$this->brinquedosModel->validaHorariosMegaDrop($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['megaDropErro'] = "Horário Mega drop já esta em uso";
                $horarioErroEditar = "Mega drop";
                $temErroEditar = true;
            } elseif (!$this->brinquedosModel->validaHorariosRodaGigante($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['rodaGiganteErro'] = "Horário Roda Gigante já esta em uso";
                $horarioErroEditar = "Roda Gigante";
                $temErroEditar = true;
            } elseif (!$this->brinquedosModel->validaHorariosCarrosel($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['carroselErro'] = "Horário Carrosel já esta em uso";
                $horarioErroEditar = "Carrosel";
                $temErroEditar = true;


            } elseif (!$this->brinquedosModel->validaHorariosDiscovery($dados)) {

                $dados = [
                    'agendamento' => $agendamento,
                    'brinquedos' => $brinquedos,
                    'horaTirolesa' => $horaTirolesa,
                    'horaRodaGigante' => $horaRodaGigante,
                    'horaMontanhaRussa' => $horaMontanhaRussa,
                    'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                    'quinzeMinCarrosel' => $quinzeMinCarrosel,
                    'quinzeMinDiscovery' => $quinzeMinDiscovery,
                    'termoResponsabilidade' => $termoResponsabilidade,
                ];
                $dados['discoveryErro'] = "Horário Discovery já esta em uso";
                $horarioErroEditar = "Discovery";
                $temErroEditar = true;
            
            }
            
            
            else {

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
                'horaMontanhaRussa' => $horaMontanhaRussa,
                'quinzeMinMegaDrop' => $quinzeMinMegaDrop,
                'quinzeMinCarrosel' => $quinzeMinCarrosel,
                'quinzeMinDiscovery' => $quinzeMinDiscovery,
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
