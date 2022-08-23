<?php

class PlataformasController extends Controller
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
        $this->plataformaModel = $this->model("Plataformas");
    }

    //Método padrão que é invocado ao chamar a controller
    public function index()
    {

        $dados = [

            // 'marcacoes' =>  $this->plataformaModel->visualizarMarcacoes()            
        ];

        //Retorna para a view
        $this->view('plataformas/index', $dados);
    }

    public function cadastrar($id = null)
    {
        $visualizarPlataformaMundo = $this->plataformaModel->visualizarPlataformaMundo();
        $visualizarMarcacoesPlataMundo = $this->plataformaModel->visualizarMarcacoesPlataMundo();
        $visualizarPlataformaSunset = $this->plataformaModel->visualizarPlataformaSunset();
        $visualizarMarcacoesPlataSunset = $this->plataformaModel->visualizarMarcacoesPlataSunset();
        $espectador = $this->plataformaModel->visualizarEspectadorPeloId($id);


        if (isset($_GET['plataforma'])) {
            $plataformaEscolhida = $_GET['plataforma'];
        } else {
            $plataformaEscolhida = "";
        }

        //Conta a quantidade de espaços que o espectador pode reservar
        $numEspaçosDisponiveis = 0;

        if ($espectador->id_espectador != NULL) {
            $numEspaçosDisponiveis += 1;
        }
        if ($espectador->fk_acompanhante != NULL) {
            $numEspaçosDisponiveis += 1;
        }
        if ($espectador->qtd_menor_idade != NULL) {
            $numEspaçosDisponiveis += (int)$espectador->qtd_menor_idade;
        }

        $dados = [
            'numEspaçosDisponiveis' => $numEspaçosDisponiveis,
            'espectador' => $espectador,
            'visualizarPlataformaMundo' => $visualizarPlataformaMundo,
            'visualizarMarcacoesPlataMundo' => $visualizarMarcacoesPlataMundo,
            'visualizarPlataformaSunset' => $visualizarPlataformaSunset,
            'visualizarMarcacoesPlataSunset' => $visualizarMarcacoesPlataSunset
        ];
        // }

        if ($plataformaEscolhida == 'M') {
            $this->view('plataformas/tablePlataformaMundo', $dados);
        }

        if ($plataformaEscolhida == 'S') {
            $this->view('plataformas/tablePlataformaSunset', $dados);
        }

        if ($plataformaEscolhida == "") {
            //Retorna para a view
            $this->view('plataformas/cadastrar', $dados);
        }
    }

    public function cadastrarPlataformaMundo()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            $dados['id_espectador'] = isset($formulario['hidIdExpectador']) ? $formulario['hidIdExpectador'] : NULL;
            $dados['chkReservaMundo'] = isset($formulario['chkReservaMundo']) ? $formulario['chkReservaMundo'] : "";

            if ($this->plataformaModel->armazenarReservaMundo($dados)) {

                Alertas::mensagem('plataforma', 'Marcações realizadas com sucesso');
                Redirecionamento::redirecionar('PlataformasController');
            } else {

                Alertas::mensagem('plataforma', 'Não foi possível realizar as marcações', 'alert alert-danger');
                Redirecionamento::redirecionar('PlataformasController');
            }
        }
    }

    public function cadastrarPlataformaSunset()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            $dados['id_espectador'] = isset($formulario['hidIdExpectador']) ? $formulario['hidIdExpectador'] : NULL;
            $dados['chkReservaSunset'] = isset($formulario['chkReservaSunset']) ? $formulario['chkReservaSunset'] : "";

            if ($this->plataformaModel->armazenarReservaSunset($dados)) {

                Alertas::mensagem('plataforma', 'Marcações realizadas com sucesso');
                Redirecionamento::redirecionar('PlataformasController');
            } else {

                Alertas::mensagem('plataforma', 'Não foi possível realizar as marcações', 'alert alert-danger');
                Redirecionamento::redirecionar('PlataformasController');
            }
        }
    }

    public function editar($id)
    {
        $espectador = $this->plataformaModel->visualizarEspectadorPeloId($id);
        $contagemMarcacoesMundo = $this->plataformaModel->contagemMarcacoesMundo($id);
        $contagemMarcacoesSunset = $this->plataformaModel->contagemMarcacoesSunset($id);
        $visualizarPlataformaMundo = $this->plataformaModel->visualizarPlataformaMundo();
        $visualizarPlataformaSunset = $this->plataformaModel->visualizarPlataformaSunset();
        $visualizarMarcacoesPlataMundo = $this->plataformaModel->visualizarMarcacoesPlataMundo();
        $visualizarMarcacoesPlataSunset = $this->plataformaModel->visualizarMarcacoesPlataSunset();

        if (isset($_GET['plataforma'])) {
            $plataformaEscolhida = $_GET['plataforma'];
        } else {
            $plataformaEscolhida = "";
        }

        //Conta a quantidade de espaços que o espectador pode reservar
        $numEspaçosDisponiveis = 0;

        if ($espectador->id_espectador != NULL) {
            $numEspaçosDisponiveis += 1;
        }
        if ($espectador->fk_acompanhante != NULL) {
            $numEspaçosDisponiveis += 1;
        }
        if ($espectador->qtd_menor_idade != NULL) {
            $numEspaçosDisponiveis += (int)$espectador->qtd_menor_idade;
        }

        $dados = [
            'espectador' => $espectador,
            'contagemMarcacoesSunset' => $contagemMarcacoesSunset,
            'visualizarPlataformaMundo' => $visualizarPlataformaMundo,
            'visualizarPlataformaSunset' => $visualizarPlataformaSunset,
            'visualizarMarcacoesPlataMundo' => $visualizarMarcacoesPlataMundo,
            'visualizarMarcacoesPlataSunset' => $visualizarMarcacoesPlataSunset
        ];

        //Realiza a subtração do total que o espectador pode marcar com a quantidade marcada
        $contagemFinalMundo = $numEspaçosDisponiveis - $contagemMarcacoesMundo->contagem;
        $dados['contagemMarcacoesMundo'] = $contagemFinalMundo;

        //Realiza a subtração do total que o espectador pode marcar com a quantidade marcada
        $contagemFinalSunset = $numEspaçosDisponiveis - $contagemMarcacoesSunset->contagem;
        $dados['contagemMarcacoesSunset'] = $contagemFinalSunset;


        if ($plataformaEscolhida == 'M') {

            $this->view('plataformas/tablePlataformaMundoEdit', $dados);
        }

        if ($plataformaEscolhida == 'S') {

            $this->view('plataformas/tablePlataformaSunsetEdit', $dados);
        }

        if ($plataformaEscolhida == '') {

            $this->view('plataformas/editar', $dados);
        }
    }



    public function editarPlataformaMundo()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            $dados['id_espectador'] = isset($formulario['hidIdExpectador']) ? $formulario['hidIdExpectador'] : NULL;
            $dados['chkReservaMundo'] = isset($formulario['chkReservaMundo']) ? $formulario['chkReservaMundo'] : "";

            if ($this->plataformaModel->editarReservaMundo($dados)) {

                Alertas::mensagem('plataforma', 'Marcações atualizadas com sucesso');
                Redirecionamento::redirecionar('PlataformasController');
            } else {

                Alertas::mensagem('plataforma', 'Não foi possível atualizar as marcações', 'alert alert-danger');
                Redirecionamento::redirecionar('PlataformasController');
            }
        }
    }

    public function editarPlataformaSunset()
    {

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {

            $dados['id_espectador'] = isset($formulario['hidIdExpectador']) ? $formulario['hidIdExpectador'] : NULL;
            $dados['chkReservaSunset'] = isset($formulario['chkReservaSunset']) ? $formulario['chkReservaSunset'] : "";

            if ($this->plataformaModel->editarReservaSunset($dados)) {

                Alertas::mensagem('plataforma', 'Marcações atualizadas com sucesso');
                Redirecionamento::redirecionar('PlataformasController');
            } else {

                Alertas::mensagem('plataforma', 'Não foi possível atualizar as marcações', 'alert alert-danger');
                Redirecionamento::redirecionar('PlataformasController');
            }
        }
    }

    public function deletar($id)
    {

        $id = filter_var($id, FILTER_VALIDATE_INT);

        $dados = [
            'id_cadeira' => $id,
        ];

        $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if ($id && $metodo == 'POST') {

            if ($this->plataformaModel->deletarCadeira($dados)) {

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



    public function buscaAjaxPlataformaEspectador()
    {
        //Retorna o valor da direita caso o valor da esquerda esteja ou não esteja settado (null coalesce operator)
        $dados['ds_nome_espectador'] = trim($_POST['ds_nome_espectador'] ?? "");

        //Comparação inline do valor passado para capturar apenas strings iniciados com letra seguida de numeros
        $ehMarcacao = preg_match('/^[a-zA-Z]\d+$/', $dados['ds_nome_espectador']) == 1;

        //Se for uma marcação que esta sendo buscada.
        if ($ehMarcacao) {
            $resultado = $this->plataformaModel->pesquisarMarcacao($dados);
        } else {
            $resultado = $this->plataformaModel->pesquisarEspectadorPlataforma($dados);
        }


        $fk_espectador_plataforma_sunset = $this->plataformaModel->visualizarMarcacoesPlataSunset();
        $fk_espectador_plataforma_mundo = $this->plataformaModel->visualizarMarcacoesPlataMundo();

        $dados = [
            'resultado' => $resultado,
            'fk_espectador_plataforma_sunset' => $fk_espectador_plataforma_sunset,
            'fk_espectador_plataforma_mundo' => $fk_espectador_plataforma_mundo
        ];

        //Retorna view crua
        $this->viewCrua('plataformas/buscaAjaxPlataformaEspectador', $dados);
    }

    public function checkInEspectadorSunset($id)
    {

        if ($this->plataformaModel->checkInEspectadorSunset($id)) {

            Alertas::mensagem('plataforma', 'Checkin Sunset realizado com sucesso');
            Redirecionamento::redirecionar('PlataformasController');
        } else {
            Alertas::mensagem('plataforma', 'Não foi possível dar checkin', 'alert alert-danger');
            Redirecionamento::redirecionar('PlataformasController');
        }
    }

    public function checkOutEspectadorSunset($id)
    {

        if ($this->plataformaModel->checkOutEspectadorSunset($id)) {

            Alertas::mensagem('plataforma', 'Checkout realizado com sucesso');
            Redirecionamento::redirecionar('PlataformasController');
        } else {
            Alertas::mensagem('plataforma', 'Não foi possível dar checkout', 'alert alert-danger');
            Redirecionamento::redirecionar('PlataformasController');
        }
    }

    public function checkInEspectadorMundo($id)
    {

        if ($this->plataformaModel->checkInEspectadorMundo($id)) {

            Alertas::mensagem('plataforma', 'Checkin Mundo realizado com sucesso');
            Redirecionamento::redirecionar('PlataformasController');
        } else {
            Alertas::mensagem('plataforma', 'Não foi possível dar checkin', 'alert alert-danger');
            Redirecionamento::redirecionar('PlataformasController');
        }
    }

    public function checkOutEspectadorMundo($id)
    {

        if ($this->plataformaModel->checkOutEspectadorMundo($id)) {

            Alertas::mensagem('plataforma', 'Checkout realizado com sucesso');
            Redirecionamento::redirecionar('PlataformasController');
        } else {
            Alertas::mensagem('plataforma', 'Não foi possível dar checkout', 'alert alert-danger');
            Redirecionamento::redirecionar('PlataformasController');
        }
    }


    public function limparMarcacoesSunset($id){

        if ($this->plataformaModel->limparMarcacoesSunset($id)) {

            Alertas::mensagem('plataforma', 'Limpeza das marcações realizada com sucesso');
            Redirecionamento::redirecionar('PlataformasController');
        } else {
            Alertas::mensagem('plataforma', 'Não foi possível realizar a limpeza das marcações', 'alert alert-danger');
            Redirecionamento::redirecionar('PlataformasController');
        }

    }

    public function limparMarcacoesMundo($id){

        if ($this->plataformaModel->limparMarcacoesMundo($id)) {

            Alertas::mensagem('plataforma', 'Limpeza das marcações realizada com sucesso');
            Redirecionamento::redirecionar('PlataformasController');
        } else {
            Alertas::mensagem('plataforma', 'Não foi possível realizar a limpeza das marcações', 'alert alert-danger');
            Redirecionamento::redirecionar('PlataformasController');
        }

    }
}
