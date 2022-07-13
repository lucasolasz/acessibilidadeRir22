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

    public function armazenarEspectador($dados)
    {
        $espectadorErro = false;

        // var_dump($dados);
        // exit();

        //Insert do acompanhante

        if (!$dados['txtNomeAcompanhante'] == "" || !$dados['txtDocumentoAcompanhante'] == "") {
            $this->db->query("INSERT INTO tb_acompanhante (ds_nome_acompanhante, ds_documento_acompanhante, tel_acompanhante, chk_menor_idade, qtd_menor_idade) VALUES (:ds_nome_acompanhante, :ds_documento_acompanhante, :tel_acompanhante, :chk_menor_idade, :qtd_menor_idade)");
            $this->db->bind("ds_nome_acompanhante", $dados['txtNomeAcompanhante']);
            $this->db->bind("ds_documento_acompanhante", $dados['txtDocumentoAcompanhante']);
            $this->db->bind("tel_acompanhante", $dados['txtTelefoneAcompanhante']);
            $this->db->bind("chk_menor_idade", $dados['chkAcompanhanteMenor']);
            $this->db->bind("qtd_menor_idade", $dados['txtQuantidadeMenor']);
            if (!$this->db->executa()) {
                $espectadorErro = true;
            }

            //Id do Acompanhante cadastrado
            $fk_acompanhante = $this->db->ultimoIdInserido();
        } else {
            $fk_acompanhante = NULL;
        }
        

        //Insert do espectador
        $this->db->query("INSERT INTO tb_espectador (ds_nome_espectador, ds_documento_espectador, tel_espectador, idade_espectador, chk_kit_livre, fk_condicao, chk_acompanhante, fk_acompanhante, fk_cadeira_rodas) VALUES (:ds_nome_espectador,
        :ds_documento_espectador,
        :tel_espectador,
        :idade_espectador,
        :chk_kit_livre,
        :fk_condicao,
        :chk_acompanhante,
        :fk_acompanhante,
        :fk_cadeira_rodas)");

        $this->db->bind("ds_nome_espectador", $dados['txtNomeEspectador']);
        $this->db->bind("ds_documento_espectador", $dados['txtDocumento']);
        $this->db->bind("tel_espectador", $dados['txtTelefone']);
        $this->db->bind("idade_espectador", $dados['txtIdade']);
        $this->db->bind("chk_kit_livre", $dados['chkKitLivre']);
        $this->db->bind("fk_condicao", $dados['radioCondicao']);
        $this->db->bind("chk_acompanhante", $dados['chkAcompanhante']);
        $this->db->bind("fk_acompanhante", $fk_acompanhante);
        $this->db->bind("fk_cadeira_rodas", $dados['cboCadeiraDerodas']);
        if (!$this->db->executa()) {
            $espectadorErro = true;
        }

        $ultimoIdEpectador = $this->db->ultimoIdInserido();

        //Realiza as operações de anexo, se houver anexo
        if (!$dados['arquivo'] == "") {
            //Inicio Processamento da gravação da imagem.
            $upload = new Upload();
            $upload->imagem($dados['arquivo']);

            if ($upload->getResultado()) {
                $nomeArquivo = $upload->getResultado();
                $pathArquivo = $upload->getPath();
            } else {
                echo $upload->getErro();
            }

            $this->db->query("INSERT INTO tb_anexo (fk_espectador, nm_path_arquivo, nm_arquivo, fk_usuario) VALUES (:fk_espectador, :nm_path_arquivo, :nm_arquivo, :fk_usuario)");
            $this->db->bind("fk_espectador", $ultimoIdEpectador);
            $this->db->bind("nm_path_arquivo", $pathArquivo);
            $this->db->bind("nm_arquivo", $nomeArquivo);
            $this->db->bind("fk_usuario", $_SESSION['id_usuario']);
            if (!$this->db->executa()) {
                $espectadorErro = true;
            }
        }

        if ($espectadorErro) {
            return false;
        } else {
            return true;
        }
    }

    public function lerCondicao()
    {

        $this->db->query("SELECT * FROM tb_condicao ORDER BY ds_condicao");

        return $this->db->resultados();
    }

    public function lerAcessoServico()
    {

        $this->db->query("SELECT * FROM tb_acesso_servico ORDER BY ds_acesso_servico");

        return $this->db->resultados();
    }

    public function lerTipoDeficiencia()
    {

        $this->db->query("SELECT * FROM tb_tipo_deficiencia ORDER BY ds_tipo_deficiencia");

        return $this->db->resultados();
    }

    public function lerCadeiraDeRodas()
    {

        $this->db->query("SELECT * FROM tb_cadeira_rodas ORDER BY num_cadeira_rodas");

        return $this->db->resultados();
    }

    public function lerGuardaVolumes()
    {

        $this->db->query("SELECT * FROM tb_guarda_volume ORDER BY ds_guarda_volume");

        return $this->db->resultados();
    }

    public function lerEspectadorPorId($id)
    {
        $this->db->query("SELECT * FROM tb_espectador WHERE id_espectador = :id_espectador");

        $this->db->bind("id_espectador", $id);

        return $this->db->resultado();
    }
}
