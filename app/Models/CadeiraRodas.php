<?php

class CadeiraRodas
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

    public function armazenarCadeiraRodas($dados)
    {
        $armazenaCadeiraErro = false;

        $this->db->query("INSERT INTO tb_cadeira_rodas (num_cadeira_rodas) VALUES (:num_cadeira_rodas)");
        $this->db->bind("num_cadeira_rodas", $dados['txtCadeiraRodas']);
        if (!$this->db->executa()) {
            $armazenaCadeiraErro = true;
        }

        if ($armazenaCadeiraErro) {
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

    public function lerCadeiraPorId($id)
    {

        $this->db->query("SELECT * FROM tb_cadeira_rodas WHERE id_cadeira_rodas = :id_cadeira_rodas");
        $this->db->bind("id_cadeira_rodas", $id);
        return $this->db->resultado();
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
