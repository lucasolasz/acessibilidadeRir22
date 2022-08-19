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

    public function visualizarPlataformaMundo(){
        $this->db->query("SELECT * FROM tb_plataforma_mundo"); 
        return $this->db->resultados();
    }

    
}
