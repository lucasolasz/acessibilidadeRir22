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


    //Para quando a pesquisa for pelo nome do espectador
    public function pesquisarEspectadorPlataforma($dados)
    {

        $this->db->query("SELECT DISTINCT te.id_espectador AS id_espectador, te.ds_nome_espectador AS ds_nome_espectador, tmm.fk_espectador AS id_espec_mundo, tms.fk_espectador AS id_espec_sunset, te.chk_entrada_sunset as chk_entrada_sunset, te.chk_entrada_mundo as chk_entrada_mundo
        FROM tb_espectador te 
        LEFT JOIN tb_marcacoes_mundo tmm ON tmm.fk_espectador = te.id_espectador        
        LEFT JOIN tb_marcacoes_sunset tms ON tms.fk_espectador = te.id_espectador
        WHERE (tmm.fk_espectador <> 'NULL' or tms.fk_espectador <> 'NULL')
        AND te.ds_nome_espectador LIKE concat('%',:ds_nome_espectador,'%')");
        $this->db->bind("ds_nome_espectador", $dados['ds_nome_espectador']);
        return $this->db->resultados();
    }

    //Para quando a pesquisa for pelo nome da marcação
    public function pesquisarMarcacao($dados)
    {
        $this->db->query("SELECT * FROM (
            SELECT tpm.num_reserva, te.id_espectador, te.ds_nome_espectador, te.chk_entrada_sunset, te.chk_entrada_mundo FROM tb_plataforma_mundo tpm
            JOIN tb_marcacoes_mundo tmm ON tmm.fk_plataforma_mundo = tpm.id_plataforma_mundo
            JOIN tb_espectador te ON te.id_espectador = tmm.fk_espectador 
            UNION
            SELECT tps.num_reserva, te2.id_espectador, te2.ds_nome_espectador, te2.chk_entrada_sunset, chk_entrada_mundo FROM tb_plataforma_sunset tps
            JOIN tb_marcacoes_sunset tms ON tms.fk_plataforma_sunset = tps.id_plataforma_sunset
            JOIN tb_espectador te2 ON te2.id_espectador = tms.fk_espectador 
            ) AS marcacoes
            WHERE num_reserva LIKE concat('%',:ds_nome_espectador,'%')");
        $this->db->bind("ds_nome_espectador", $dados['ds_nome_espectador']);
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

    public function visualizarMarcacoesPlataMundo()
    {

        $this->db->query("SELECT * FROM tb_marcacoes_mundo tmm 
        JOIN tb_plataforma_mundo tpm ON tpm.id_plataforma_mundo = fk_plataforma_mundo");
        return $this->db->resultados();
    }

    public function visualizarMarcacoesPlataSunset()
    {

        $this->db->query("SELECT * FROM tb_marcacoes_sunset tms 
        JOIN tb_plataforma_sunset tps ON tps.id_plataforma_sunset = tms.fk_plataforma_sunset");
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


    public function editarReservaMundo($dados)
    {

        $editarReservaMundo = false;

        if (!$dados['chkReservaMundo'] == "") {

            $this->db->query("DELETE FROM tb_marcacoes_mundo WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $dados['id_espectador']);
            if (!$this->db->executa()) {
                $editarReservaMundo = true;
            }

            foreach ($dados['chkReservaMundo'] as $chkReservaMundo) {

                $this->db->query("INSERT INTO tb_marcacoes_mundo (fk_espectador, fk_plataforma_mundo) VALUES (:fk_espectador, :fk_plataforma_mundo)");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                $this->db->bind("fk_plataforma_mundo", $chkReservaMundo);
                if (!$this->db->executa()) {
                    $editarReservaMundo = true;
                }
            }
        } else {

            //Se entrar aqui, foram removidas todas as marcações
            $this->db->query("DELETE FROM tb_marcacoes_mundo WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $dados['id_espectador']);
            if (!$this->db->executa()) {
                $editarReservaMundo = true;
            }
        }

        if ($editarReservaMundo) {
            return false;
        } else {
            return true;
        }
    }

    public function editarReservaSunset($dados)
    {

        $editarReservaSunset = false;

        if (!$dados['chkReservaSunset'] == "") {

            $this->db->query("DELETE FROM tb_marcacoes_sunset WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $dados['id_espectador']);
            if (!$this->db->executa()) {
                $editarReservaSunset = true;
            }

            foreach ($dados['chkReservaSunset'] as $chkReservaSunset) {

                $this->db->query("INSERT INTO tb_marcacoes_sunset (fk_espectador, fk_plataforma_sunset) VALUES (:fk_espectador, :fk_plataforma_sunset)");
                $this->db->bind("fk_espectador", $dados['id_espectador']);
                $this->db->bind("fk_plataforma_sunset", $chkReservaSunset);
                if (!$this->db->executa()) {
                    $editarReservaSunset = true;
                }
            }
        } else {

            //Se entrar aqui, foram removidas todas as marcações
            $this->db->query("DELETE FROM tb_marcacoes_sunset WHERE fk_espectador = :fk_espectador");
            $this->db->bind("fk_espectador", $dados['id_espectador']);
            if (!$this->db->executa()) {
                $editarReservaSunset = true;
            }
        }

        if ($editarReservaSunset) {
            return false;
        } else {
            return true;
        }
    }

    public function contagemMarcacoesMundo($id)
    {
        $this->db->query("SELECT count(*) as contagem FROM tb_marcacoes_mundo tmm WHERE fk_espectador = :id_espectador");
        $this->db->bind("id_espectador", $id);
        return $this->db->resultado();
    }

    public function contagemMarcacoesSunset($id)
    {
        $this->db->query("SELECT count(*) as contagem FROM tb_marcacoes_sunset tmm WHERE fk_espectador = :id_espectador");
        $this->db->bind("id_espectador", $id);
        return $this->db->resultado();
    }

    public function checkInEspectadorSunset($id)
    {

        $this->db->query("UPDATE tb_espectador SET chk_entrada_sunset = :chk_entrada_sunset WHERE id_espectador = :id_espectador");
        $this->db->bind("chk_entrada_sunset", 'S');
        $this->db->bind("id_espectador", $id);
        $this->db->executa();

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkOutEspectadorSunset($id)
    {

        $this->db->query("UPDATE tb_espectador SET chk_entrada_sunset = :chk_entrada_sunset WHERE id_espectador = :id_espectador");
        $this->db->bind("chk_entrada_sunset", NULL);
        $this->db->bind("id_espectador", $id);
        $this->db->executa();

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkInEspectadorMundo($id)
    {

        $this->db->query("UPDATE tb_espectador SET chk_entrada_mundo = :chk_entrada_mundo WHERE id_espectador = :id_espectador");
        $this->db->bind("chk_entrada_mundo", 'S');
        $this->db->bind("id_espectador", $id);
        $this->db->executa();

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkOutEspectadorMundo($id)
    {

        $this->db->query("UPDATE tb_espectador SET chk_entrada_mundo = :chk_entrada_mundo WHERE id_espectador = :id_espectador");
        $this->db->bind("chk_entrada_mundo", NULL);
        $this->db->bind("id_espectador", $id);
        $this->db->executa();

        if ($this->db->executa()) {
            return true;
        } else {
            return false;
        }
    }
}
