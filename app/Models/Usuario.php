<?php

class Usuario
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    //Realiza o login do usuário baseado no email e senha hash
    public function checarLogin($email, $senha)
    {
        $this->db->query("SELECT * FROM tb_usuario WHERE ds_email_usuario = :ds_email_usuario");

        $this->db->bind("ds_email_usuario", $email);

        if ($this->db->resultado()) {

            $resultado = $this->db->resultado();


            //Verifica o hash code
            if (password_verify($senha, $resultado->ds_senha)) {
                return $resultado;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Verifica se email existe
    public function checarEmailUsuario($dados)
    {
        $this->db->query("SELECT ds_email_usuario FROM tb_usuario WHERE ds_email_usuario = :ds_email_usuario");

        $this->db->bind("ds_email_usuario", $dados['txtEmail']);

        if ($this->db->resultado()) {
            return true;
        } else {
            return false;
        }
    }


    //Armazena usuário no banco
    public function armazenarUsuario($dados)
    {
        // var_dump($dados);
        // exit();
        
        $this->db->query("INSERT INTO tb_usuario (ds_nome_usuario, ds_email_usuario, ds_senha, fk_perfil_usuario) VALUES (:ds_nome_usuario, :ds_email_usuario, :ds_senha, :fk_perfil_usuario)");

        $this->db->bind("ds_nome_usuario", $dados['txtNome']);
        $this->db->bind("ds_email_usuario", $dados['txtEmail']);
        $this->db->bind("ds_senha", $dados['txtSenha']);        
        $this->db->bind("fk_perfil_usuario", $dados['cboPerfilUsuario']);        

        // $this->db->imprimeSqlMontada();
        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    //A principio, criada para retornar a linha com os dados do usuário específico
    public function lerUsuarioPorId($id)
    {
        $this->db->query("SELECT * FROM tb_usuario WHERE id_usuario = :id_usuario");

        $this->db->bind("id_usuario", $id);

        return $this->db->resultado();
    }

    public function listarPerfilUsuario()
    {
        $this->db->query("SELECT * FROM tb_perfil_usuario ORDER BY ds_perfil_usuario");

        return $this->db->resultados();
    }

    // public function listarEditoriaUsuario()
    // {
    //     $this->db->query("SELECT * FROM tb_editoria ORDER BY ds_editoria");

    //     return $this->db->resultados();
    // }


    public function visualizarUsuarios()
    {
        $this->db->query("SELECT * FROM tb_usuario tu
        join tb_perfil_usuario tpu on tpu.id_perfil_usuario = tu.fk_perfil_usuario 
        WHERE id_usuario > 0 ORDER BY ds_nome_usuario");

        return $this->db->resultados();
    }


    public function atualizarUsuariosSemSenha($dados)
    {

        $this->db->query("UPDATE tb_usuario SET
            ds_nome_usuario = :ds_nome_usuario,
            ds_email_usuario = :ds_email_usuario,
            fk_perfil_usuario = :fk_perfil_usuario            
            WHERE id_usuario = :id_usuario
        ");

        $this->db->bind("ds_nome_usuario", $dados['txtNome']);
        $this->db->bind("ds_email_usuario", $dados['txtEmail']);
        $this->db->bind("fk_perfil_usuario", $dados['cboPerfilUsuario']);
        $this->db->bind("id_usuario", $dados['id_usuario']);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarUsuariosComSenha($dados)
    {

        $this->db->query("UPDATE tb_usuario SET
            ds_nome_usuario = :ds_nome_usuario,
            ds_email_usuario = :ds_email_usuario,
            fk_perfil_usuario = :fk_perfil_usuario,
            ds_senha = :ds_senha
            WHERE id_usuario = :id_usuario
        ");

        $this->db->bind("ds_nome_usuario", $dados['txtNome']);
        $this->db->bind("ds_email_usuario", $dados['txtEmail']);
        $this->db->bind("fk_perfil_usuario", $dados['cboPerfilUsuario']);
        $this->db->bind("id_usuario", $dados['id_usuario']);
        $this->db->bind("ds_senha", $dados['txtSenha']);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletarUsuario($id){

        $this->db->query("DELETE FROM tb_usuario WHERE id_usuario = :id_usuario");
        $this->db->bind("id_usuario", $id);

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }
}
