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
        $cadeiraRodas =  $this->plataformaModel->lerCadeiraPorId($id);

        $formulario = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {


            $dados = [
                'txtCadeiraRodas' => trim($formulario['txtCadeiraRodas']),
                'id_cadeira_rodas' => $id
            ];

            if ($this->plataformaModel->editarCadeiraRodas($dados)) {

                Alertas::mensagem('cadeiraRodas', 'Cadeira atualizada com sucesso');
                Redirecionamento::redirecionar('CadeiraRodasController');
            } else {
                Alertas::mensagem('cadeiraRodas', 'Não foi possível atualizar a cadeira', 'alert alert-danger');
                Redirecionamento::redirecionar('CadeiraRodasController');
            }
        } else {

            $dados = [
                'cadeiraRodas' => $cadeiraRodas,
            ];
        }

        //Retorna para a view
        $this->view('plataformas/editar', $dados);
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
