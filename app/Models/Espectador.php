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
        $armazenaEspectadorErro = false;

        // var_dump($dados);
        // exit();

        if (!$dados['txtNomeAcompanhante'] == "" || !$dados['txtDocumentoAcompanhante'] == "") {
            $this->db->query("INSERT INTO tb_acompanhante (ds_nome_acompanhante, ds_documento_acompanhante, tel_acompanhante, chk_menor_idade, qtd_menor_idade) VALUES (:ds_nome_acompanhante, :ds_documento_acompanhante, :tel_acompanhante, :chk_menor_idade, :qtd_menor_idade)");
            $this->db->bind("ds_nome_acompanhante", $dados['txtNomeAcompanhante']);
            $this->db->bind("ds_documento_acompanhante", $dados['txtDocumentoAcompanhante']);
            $this->db->bind("tel_acompanhante", $dados['txtTelefoneAcompanhante']);
            $this->db->bind("chk_menor_idade", $dados['chkAcompanhanteMenor']);
            $this->db->bind("qtd_menor_idade", $dados['txtQuantidadeMenor']);
            if (!$this->db->executa()) {
                $armazenaEspectadorErro = true;
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
            $armazenaEspectadorErro = true;
        }

        $ultimoIdEpectador = $this->db->ultimoIdInserido();

        if (!$dados['chkAcessoServico'] == "") {

            foreach ($dados['chkAcessoServico'] as $chkAcessoServico) {

                $this->db->query("INSERT INTO tb_relac_acesso_servico (fk_acesso_servico, fk_espectador) VALUES (:fk_acesso_servico, :fk_espectador)");
                $this->db->bind("fk_acesso_servico", $chkAcessoServico);
                $this->db->bind("fk_espectador", $ultimoIdEpectador);
                if (!$this->db->executa()) {
                    $armazenaEspectadorErro = true;
                }
            }
        }

        if (!$dados['chkGuardaVolume'] == "") {

            foreach ($dados['chkGuardaVolume'] as $chkGuardaVolume) {

                $this->db->query("INSERT INTO tb_relac_guarda_volumes (fk_guarda_volumes, fk_espectador) VALUES (:fk_guarda_volumes, :fk_espectador)");
                $this->db->bind("fk_guarda_volumes", $chkGuardaVolume);
                $this->db->bind("fk_espectador", $ultimoIdEpectador);
                if (!$this->db->executa()) {
                    $armazenaEspectadorErro = true;
                }
            }
        }

        if (!$dados['chkTipoDeficiencia'] == "") {

            foreach ($dados['chkTipoDeficiencia'] as $chkTipoDeficiencia) {

                $this->db->query("INSERT INTO tb_relac_tipo_deficiencia (fk_tipo_deficiencia, fk_espectador) VALUES (:fk_tipo_deficiencia, :fk_espectador)");
                $this->db->bind("fk_tipo_deficiencia", $chkTipoDeficiencia);
                $this->db->bind("fk_espectador", $ultimoIdEpectador);
                if (!$this->db->executa()) {
                    $armazenaEspectadorErro = true;
                }
            }
        }

        //Realiza as operações de anexo, se houver anexo
        // var_dump($dados['fileTermoAdesao']);

        if (!$dados['fileTermoAdesao']['name'] == "") {

            $pastaArquivo = "espectador_id_" . $ultimoIdEpectador;
            $upload = new Upload();

            $upload->imagem($dados['fileTermoAdesao'], NULL, 'temp');

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

                    $this->db->query("INSERT INTO tb_anexo (fk_espectador, nm_path_arquivo, nm_arquivo, fk_usuario) VALUES (:fk_espectador, :nm_path_arquivo, :nm_arquivo, :fk_usuario)");
                    $this->db->bind("fk_espectador", $ultimoIdEpectador);
                    $this->db->bind("nm_path_arquivo", $novoDiretorio);
                    $this->db->bind("nm_arquivo", $nomeArquivo);
                    $this->db->bind("fk_usuario", $_SESSION['id_usuario']);
                    if (!$this->db->executa()) {
                        $armazenaEspectadorErro = true;
                    }
                } else {
                    return false;
                }
            }
        }

        if ($armazenaEspectadorErro) {
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
