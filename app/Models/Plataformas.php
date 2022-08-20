<?php

class Plataformas
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function visualizarCadeiraRodas()
    {
        $this->db->query("SELECT * FROM tb_cadeira_rodas tcr 
        LEFT JOIN tb_espectador te ON te.fk_cadeira_rodas = tcr.id_cadeira_rodas 
        LEFT JOIN tb_anexo ta ON ta.fk_espectador = te.id_espectador ORDER BY num_cadeira_rodas");
        return $this->db->resultados();
    }

    public function visualizarPlataformaMundo()
    {
        $this->db->query("SELECT * FROM tb_plataforma_mundo");
        return $this->db->resultados();
    }

    public function visualizarPlataformaSunset()
    {
        $this->db->query("SELECT * FROM tb_plataforma_sunset");
        return $this->db->resultados();
    }

    public function visualizarEspectadorPeloId($id)
    {
        $this->db->query("SELECT * FROM tb_espectador te 
        LEFT JOIN tb_acompanhante ta ON ta.id_acompanhante = te.fk_acompanhante 
        WHERE id_espectador = :id_espectador");
        $this->db->bind("id_espectador", $id);
        return $this->db->resultado();
    }

    public function visualizarMarcacoesPlataMundo(){

        $this->db->query("SELECT * FROM tb_marcacoes_mundo");
        return $this->db->resultados();
    }

    public function visualizarMarcacoesPlataSunset(){

        $this->db->query("SELECT * FROM tb_marcacoes_sunset");
        return $this->db->resultados();
    }

    public function armazenarReservaMundo($dados)
    {
        $armazenarReservaMundoErro = false;

        if (!$dados['chkReservaMundo'] == "") {

            foreach ($dados['chkReservaMundo'] as $chkReservaMundo) {

                $this->db->query("INSERT INTO tb_marcacoes_mundo (fk_espectador, fk_plataforma_mundo) VALUES (:fk_espectador, :fk_plataforma_mundo)");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                $this->db->bind("fk_plataforma_mundo", $chkReservaMundo);
                if (!$this->db->executa()) {
                    $armazenarReservaMundoErro = true;
                }
            }
        }

        if ($armazenarReservaMundoErro) {
            return false;
        } else {
            return true;
        }
    }

    public function armazenarReservaSunset($dados)
    {
        $armazenarReservaSunsetErro = false;

        if (!$dados['chkReservaSunset'] == "") {

            foreach ($dados['chkReservaSunset'] as $chkReservaSunset) {

                $this->db->query("INSERT INTO tb_marcacoes_sunset (fk_espectador, fk_plataforma_sunset) VALUES (:fk_espectador, :fk_plataforma_sunset)");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                $this->db->bind("fk_plataforma_sunset", $chkReservaSunset);
                if (!$this->db->executa()) {
                    $armazenarReservaSunsetErro = true;
                }
            }
        }

        if ($armazenarReservaSunsetErro) {
            return false;
        } else {
            return true;
        }
    }
}
