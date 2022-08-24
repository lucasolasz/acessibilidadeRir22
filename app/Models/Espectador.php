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
        $this->db->query("SELECT * FROM tb_espectador te 
        LEFT JOIN tb_condicao tc ON tc.id_condicao = te.fk_condicao
        LEFT JOIN tb_usuario tu ON tu.id_usuario = te.fk_usuario
        ORDER BY ds_nome_espectador");

        return $this->db->resultados();
    }

    public function visualizarEspectadorNaoAgendado()
    {
        $this->db->query("SELECT * FROM tb_espectador te 
        WHERE te.id_espectador 
        NOT IN (SELECT DISTINCT(id_espectador) FROM tb_espectador te2 JOIN tb_agenda_brinquedo tab ON te2.id_espectador = tab.fk_espectador)
        ORDER BY ds_nome_espectador");

        return $this->db->resultados();
    }


    public function pesquisarEspectador($dados)
    {
        $this->db->query("SELECT * FROM tb_espectador te 
        LEFT JOIN tb_condicao tc ON tc.id_condicao = te.fk_condicao
        LEFT JOIN tb_usuario tu ON tu.id_usuario = te.fk_usuario
        WHERE te.ds_nome_espectador LIKE concat('%',:ds_nome_espectador,'%') 
        ORDER BY te.criado_em DESC");
        $this->db->bind("ds_nome_espectador", $dados['ds_nome_espectador']);
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

        $this->db->beginTransaction();

        try {

            if (!$dados['txtNomeAcompanhante'] == "" || !$dados['txtDocumentoAcompanhante'] == "") {
                $this->db->query("INSERT INTO tb_acompanhante (ds_nome_acompanhante, ds_documento_acompanhante, tel_acompanhante, chk_menor_idade, qtd_menor_idade) VALUES (:ds_nome_acompanhante, :ds_documento_acompanhante, :tel_acompanhante, :chk_menor_idade, :qtd_menor_idade)");
                $this->db->bind("ds_nome_acompanhante", $dados['txtNomeAcompanhante']);
                $this->db->bind("ds_documento_acompanhante", $dados['txtDocumentoAcompanhante']);
                $this->db->bind("tel_acompanhante", $dados['txtTelefoneAcompanhante']);
                $this->db->bind("chk_menor_idade", $dados['chkAcompanhanteMenor']);
                $this->db->bind("qtd_menor_idade", $dados['cboQuantidadeMenor']);
                if (!$this->db->executa()) {
                    $armazenaEspectadorErro = true;
                }

                //Id do Acompanhante cadastrado
                $fk_acompanhante = $this->db->ultimoIdInserido();
            } else {
                $fk_acompanhante = NULL;
            }

            //Insert do espectador
            $this->db->query("INSERT INTO tb_espectador (ds_nome_espectador, ds_documento_espectador, ds_descricao_deficiencia, tel_espectador, idade_espectador, chk_kit_livre, fk_condicao, chk_acompanhante, fk_acompanhante, fk_cadeira_rodas, fk_usuario, fk_tipo_deficiencia_fisica) VALUES (:ds_nome_espectador,
            :ds_documento_espectador,
            :ds_descricao_deficiencia,
            :tel_espectador,
            :idade_espectador,
            :chk_kit_livre,
            :fk_condicao,
            :chk_acompanhante,
            :fk_acompanhante,
            :fk_cadeira_rodas,
            :fk_usuario,
            :fk_tipo_deficiencia_fisica)");

            $this->db->bind("ds_nome_espectador", $dados['txtNomeEspectador']);
            $this->db->bind("ds_documento_espectador", $dados['txtDocumento']);
            $this->db->bind("ds_descricao_deficiencia", $dados['txtDeficienciaFisica']);
            $this->db->bind("tel_espectador", $dados['txtTelefone']);
            $this->db->bind("idade_espectador", $dados['txtIdade']);
            $this->db->bind("chk_kit_livre", $dados['chkKitLivre']);
            $this->db->bind("fk_condicao", $dados['radioCondicao']);
            $this->db->bind("chk_acompanhante", $dados['chkAcompanhante']);
            $this->db->bind("fk_acompanhante", $fk_acompanhante);
            $this->db->bind("fk_cadeira_rodas", $dados['cboCadeiraDerodas']);
            $this->db->bind("fk_usuario", $_SESSION['id_usuario']);
            $this->db->bind("fk_tipo_deficiencia_fisica", $dados['cboTipoDeficienciaFisica']);
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

                        $this->db->query("INSERT INTO tb_anexo (fk_espectador, nm_path_arquivo, nm_arquivo, fk_usuario, chk_termo_brinquedo) VALUES (:fk_espectador, :nm_path_arquivo, :nm_arquivo, :fk_usuario, :chk_termo_brinquedo)");
                        $this->db->bind("fk_espectador", $ultimoIdEpectador);
                        $this->db->bind("nm_path_arquivo", $novoDiretorio);
                        $this->db->bind("nm_arquivo", $nomeArquivo);
                        $this->db->bind("fk_usuario", $_SESSION['id_usuario']);
                        $this->db->bind("chk_termo_brinquedo", 'N');
                        if (!$this->db->executa()) {
                            $armazenaEspectadorErro = true;
                        }
                    } else {
                        return false;
                    }
                }
            }
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }

        if ($armazenaEspectadorErro) {
            return false;
        } else {
            $this->db->commit();
            return true;
        }
    }


    public function editarEspectador($dados)
    {
        $editarEspectadorErro = false;

        $this->db->beginTransaction();

        try {

            if (!$dados['fk_acompanhante'] == NULL) {

                if ($dados['chkAcompanhante'] == 'N') {


                    //Desvincula chave estrangeira do acompanhante
                    $this->db->query("UPDATE tb_espectador SET fk_acompanhante = :fk_acompanhante WHERE id_espectador = :id_espectador");
                    $this->db->bind("fk_acompanhante", NULL);
                    $this->db->bind("id_espectador", $dados['id_espectador']);
                    if (!$this->db->executa()) {
                        $editarEspectadorErro = true;
                    }

                    //Apaga o acompanhante
                    $this->db->query("DELETE FROM tb_acompanhante WHERE id_acompanhante = :fk_acompanhante");
                    $this->db->bind("fk_acompanhante", $dados['fk_acompanhante']);
                    if (!$this->db->executa()) {
                        $editarEspectadorErro = true;
                    }

                    //Nulo para atualizar a linha do espectador
                    $dados['fk_acompanhante'] = NULL;
                } else {

                    $this->db->query("UPDATE tb_acompanhante SET 
                    ds_nome_acompanhante = :ds_nome_acompanhante,
                    ds_documento_acompanhante = :ds_documento_acompanhante,
                    tel_acompanhante = :tel_acompanhante,
                    chk_menor_idade = :chk_menor_idade,
                    qtd_menor_idade = :qtd_menor_idade
                    WHERE id_acompanhante = :fk_acompanhante");

                    $this->db->bind("ds_nome_acompanhante", $dados['txtNomeAcompanhante']);
                    $this->db->bind("ds_documento_acompanhante", $dados['txtDocumentoAcompanhante']);
                    $this->db->bind("tel_acompanhante", $dados['txtTelefoneAcompanhante']);
                    $this->db->bind("chk_menor_idade", $dados['chkAcompanhanteMenor']);
                    $this->db->bind("qtd_menor_idade", $dados['cboQuantidadeMenor']);
                    $this->db->bind("fk_acompanhante", $dados['fk_acompanhante']);
                    if (!$this->db->executa()) {
                        $editarEspectadorErro = true;
                    }
                }
            } else {

                //Adiciona um acompanhante caso não tenha acompanhante na edição
                if ($dados['chkAcompanhante'] == 'S') {

                    if (!$dados['txtNomeAcompanhante'] == "" or !$dados['txtDocumentoAcompanhante'] == "") {

                        $this->db->query("INSERT INTO tb_acompanhante (ds_nome_acompanhante, ds_documento_acompanhante, tel_acompanhante, chk_menor_idade, qtd_menor_idade) VALUES (:ds_nome_acompanhante, :ds_documento_acompanhante, :tel_acompanhante, :chk_menor_idade, :qtd_menor_idade)");
                        $this->db->bind("ds_nome_acompanhante", $dados['txtNomeAcompanhante']);
                        $this->db->bind("ds_documento_acompanhante", $dados['txtDocumentoAcompanhante']);
                        $this->db->bind("tel_acompanhante", $dados['txtTelefoneAcompanhante']);
                        $this->db->bind("chk_menor_idade", $dados['chkAcompanhanteMenor']);
                        $this->db->bind("qtd_menor_idade", $dados['cboQuantidadeMenor']);
                        if (!$this->db->executa()) {
                            $editarEspectadorErro = true;
                        }

                        //Id do Acompanhante cadastrado
                        $fk_acompanhante = $this->db->ultimoIdInserido();
                    }

                    $dados['fk_acompanhante'] = $fk_acompanhante;
                }
            }

            // var_dump($dados['txtDeficienciaFisica']);
            // exit();


            //Update do espectador
            $this->db->query("UPDATE tb_espectador SET
            ds_nome_espectador = :ds_nome_espectador,
            ds_documento_espectador = :ds_documento_espectador,
            ds_descricao_deficiencia = :ds_descricao_deficiencia,
            tel_espectador = :tel_espectador,
            idade_espectador = :idade_espectador,
            chk_kit_livre = :chk_kit_livre,
            fk_condicao = :fk_condicao, 
            chk_acompanhante = :chk_acompanhante, 
            fk_acompanhante = :fk_acompanhante, 
            fk_cadeira_rodas = :fk_cadeira_rodas,
            fk_tipo_deficiencia_fisica = :fk_tipo_deficiencia_fisica
            WHERE id_espectador = :id_espectador");

            $this->db->bind("ds_nome_espectador", $dados['txtNomeEspectador']);
            $this->db->bind("ds_documento_espectador", $dados['txtDocumento']);
            $this->db->bind("ds_descricao_deficiencia", $dados['txtDeficienciaFisica']);
            $this->db->bind("tel_espectador", $dados['txtTelefone']);
            $this->db->bind("idade_espectador", $dados['txtIdade']);
            $this->db->bind("chk_kit_livre", $dados['chkKitLivre']);
            $this->db->bind("fk_condicao", $dados['radioCondicao']);
            $this->db->bind("chk_acompanhante", $dados['chkAcompanhante']);
            $this->db->bind("fk_acompanhante", $dados['fk_acompanhante']);
            $this->db->bind("fk_cadeira_rodas", $dados['cboCadeiraDerodas']);
            $this->db->bind("fk_tipo_deficiencia_fisica", $dados['cboTipoDeficienciaFisica']);
            $this->db->bind("id_espectador", $dados['id_espectador']);
            if (!$this->db->executa()) {
                $editarEspectadorErro = true;
            }


            if (!$dados['chkAcessoServico'] == "") {

                //Apaga os anteriores e salva as novas opções escolhidas
                $this->db->query("DELETE FROM tb_relac_acesso_servico WHERE fk_espectador = :fk_espectador");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                if (!$this->db->executa()) {
                    $editarEspectadorErro = true;
                }

                foreach ($dados['chkAcessoServico'] as $chkAcessoServico) {

                    $this->db->query("INSERT INTO tb_relac_acesso_servico (fk_acesso_servico, fk_espectador) VALUES (:fk_acesso_servico, :fk_espectador)");
                    $this->db->bind("fk_acesso_servico", $chkAcessoServico);
                    $this->db->bind("fk_espectador", $dados['id_espectador']);
                    if (!$this->db->executa()) {
                        $editarEspectadorErro = true;
                    }
                }
            } else {

                //Apaga se não tiver opção escolhida
                $this->db->query("DELETE FROM tb_relac_acesso_servico WHERE fk_espectador = :fk_espectador");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                $this->db->executa();


                if (!$dados['cboCadeiraDerodas'] == NULL) {

                    $this->db->query("UPDATE tb_espectador SET fk_cadeira_rodas = :fk_cadeira_rodas WHERE id_espectador = :id_espectador");
                    $this->db->bind("fk_cadeira_rodas", NULL);
                    $this->db->bind("id_espectador", $dados['id_espectador']);
                    $this->db->executa();
                }

                if (!empty($dados['fotoAdesao'])) {

                    //Usado para deletar o arquivo fisico no diretorio
                    $path_arquivo_anterior = $dados['fotoAdesao'][0]->nm_path_arquivo . DIRECTORY_SEPARATOR . $dados['fotoAdesao'][0]->nm_arquivo;
                    $upload = new Upload();
                    $upload->deletarArquivo(null, $path_arquivo_anterior);

                    //Deleta registro da imagem no banco
                    $this->db->query("DELETE FROM tb_anexo WHERE fk_espectador = :fk_espectador");
                    $this->db->bind("fk_espectador", $dados['id_espectador']);
                    $this->db->executa();
                }
            }


            if (!$dados['chkGuardaVolume'] == "") {

                //Apaga os anteriores e salva as novas opções escolhidas
                $this->db->query("DELETE FROM tb_relac_guarda_volumes WHERE fk_espectador = :fk_espectador");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                if (!$this->db->executa()) {
                    $editarEspectadorErro = true;
                }


                foreach ($dados['chkGuardaVolume'] as $chkGuardaVolume) {

                    $this->db->query("INSERT INTO tb_relac_guarda_volumes (fk_guarda_volumes, fk_espectador) VALUES (:fk_guarda_volumes, :fk_espectador)");
                    $this->db->bind("fk_guarda_volumes", $chkGuardaVolume);
                    $this->db->bind("fk_espectador", $dados['id_espectador']);
                    if (!$this->db->executa()) {
                        $editarEspectadorErro = true;
                    }
                }
            } else {

                //Apaga se não tiver opção escolhida
                $this->db->query("DELETE FROM tb_relac_guarda_volumes WHERE fk_espectador = :fk_espectador");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                if (!$this->db->executa()) {
                    $editarEspectadorErro = true;
                }

                //Apaga se não tiver opção escolhida
                $this->db->query("DELETE FROM tb_relac_acesso_servico WHERE fk_acesso_servico = :fk_acesso_servico");
                $this->db->bind("fk_acesso_servico", 5);
                if (!$this->db->executa()) {
                    $editarEspectadorErro = true;
                }
            }

            if (!$dados['chkTipoDeficiencia'] == "") {

                //Apaga os anteriores e salva as novas opções escolhidas
                $this->db->query("DELETE FROM tb_relac_tipo_deficiencia WHERE fk_espectador = :fk_espectador");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                if (!$this->db->executa()) {
                    $editarEspectadorErro = true;
                }

                foreach ($dados['chkTipoDeficiencia'] as $chkTipoDeficiencia) {

                    $this->db->query("INSERT INTO tb_relac_tipo_deficiencia (fk_tipo_deficiencia, fk_espectador) VALUES (:fk_tipo_deficiencia, :fk_espectador)");
                    $this->db->bind("fk_tipo_deficiencia", $chkTipoDeficiencia);
                    $this->db->bind("fk_espectador",  $dados['id_espectador']);
                    if (!$this->db->executa()) {
                        $editarEspectadorErro = true;
                    }
                }
            } else {

                //Apaga se não tiver opção escolhida
                $this->db->query("DELETE FROM tb_relac_tipo_deficiencia WHERE fk_espectador = :fk_espectador");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                if (!$this->db->executa()) {
                    $editarEspectadorErro = true;
                }

                $this->db->query("UPDATE tb_espectador SET ds_descricao_deficiencia = :ds_descricao_deficiencia, fk_tipo_deficiencia_fisica = :fk_tipo_deficiencia_fisica WHERE id_espectador = :id_espectador");
                $this->db->bind("ds_descricao_deficiencia", NULL);
                $this->db->bind("fk_tipo_deficiencia_fisica", NULL);
                $this->db->bind("id_espectador", $dados['id_espectador']);
                $this->db->executa();
            }

            if (!$dados['fileTermoAdesao']['name'] == "") {

                //Se entrar aqui na edição, está sendo feita uma substituição

                $pastaArquivo = "espectador_id_" . $dados['id_espectador'];
                $upload = new Upload();

                if (!empty($dados['fotoAdesao'])) {
                    //Deleta registro da imagem no banco
                    $this->db->query("DELETE FROM tb_anexo WHERE fk_espectador = :fk_espectador");
                    $this->db->bind("fk_espectador", $dados['id_espectador']);
                    $this->db->executa();

                    //Usado para deletar o arquivo fisico no diretorio
                    $path_arquivo_anterior = $dados['fotoAdesao'][0]->nm_path_arquivo . DIRECTORY_SEPARATOR . $dados['fotoAdesao'][0]->nm_arquivo;

                    //Invoca metodo para deletar o arquivo anterior para ser substituido
                    $upload->deletarArquivo(null, $path_arquivo_anterior);
                }

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

                        $this->db->query("INSERT INTO tb_anexo (fk_espectador, nm_path_arquivo, nm_arquivo, fk_usuario, chk_termo_brinquedo) VALUES (:fk_espectador, :nm_path_arquivo, :nm_arquivo, :fk_usuario, :chk_termo_brinquedo)");
                        $this->db->bind("fk_espectador", $dados['id_espectador']);
                        $this->db->bind("nm_path_arquivo", $novoDiretorio);
                        $this->db->bind("nm_arquivo", $nomeArquivo);
                        $this->db->bind("fk_usuario", $_SESSION['id_usuario']);
                        $this->db->bind("chk_termo_brinquedo", 'N');
                        if (!$this->db->executa()) {
                            $editarEspectadorErro = true;
                        }
                    } else {
                        return false;
                    }
                }
            }
        } catch (Exception $e) {

            $this->db->rollback();
            return false;
        }

        if ($editarEspectadorErro) {
            return false;
        } else {
            $this->db->commit();
            return true;
        }
    }

    public function deletarEspectador($dados)
    {
        $id_espectador = $dados['id_espectador'];

        $deletarEspectadorErro = false;

        $this->db->beginTransaction();

        try {


            if (!empty($dados['fotoAdesao'])) {

                $pastaPrincipal = $dados['fotoAdesao'][0]->nm_path_arquivo;

                $path_arquivo = $dados['fotoAdesao'][0]->nm_path_arquivo . DIRECTORY_SEPARATOR . $dados['fotoAdesao'][0]->nm_arquivo;

                $upload = new Upload();
                $upload->deletarArquivo(null, $path_arquivo);

                //Deleta da tabela
                $this->db->query("DELETE FROM tb_anexo WHERE id_anexo = :id_anexo");
                $this->db->bind("id_anexo", $dados['fotoAdesao'][0]->id_anexo);
                if (!$this->db->executa()) {
                    $deletarEspectadorErro = true;
                }

                //Apaga a pasta apos estar vazia
                rmdir($pastaPrincipal);
            } else {

                //Captura do id do espectador para deletar a pasta vazia
                $pastaAdesaoEspec = "uploads" . DIRECTORY_SEPARATOR . "espectador_id_" . $id_espectador;

                if (file_exists($pastaAdesaoEspec)) {
                    //Apaga a pasta vazia 
                    rmdir($pastaAdesaoEspec);
                }
            }

            $this->db->query("DELETE FROM tb_relac_acesso_servico WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $id_espectador);
            if (!$this->db->executa()) {
                $deletarEspectadorErro = true;
            }

            $this->db->query("DELETE FROM tb_relac_guarda_volumes WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $id_espectador);
            if (!$this->db->executa()) {
                $deletarEspectadorErro = true;
            }

            $this->db->query("DELETE FROM tb_relac_tipo_deficiencia WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $id_espectador);
            if (!$this->db->executa()) {
                $deletarEspectadorErro = true;
            }

            $this->db->query("DELETE FROM tb_agenda_brinquedo WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $id_espectador);
            if (!$this->db->executa()) {
                $deletarEspectadorErro = true;
            }

            $this->db->query("DELETE FROM tb_marcacoes_mundo WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $id_espectador);
            if (!$this->db->executa()) {
                $deletarEspectadorErro = true;
            }

            $this->db->query("DELETE FROM tb_marcacoes_sunset WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $id_espectador);
            if (!$this->db->executa()) {
                $deletarEspectadorErro = true;
            }

            $this->db->query("DELETE FROM tb_espectador WHERE id_espectador = :id_espectador");
            $this->db->bind("id_espectador", $id_espectador);
            if (!$this->db->executa()) {
                $deletarEspectadorErro = true;
            }

            if (!$dados['espectador']->fk_acompanhante == NULL) {

                $this->db->query("DELETE FROM tb_acompanhante WHERE id_acompanhante = :id_acompanhante");
                $this->db->bind("id_acompanhante", $dados['espectador']->fk_acompanhante);
                if (!$this->db->executa()) {
                    $deletarEspectadorErro = true;
                }
            }
        } catch (Exception $e) {

            $this->db->rollback();
            return false;
        }

        if ($deletarEspectadorErro) {
            return false;
        } else {
            $this->db->commit();
            return true;
        }
    }

    public function deletarFoto($dados)
    {
        //Monta string do diretório da imagem
        $path_arquivo = $dados['fotoAdesao'][0]->nm_path_arquivo . DIRECTORY_SEPARATOR . $dados['fotoAdesao'][0]->nm_arquivo;

        $upload = new Upload();
        $upload->deletarArquivo(null, $path_arquivo);

        //Deleta da tabela
        $this->db->query("DELETE FROM tb_anexo WHERE id_anexo = :id_anexo");
        $this->db->bind("id_anexo", $dados['fotoAdesao'][0]->id_anexo);


        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function lerTipoDeficienciaFisica()
    {

        $this->db->query("SELECT * FROM tb_tipo_deficiencia_fisica ORDER BY ds_tipo_deficiencia_fisica");

        return $this->db->resultados();
    }


    public function lerCondicao()
    {

        $this->db->query("SELECT * FROM tb_condicao ORDER BY ordem");

        return $this->db->resultados();
    }

    public function lerAcessoServico()
    {

        $this->db->query("SELECT * FROM tb_acesso_servico ORDER BY ordem");

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
    public function lerCadeiraDeRodasUsadas()
    {

        $this->db->query("SELECT * FROM tb_cadeira_rodas tcr 
        WHERE id_cadeira_rodas NOT IN (SELECT DISTINCT(tcr.id_cadeira_rodas) FROM tb_espectador te
        JOIN tb_cadeira_rodas tcr ON tcr.id_cadeira_rodas = te.fk_cadeira_rodas)");

        return $this->db->resultados();
    }

    public function lerGuardaVolumes()
    {

        $this->db->query("SELECT * FROM tb_guarda_volume ORDER BY ds_guarda_volume");

        return $this->db->resultados();
    }


    public function lerEspectadorPorIdBrinquedo($id)
    {

        $this->db->query("SELECT * FROM tb_espectador te 
        LEFT JOIN tb_condicao tc ON tc.id_condicao = te.fk_condicao
        LEFT JOIN tb_usuario tu ON tu.id_usuario = te.fk_usuario
        WHERE te.id_espectador = :id_espectador
        ORDER BY ds_nome_espectador");

        $this->db->bind("id_espectador", $id);


        return $this->db->resultados();
    }

    public function lerEspectadorPorId($id)
    {
        $this->db->query("SELECT * FROM tb_espectador te 
        LEFT JOIN tb_acompanhante ta ON ta.id_acompanhante = te.fk_acompanhante
        LEFT JOIN tb_cadeira_rodas ca ON ca.id_cadeira_rodas = te.fk_cadeira_rodas
        WHERE te.id_espectador = :id_espectador");

        $this->db->bind("id_espectador", $id);

        return $this->db->resultado();
    }

    public function relacAcessoServicoPorid($id)
    {
        $this->db->query("SELECT * FROM tb_relac_acesso_servico WHERE fk_espectador = :fk_espectador");

        $this->db->bind("fk_espectador", $id);

        return $this->db->resultados();
    }

    public function relacAcessoServicoGuardaVol()
    {
        $this->db->query("SELECT DISTINCT(te.id_espectador), te.ds_nome_espectador, tc.ds_condicao FROM tb_relac_acesso_servico tras
        JOIN tb_espectador te ON te.id_espectador = tras.fk_espectador
        LEFT JOIN tb_condicao tc ON tc.id_condicao = te.fk_condicao WHERE tras.fk_acesso_servico = 5");

        return $this->db->resultados();
    }

    public function relacGuardaVolumesPorid($id)
    {
        $this->db->query("SELECT * FROM tb_relac_guarda_volumes WHERE fk_espectador = :fk_espectador");

        $this->db->bind("fk_espectador", $id);

        return $this->db->resultados();
    }

    public function relacTipoDeficienciaPorid($id)
    {
        $this->db->query("SELECT * FROM tb_relac_tipo_deficiencia WHERE fk_espectador = :fk_espectador");

        $this->db->bind("fk_espectador", $id);

        return $this->db->resultados();
    }

    public function lerAnexosPorId($id)
    {
        $this->db->query("SELECT * FROM tb_anexo WHERE fk_espectador = :fk_espectador AND chk_termo_brinquedo = 'N'");

        $this->db->bind("fk_espectador", $id);

        return $this->db->resultados();
    }
}
