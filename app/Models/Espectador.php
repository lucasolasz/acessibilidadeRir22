<?php

class Espectador
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function visualizarEspectador()
    {
        $this->db->query("SELECT * FROM tb_espectador ORDER BY ds_nome_espectador");

        return $this->db->resultados();
    }

    public function existeEspectador($dados)
    {
        $this->db->query("SELECT ds_documento_espectador FROM tb_espectador WHERE ds_documento_espectador = :ds_documento_espectador");

        $this->db->bind("ds_documento_espectador", $dados['txtDocumento']);

        if ($this->db->resultado()) {
            return true;
        } else {
            return false;
        }
    }

    public function armazenarEspectador($dados){
        
        $this->db->query("INSERT INTO tb_espectador (ds_nome_espectador) VALUES (:ds_nome_espectador)");

        $this->db->bind("ds_nome_espectador", $dados['txtNomeEspectador']);
       
        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }

    }

    public function lerCondicao(){

        $this->db->query("SELECT * FROM tb_condicao ORDER BY ds_condicao");

        return $this->db->resultados();
    }

    public function lerAcessoServico(){

        $this->db->query("SELECT * FROM tb_acesso_servico ORDER BY ds_acesso_servico");

        return $this->db->resultados();
    }

    public function lerTipoDeficiencia(){

        $this->db->query("SELECT * FROM tb_tipo_deficiencia ORDER BY ds_tipo_deficiencia");

        return $this->db->resultados();
    }

    public function lerCadeiraDeRodas(){

        $this->db->query("SELECT * FROM tb_cadeira_rodas ORDER BY num_cadeira_rodas");

        return $this->db->resultados();
    }

    public function lerGuardaVolumes(){

        $this->db->query("SELECT * FROM tb_guarda_volume ORDER BY ds_guarda_volume");

        return $this->db->resultados();
    }
}
