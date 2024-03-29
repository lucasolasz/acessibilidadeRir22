
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `ds_nome_usuario` varchar(255) DEFAULT NULL,
  `ds_email_usuario` varchar(255) DEFAULT NULL,
  `ds_senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  UNIQUE KEY `ds_email_usuario` (`ds_email_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


-- INSERT INTO `tb_usuario` (`id_usuario`, `ds_nome_usuario`, `ds_email_usuario`, `ds_senha`) VALUES
-- 	(0, 'admin', 'debora.c.araujo97@gmail.com', '$2y$10$QupjPG596vqS78ArxZqAquTb38gdCyA/44yfyaB5fTEvR3oKEq34S', NULL, 1);

-- UPDATE `ac-paineladm`.`tb_usuario` SET `id_usuario`='0' WHERE  `id_usuario`=11;


CREATE TABLE IF NOT EXISTS `tb_condicao` (
  `id_condicao` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `ds_condicao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_condicao`) USING BTREE,
  UNIQUE KEY `id_condicao` (`id_condicao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `tb_condicao` (`id_condicao`, `ds_condicao`) VALUES
	(1, 'PNE'),
	(2, 'Mobilidade reduzida temporária'),
	(3, 'Gestante'),
	(4, 'Idoso'),
  (5, 'Lactante'),
	(6, 'Obeso'),
  (7, 'Diabético');


CREATE TABLE IF NOT EXISTS `tb_tipo_deficiencia` (
  `id_tipo_deficiencia` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `ds_tipo_deficiencia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_deficiencia`) USING BTREE,
  UNIQUE KEY `id_tipo_deficiencia` (`id_tipo_deficiencia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `tb_tipo_deficiencia` (`id_tipo_deficiencia`, `ds_tipo_deficiencia`) VALUES
	(1, 'Fisica'),
	(2, 'Visual'),
	(3, 'Auditiva'),
	(4, 'Intelectual')

CREATE TABLE IF NOT EXISTS `tb_acompanhante` (
  `id_acompanhante` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `ds_nome_acompanhante` varchar(255) DEFAULT NULL,
  `ds_documento_acompanhante` varchar(20) DEFAULT NULL,
  `tel_acompanhante` varchar(20) DEFAULT NULL,
  `chk_menor_idade` char(1) DEFAULT NULL,
  `qtd_menor_idade` TINYINT DEFAULT NULL, 
  PRIMARY KEY (`id_acompanhante`),
  UNIQUE KEY `id_acompanhante` (`id_acompanhante`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `tb_guarda_volume` (
  `id_guarda_volume` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `ds_guarda_volume` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_guarda_volume`) USING BTREE,
  UNIQUE KEY `id_guarda_volume` (`id_guarda_volume`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `tb_guarda_volume` (`id_guarda_volume`, `ds_guarda_volume`) VALUES
	(1, 'Muleta'),
	(2, 'Insulina'),
	(3, 'Cadeira de Rodas');

CREATE TABLE IF NOT EXISTS `tb_acesso_servico` (
  `id_acesso_servico` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `ds_acesso_servico` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_acesso_servico`) USING BTREE,
  UNIQUE KEY `id_acesso_servico` (`id_acesso_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `tb_acesso_servico` (`id_acesso_servico`, `ds_acesso_servico`) VALUES
	(1, 'Plataformas'),
	(2, 'Fila Prioritária'),
	(3, 'Banheiro'),
	(4, 'Cadeira de Rodas'),
	(5, 'Guarda volume');
  

--Solicitado pela débora 16/08/2022
ALTER TABLE tb_acesso_servico ADD ordem TINYINT DEFAULT NULL NULL;

UPDATE tb_acesso_servico SET ordem=3 WHERE id_acesso_servico=1;
UPDATE tb_acesso_servico SET ordem=2 WHERE id_acesso_servico=2;
UPDATE tb_acesso_servico SET ordem=1 WHERE id_acesso_servico=3;
UPDATE tb_acesso_servico SET ordem=4 WHERE id_acesso_servico=4;
UPDATE tb_acesso_servico SET ordem=5 WHERE id_acesso_servico=5;
--


CREATE TABLE IF NOT EXISTS `tb_cadeira_rodas` (
  `id_cadeira_rodas` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `num_cadeira_rodas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cadeira_rodas`) USING BTREE,
  UNIQUE KEY `id_cadeira_rodas` (`id_cadeira_rodas`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `tb_espectador` (
  `id_espectador` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `ds_nome_espectador` varchar(255) DEFAULT NULL,
  `ds_documento_espectador` varchar(20) DEFAULT NULL,
  `ds_descricao_deficiencia` varchar(255) DEFAULT NULL,
  `tel_espectador` varchar(20) DEFAULT NULL,
  `idade_espectador` int(1) DEFAULT NULL,
  `chk_kit_livre` char(1) DEFAULT NULL,
  `fk_condicao` int(2) unsigned DEFAULT NULL,
  `chk_acompanhante` char(1) DEFAULT NULL,
  `fk_acompanhante` int(4) unsigned DEFAULT NULL,
  `fk_cadeira_rodas` int(2) unsigned DEFAULT NULL,
  `fk_usuario` int(4) unsigned DEFAULT NULL,
  `fk_tipo_deficiencia_fisica` TINYINT unsigned DEFAULT NULL, 
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_espectador`),
  UNIQUE KEY `id_espectador` (`id_espectador`),
  KEY `fk_condicao_tb_codicao` (`fk_condicao`),
  KEY `fk_acompanhante_tb_condicao` (`fk_acompanhante`),
  KEY `fk_cadeira_rodas_tb_cadeira_rodas` (`fk_cadeira_rodas`),
  KEY `fk_usuario_tb_usuario` (`fk_usuario`),
  KEY `fk_tipo_deficiencia_fisica_tb_tipo_deficiencia_fisica` (`fk_tipo_deficiencia_fisica`),
  CONSTRAINT `fk_condicao_tb_espectador` FOREIGN KEY (`fk_condicao`) REFERENCES `tb_condicao` (`id_condicao`),
  CONSTRAINT `fk_acompanhante_tb_espectador` FOREIGN KEY (`fk_acompanhante`) REFERENCES `tb_acompanhante` (`id_acompanhante`),
  CONSTRAINT `fk_cadeira_rodas_tb_espectador` FOREIGN KEY (`fk_cadeira_rodas`) REFERENCES `tb_cadeira_rodas` (`id_cadeira_rodas`),
  CONSTRAINT `fk_usuario_tb_espectador` FOREIGN KEY (`fk_usuario`) REFERENCES `tb_usuario` (`id_usuario`),
  CONSTRAINT `fk_tipo_deficiencia_fisica_tb_espectador` FOREIGN KEY (`fk_tipo_deficiencia_fisica`) REFERENCES `tb_tipo_deficiencia_fisica` (`id_tipo_deficiencia_fisica`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `tb_anexo`(
    `id_anexo` int(4) unsigned NOT NULL AUTO_INCREMENT,
    `fk_espectador` int(4) unsigned DEFAULT NULL,
    `nm_path_arquivo` varchar(300) DEFAULT NULL,
    `nm_arquivo` varchar(300) DEFAULT NULL,
    `fk_usuario` int(4) unsigned DEFAULT NULL,
    `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id_anexo`),
    KEY `fk_espectador_tb_espectador` (`fk_espectador`),
    CONSTRAINT `fk_espectador_tb_anexo` FOREIGN KEY (`fk_espectador`) REFERENCES `tb_espectador` (`id_espectador`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `tb_tipo_deficiencia_fisica` (
  `id_tipo_deficiencia_fisica` TINYINT unsigned NOT NULL AUTO_INCREMENT,
  `ds_tipo_deficiencia_fisica` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_deficiencia_fisica`) USING BTREE,
  UNIQUE KEY `id_tipo_deficiencia_fisica` (`id_tipo_deficiencia_fisica`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `tb_tipo_deficiencia_fisica` (`id_tipo_deficiencia_fisica`, `ds_tipo_deficiencia_fisica`) VALUES
( 1,'Paraplegia'),
( 2,'Paraparesia'),	
( 3,'Monoplegia'),
( 4,'Monoparesia'),	
( 5,'Tetraplegia'),	
( 6,'Tetraparesia'),
( 7,'Triplegia'),	
( 8,'Triparesia'),	
( 9,'Hemiplegia'),	
( 10,'Hemiparesia'),	
( 11,'Amputação'),	
( 12,'Paralisia'),
( 13,'Ostomia'),
( 14,'Nanismo');