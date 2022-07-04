<?php

class AgendaConvidado
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }


    //Exibe todos os registros da agenda
    public function listar()
    {
        $this->db->query("SELECT *       
        FROM tb_agenda_convidados tac
        INNER JOIN tb_usuario tus ON tus.id_usuario = tac.fk_usuario
        ORDER BY dt_entrevista_escrita");

        return $this->db->resultados();
    }



    //Armazena agenda no banco
    public function armazenarAgenda($dados)
    {
        
        $this->db->query("INSERT INTO tb_agenda_convidados (ds_nome_convidado, dt_entrevista_escrita, link_entrevista_escrita, dt_treinamento, dt_hora_treinamento, dt_live, dt_hora_live, link_live, fk_usuario) VALUES (:ds_nome_convidado, :dt_entrevista_escrita, :link_entrevista_escrita, :dt_treinamento, :dt_hora_treinamento, :dt_live, :dt_hora_live, :link_live, :fk_usuario)");

        $this->db->bind("ds_nome_convidado", $dados['txtNomeConvidado']);
        $this->db->bind("dt_entrevista_escrita", $dados['txtDataEntrevistaEscrita']);
        $this->db->bind("link_entrevista_escrita", $dados['txtLinkEntrevistaEscrita']);
        $this->db->bind("dt_treinamento", $dados['txtDataTreinamento']);
        $this->db->bind("dt_hora_treinamento", $dados['txtHoraTreinamento']);
        $this->db->bind("dt_live", $dados['txtDataLive']);
        $this->db->bind("dt_hora_live", $dados['txtHoraLive']);
        $this->db->bind("link_live", $dados['txtLinkLive']);
        $this->db->bind("fk_usuario", $dados['id_usuario']);
      
       
        // $this->db->imprimeSqlMontada();       
       
        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }

    }


    public function atualizarAgenda($dados)
    {

        $this->db->query("UPDATE tb_agenda_convidados SET 
        ds_nome_convidado = :ds_nome_convidado, 
        dt_entrevista_escrita = :dt_entrevista_escrita, 
        link_entrevista_escrita = :link_entrevista_escrita, 
        dt_treinamento = :dt_treinamento,
        dt_hora_treinamento = :dt_hora_treinamento, 
        dt_live = :dt_live, 
        dt_hora_live = :dt_hora_live, 
        link_live = :link_live,
        fk_usuario_edicao = :fk_usuario_edicao,
        editado_em = :editado_em
        WHERE id_agenda_convidados = :id_agenda_convidados");

        $this->db->bind("ds_nome_convidado", $dados['txtNomeConvidado']);
        $this->db->bind("dt_entrevista_escrita", $dados['txtDataEntrevistaEscrita']);
        $this->db->bind("link_entrevista_escrita", $dados['txtLinkEntrevistaEscrita']);
        $this->db->bind("dt_treinamento", $dados['txtDataTreinamento']);
        $this->db->bind("dt_hora_treinamento", $dados['txtHoraTreinamento']);
        $this->db->bind("dt_live", $dados['txtDataLive']);
        $this->db->bind("dt_hora_live", $dados['txtHoraLive']);
        $this->db->bind("link_live", $dados['txtLinkLive']);
        $this->db->bind("id_agenda_convidados", $dados['agenda']->id_agenda_convidados);
        $this->db->bind("fk_usuario_edicao", (int) $_SESSION['id_usuario']);
        $this->db->bind("editado_em", date('Y-m-d H:i'));

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }


    //Função para editar o card exibido
    public function lerPorId($id)
    {
        $this->db->query("SELECT * FROM tb_agenda_convidados WHERE id_agenda_convidados = :id_agenda_convidados");

        $this->db->bind("id_agenda_convidados", $id);

        return $this->db->resultado();
    }


    public function deletarAgenda($id){

        $this->db->query("DELETE FROM tb_agenda_convidados WHERE id_agenda_convidados = :id_agenda_convidados");

        $this->db->bind("id_agenda_convidados", $id);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }

    }
}
