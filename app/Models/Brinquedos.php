<?php

class Brinquedos
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function visualizarAgendamntos()
    {
        $this->db->query("SELECT DISTINCT te.id_espectador, te.ds_nome_espectador, tc.ds_condicao, ta.ds_nome_acompanhante FROM tb_espectador te 
        JOIN tb_agenda_brinquedo tab ON tab.fk_espectador = te.id_espectador
        LEFT JOIN tb_condicao tc ON tc.id_condicao = te.fk_condicao
        LEFT JOIN tb_acompanhante ta ON ta.id_acompanhante = te.fk_acompanhante ");
        return $this->db->resultados();
    }

    public function visualizarBrinquedos()
    {
        $this->db->query("SELECT * FROM tb_brinquedo");
        return $this->db->resultados();
    }

    public function visualizarHoraTirolesa()
    {
        $this->db->query("SELECT * FROM tb_hora th 
        WHERE th.id_hora NOT IN (SELECT DISTINCT(id_hora) FROM tb_hora th2 JOIN tb_agenda_brinquedo tab ON th2.id_hora = tab.fk_hora_tirolesa)");
        return $this->db->resultados();
    }

    public function visualizarHoraRogaGigante()
    {
        $this->db->query("SELECT * FROM tb_hora th 
        WHERE th.id_hora NOT IN (SELECT distinct(id_hora) FROM tb_hora th2 JOIN tb_agenda_brinquedo tab ON th2.id_hora = tab.fk_hora_roda_gigante)");
        return $this->db->resultados();
    }

    public function visualizarTrintaMinMontanhaRussa()
    {
        $this->db->query("SELECT * FROM tb_trinta_min ttm  
        WHERE ttm.id_trinta_min NOT IN (SELECT DISTINCT(ttm2.id_trinta_min) FROM tb_trinta_min ttm2 JOIN tb_agenda_brinquedo tab ON ttm2.id_trinta_min = tab.fk_trinta_min)");
        return $this->db->resultados();
    }
    public function visualizarQuinzeMinCabum()
    {
        $this->db->query("SELECT * FROM tb_quinze_min tqm  
        WHERE tqm.id_quinze_min NOT IN (SELECT DISTINCT(tqm2.id_quinze_min) FROM tb_quinze_min tqm2 JOIN tb_agenda_brinquedo tab ON tqm2.id_quinze_min = tab.fk_quinze_min)");
        return $this->db->resultados();
    }


    public function armazenarAgendamentoBrinquedo($dados)
    {
        $armazenaBrinquedoErro = false;

        // var_dump($dados);
        // exit();


        if (!$dados['chkBrinquedo'] == NULL) {

            foreach ($dados['chkBrinquedo'] as $chkBrinquedo) {

                $this->db->query("INSERT INTO tb_agenda_brinquedo (fk_espectador, fk_brinquedo, fk_hora_tirolesa, fk_hora_roda_gigante, fk_trinta_min, fk_quinze_min) VALUES (:fk_espectador, :fk_brinquedo, :fk_hora_tirolesa, :fk_hora_roda_gigante, :fk_trinta_min, :fk_quinze_min)");
                $this->db->bind("fk_espectador", $dados['hidIdExpectador']);
                $this->db->bind("fk_brinquedo", $chkBrinquedo);
                $this->db->bind("fk_hora_tirolesa", $dados['cboHoraTirolesa']);
                $this->db->bind("fk_hora_roda_gigante", $dados['cboHoraRodaGigante']);
                $this->db->bind("fk_trinta_min", $dados['cboTrintaMinMontanhaRussa']);
                $this->db->bind("fk_quinze_min", $dados['cboQuinzeMinCabum']);
                if (!$this->db->executa()) {
                    $armazenaBrinquedoErro = true;
                }
            }
        } else {
            return false;
        }


        if (!$dados['fileTermoResponsabilidade'] == "") {

            $pastaArquivo = "espectador_id_" . $dados['hidIdExpectador'];
            $upload = new Upload();

            $upload->imagem($dados['fileTermoResponsabilidade'], NULL, 'temp');

            if (!$upload->getErro() == NULL) {
                return false;
                // echo $upload->getErro() . '<br>';
            } else {

                //Inicio do processamento de compressao
                $nomeArquivo = $upload->getResultado();

                //Path da imagem que foi feito upload  (pasta temp)           
                $path_arquivo = $upload->getPath() . DIRECTORY_SEPARATOR . $nomeArquivo;

                //Cria pasta dos arquivos individualmente de acordo com id
                if (!file_exists($upload->getPathDefault() . DIRECTORY_SEPARATOR . $pastaArquivo)) {
                    mkdir($upload->getPathDefault() . DIRECTORY_SEPARATOR . $pastaArquivo, 0777);
                }
                $novoDiretorio = $upload->getPathDefault() . DIRECTORY_SEPARATOR . $pastaArquivo;

                //Monta o diretorio destino da pagina comprimida
                $destination_img = $novoDiretorio . DIRECTORY_SEPARATOR . $nomeArquivo;

                //Executa a compressao
                ComprimirFoto::comprimir($path_arquivo, $destination_img, 40);

                //Invoca metodo para deletar o arquivo temporario
                $upload->deletarArquivo(null, $path_arquivo);

                if ($upload->getResultado()) {

                    $this->db->query("INSERT INTO tb_anexo (fk_espectador, nm_path_arquivo, nm_arquivo, fk_usuario, chk_termo_brinquedo) VALUES (:fk_espectador, :nm_path_arquivo, :nm_arquivo, :fk_usuario, :chk_termo_brinquedo)");
                    $this->db->bind("fk_espectador", $dados['hidIdExpectador']);
                    $this->db->bind("nm_path_arquivo", $novoDiretorio);
                    $this->db->bind("nm_arquivo", $nomeArquivo);
                    $this->db->bind("fk_usuario", $_SESSION['id_usuario']);
                    $this->db->bind("chk_termo_brinquedo", 'S');
                    if (!$this->db->executa()) {
                        $armazenaBrinquedoErro = true;
                    }
                } else {
                    return false;
                }
            }
        }


        if ($armazenaBrinquedoErro) {
            return false;
        } else {
            return true;
        }
    }

    public function editarAgendamentoBrinquedo($dados)
    {
        $editarBrinquedoErro = false;

        // var_dump($dados);
        // exit();

        if (!$dados['chkBrinquedo'] == NULL) {

            // echo "entrei";

            foreach ($dados['chkBrinquedo'] as $chkBrinquedo) {
                $this->db->query("INSERT INTO tb_agenda_brinquedo (fk_espectador, fk_brinquedo, fk_hora_tirolesa, fk_hora_roda_gigante, fk_trinta_min, fk_quinze_min) VALUES (:fk_espectador, :fk_brinquedo, :fk_hora_tirolesa, :fk_hora_roda_gigante, :fk_trinta_min, :fk_quinze_min)");

                $this->db->bind("fk_espectador", $dados['fk_espectador']);
                $this->db->bind("fk_brinquedo", $chkBrinquedo);
                $this->db->bind("fk_hora_tirolesa", $dados['cboHoraTirolesaNA']);
                $this->db->bind("fk_hora_roda_gigante", $dados['cboHoraRodaGiganteNA']);
                $this->db->bind("fk_trinta_min", $dados['cboTrintaMinMontanhaRussaNA']);
                $this->db->bind("fk_quinze_min", $dados['cboQuinzeMinCabumNA']);
                if (!$this->db->executa()) {
                    $editarBrinquedoErro = true;
                }
            }
        }


        if (!$dados['cboHoraTirolesa'] == NULL) {

            $this->db->query("UPDATE tb_agenda_brinquedo SET 
            fk_hora_tirolesa = :fk_hora_tirolesa            
            WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_hora_tirolesa", $dados['cboHoraTirolesa']);
            $this->db->bind("fk_espectador", $dados['fk_espectador']);
            if (!$this->db->executa()) {
                $editarBrinquedoErro = true;
            }
        }


        if (!$dados['cboTrintaMinMontanhaRussa'] == NULL) {

            $this->db->query("UPDATE tb_agenda_brinquedo SET 
            fk_trinta_min = :fk_trinta_min            
            WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_trinta_min", $dados['cboTrintaMinMontanhaRussa']);
            $this->db->bind("fk_espectador", $dados['fk_espectador']);
            if (!$this->db->executa()) {
                $editarBrinquedoErro = true;
            }
        }

        if (!$dados['cboQuinzeMinCabum'] == NULL) {

            $this->db->query("UPDATE tb_agenda_brinquedo SET 
            fk_quinze_min = :fk_quinze_min            
            WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_quinze_min", $dados['cboQuinzeMinCabum']);
            $this->db->bind("fk_espectador", $dados['fk_espectador']);
            if (!$this->db->executa()) {
                $editarBrinquedoErro = true;
            }
        }


        if (!$dados['cboHoraRodaGigante'] == NULL) {

            $this->db->query("UPDATE tb_agenda_brinquedo SET 
            fk_hora_roda_gigante = :fk_hora_roda_gigante            
            WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_hora_roda_gigante", $dados['cboHoraRodaGigante']);
            $this->db->bind("fk_espectador", $dados['fk_espectador']);
            if (!$this->db->executa()) {
                $editarBrinquedoErro = true;
            }
        }


        if (!$dados['fileTermoResponsabilidade'] == "") {

            //Se entrar aqui na edição, está sendo feita uma substituição         
            $pastaArquivo = "espectador_id_" . $dados['fk_espectador'];
            $upload = new Upload();

            if (!empty($dados['termoResponsabilidade'])) {

                //Deleta registro da imagem no banco
                $this->db->query("DELETE FROM tb_anexo WHERE fk_espectador = :fk_espectador AND chk_termo_brinquedo = 'S'");
                $this->db->bind("fk_espectador", $dados['fk_espectador']);
                $this->db->executa();

                //Usado para deletar o arquivo fisico no diretorio
                $path_arquivo_anterior = $dados['termoResponsabilidade'][0]->nm_path_arquivo . DIRECTORY_SEPARATOR . $dados['termoResponsabilidade'][0]->nm_arquivo;

                //Invoca metodo para deletar o arquivo anterior para ser substituido
                $upload->deletarArquivo(null, $path_arquivo_anterior);
            }

            $upload->imagem($dados['fileTermoResponsabilidade'], NULL, 'temp');

            if (!$upload->getErro() == NULL) {
                return false;
                // echo $upload->getErro() . '<br>';
            } else {

                //Inicio do processamento de compressao
                $nomeArquivo = $upload->getResultado();

                //Path da imagem que foi feito upload  (pasta temp)           
                $path_arquivo = $upload->getPath() . DIRECTORY_SEPARATOR . $nomeArquivo;

                //Cria pasta dos arquivos individualmente de acordo com id
                if (!file_exists($upload->getPathDefault() . DIRECTORY_SEPARATOR . $pastaArquivo)) {
                    mkdir($upload->getPathDefault() . DIRECTORY_SEPARATOR . $pastaArquivo, 0777);
                }
                $novoDiretorio = $upload->getPathDefault() . DIRECTORY_SEPARATOR . $pastaArquivo;

                //Monta o diretorio destino da pagina comprimida
                $destination_img = $novoDiretorio . DIRECTORY_SEPARATOR . $nomeArquivo;

                //Executa a compressao
                ComprimirFoto::comprimir($path_arquivo, $destination_img, 40);

                //Invoca metodo para deletar o arquivo temporario
                $upload->deletarArquivo(null, $path_arquivo);

                if ($upload->getResultado()) {

                    $this->db->query("INSERT INTO tb_anexo (fk_espectador, nm_path_arquivo, nm_arquivo, fk_usuario, chk_termo_brinquedo) VALUES (:fk_espectador, :nm_path_arquivo, :nm_arquivo, :fk_usuario, :chk_termo_brinquedo)");
                    $this->db->bind("fk_espectador", $dados['fk_espectador']);
                    $this->db->bind("nm_path_arquivo", $novoDiretorio);
                    $this->db->bind("nm_arquivo", $nomeArquivo);
                    $this->db->bind("fk_usuario", $_SESSION['id_usuario']);
                    $this->db->bind("chk_termo_brinquedo", 'S');
                    if (!$this->db->executa()) {
                        $editarBrinquedoErro = true;
                    }
                } else {
                    return false;
                }
            }
        }


        if ($editarBrinquedoErro) {
            return false;
        } else {
            return true;
        }
    }

    public function apagarAgendamentoPorId($dados)
    {
        $apagarAgendamento = false;

        // var_dump($dados);
        // exit();

        $this->db->query("DELETE FROM tb_agenda_brinquedo WHERE fk_espectador = :fk_espectador AND fk_brinquedo = :fk_brinquedo");
        $this->db->bind("fk_espectador", $dados['id_espectador']);
        $this->db->bind("fk_brinquedo", $dados['id_brinquedo']);
        if (!$this->db->executa()) {
            $apagarAgendamento = true;
        }

        if ($apagarAgendamento) {
            return false;
        } else {
            return true;
        }
    }

    public function lerAnexosPorId($id)
    {

        $this->db->query("SELECT * FROM tb_anexo WHERE fk_espectador = :fk_espectador AND chk_termo_brinquedo = 'S'");

        $this->db->bind("fk_espectador", $id);

        return $this->db->resultados();
    }



    public function lerAgendamentoPorId($id)
    {

        $this->db->query("SELECT id_brinquedo, ds_brinquedo, th.id_hora AS id_hora_tirolesa ,th.range_hora AS range_tirolesa, th2.id_hora AS id_hora_roda_gigante, th2.range_hora AS range_roda_gigante, tqm2.id_quinze_min AS id_quinze_cabum, tqm2.range_quinze_min AS range_cabum, ttm.id_trinta_min AS id_trinta_montanha, ttm.range_trinta_min range_montanha, te.id_espectador, te.ds_nome_espectador FROM tb_brinquedo tb 
        JOIN tb_agenda_brinquedo tab ON tab.fk_brinquedo = tb.id_brinquedo
        LEFT JOIN tb_hora th ON th.id_hora = tab.fk_hora_tirolesa
        LEFT JOIN tb_hora th2 ON th2.id_hora = tab.fk_hora_roda_gigante
        LEFT JOIN tb_trinta_min ttm ON ttm.id_trinta_min = tab.fk_trinta_min 
        LEFT JOIN tb_quinze_min tqm2 ON tqm2.id_quinze_min = tab.fk_quinze_min
        LEFT JOIN tb_espectador te ON te.id_espectador = tab.fk_espectador 
        where tab.fk_espectador = :fk_espectador;");
        $this->db->bind("fk_espectador", $id);
        return $this->db->resultados();
    }



    public function apagarAgendamentos($dados)
    {
        $id_espectador = $dados['id_espectador'];

        //Precisei colcoar desta forma, pois a função deletarFoto precisa receber um array que possui o array termoResponsabilidade
        $dadosResponsa = ['termoResponsabilidade' => $dados['termoResponsabilidade']];

        // var_dump($dadosResponsa);
        // exit();

        if (!empty($dadosResponsa)) {
            $this->deletarFoto($dadosResponsa);
        }

        $deletarAgendamentos = false;

        //Deleta da tabela
        $this->db->query("DELETE FROM tb_agenda_brinquedo WHERE fk_espectador = :fk_espectador");
        $this->db->bind("fk_espectador", $id_espectador);
        if (!$this->db->executa()) {
            $deletarAgendamentos = true;
        }

        if ($deletarAgendamentos) {
            return false;
        } else {
            return true;
        }
    }


    public function deletarFoto($dados)
    {
        //Monta string do diretório da imagem
        $path_arquivo = $dados['termoResponsabilidade'][0]->nm_path_arquivo . DIRECTORY_SEPARATOR . $dados['termoResponsabilidade'][0]->nm_arquivo;

        $upload = new Upload();
        $upload->deletarArquivo(null, $path_arquivo);

        //Deleta da tabela
        $this->db->query("DELETE FROM tb_anexo WHERE id_anexo = :id_anexo");
        $this->db->bind("id_anexo", $dados['termoResponsabilidade'][0]->id_anexo);


        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }
}
