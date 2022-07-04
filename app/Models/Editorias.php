<?php

class Editorias{
    
    
    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }
    
    
     public function visualizarEditorias()
    {
        $this->db->query("SELECT * FROM tb_editoria ORDER BY ds_editoria");

        return $this->db->resultados();
    }

    public function existeEditoria($dados)
    {
        $this->db->query("SELECT ds_editoria FROM tb_editoria WHERE ds_editoria = :ds_editoria");

        $this->db->bind("ds_editoria", $dados['txtEditoria']);

        if ($this->db->resultado()) {
            return true;
        } else {
            return false;
        }
    }

    public function armazenarEditoria($dados){
        
        $this->db->query("INSERT INTO tb_editoria (ds_editoria) VALUES (:ds_editoria)");

        $this->db->bind("ds_editoria", $dados['txtEditoria']);
       
        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }

    }

    public function lerEditoriaPorId($id){

        $this->db->query("SELECT * FROM tb_editoria WHERE id_editoria = :id_editoria");

        $this->db->bind("id_editoria", $id);

        return $this->db->resultado();

    }

    public function editarEditoria($dados){

        $this->db->query("UPDATE tb_editoria SET  ds_editoria = :ds_editoria WHERE id_editoria = :id_editoria");

        $this->db->bind("ds_editoria", $dados['txtEditoria']);
        $this->db->bind("id_editoria", $dados['id_editoria']);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletarEditoria($id){

        $this->db->query("DELETE FROM tb_editoria WHERE id_editoria = :id_editoria");
        $this->db->bind("id_editoria", $id);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }



}
