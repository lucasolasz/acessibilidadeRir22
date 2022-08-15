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
                $this->db->bind("fk_espectador", $dados['cboEspectador']);
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


        if ($armazenaBrinquedoErro) {
            return false;
        } else {
            return true;
        }
    }

    public function editarCadeiraRodas($dados)
    {
        $editarCadeiraErro = false;

        $this->db->query("UPDATE tb_cadeira_rodas SET num_cadeira_rodas = :num_cadeira_rodas WHERE id_cadeira_rodas = :id_cadeira_rodas");
        $this->db->bind("num_cadeira_rodas", $dados['txtCadeiraRodas']);
        $this->db->bind("id_cadeira_rodas", $dados['id_cadeira_rodas']);
        if (!$this->db->executa()) {
            $editarCadeiraErro = true;
        }

        if ($editarCadeiraErro) {
            return false;
        } else {
            return true;
        }
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



    public function deletarCadeira($dados)
    {
        $id_cadeira = $dados['id_cadeira'];

        $deletarCadeiraErro = false;

        //Deleta da tabela
        $this->db->query("DELETE FROM tb_cadeira_rodas WHERE id_cadeira_rodas = :id_cadeira_rodas");
        $this->db->bind("id_cadeira_rodas", $id_cadeira);
        if (!$this->db->executa()) {
            $deletarCadeiraErro = true;
        }

        if ($deletarCadeiraErro) {
            return false;
        } else {
            return true;
        }
    }
}
