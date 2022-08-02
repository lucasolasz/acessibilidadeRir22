CREATE TABLE tb_relac_acesso_servico (
  fk_acesso_servico int(2) unsigned NOT NULL,
  fk_espectador int(4) unsigned NOT NULL,
  KEY fk_acesso_servico_tb_acesso_servico (fk_acesso_servico),
  KEY fk_espectador_tb_espectador (fk_espectador),
  CONSTRAINT fk_acesso_servico_tb_relac_acesso_servico FOREIGN KEY (fk_acesso_servico) REFERENCES tb_acesso_servico (id_acesso_servico),
  CONSTRAINT fk_espectador_tb_relac_acesso_servico FOREIGN KEY (fk_espectador) REFERENCES tb_espectador (id_espectador)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

CREATE TABLE tb_relac_tipo_deficiencia (
  fk_tipo_deficiencia int(2) unsigned NOT NULL,
  fk_espectador int(4) unsigned NOT NULL,
  KEY fk_tipo_deficiencia_tb_tipo_deficiencia (fk_tipo_deficiencia),
  KEY fk_espectador_tb_espectador (fk_espectador),
  CONSTRAINT fk_tipo_deficiencia_tb_relac_tipo_deficiencia FOREIGN KEY (fk_tipo_deficiencia) REFERENCES tb_tipo_deficiencia (id_tipo_deficiencia),
  CONSTRAINT fk_espectador_tb_relac_tipo_deficiencia FOREIGN KEY (fk_espectador) REFERENCES tb_espectador (id_espectador)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

CREATE TABLE tb_relac_guarda_volumes (
  fk_guarda_volumes int(2) unsigned NOT NULL,
  fk_espectador int(4) unsigned NOT NULL,
  KEY fk_guarda_volumes_tb_guarda_volume (fk_guarda_volumes),
  KEY fk_espectador_tb_espectador (fk_espectador),
  CONSTRAINT fk_guarda_volumes_tb_relac_guarda_volumes FOREIGN KEY (fk_guarda_volumes) REFERENCES tb_guarda_volume (id_guarda_volume),
  CONSTRAINT fk_espectador_tb_relac_guarda_volumes FOREIGN KEY (fk_espectador) REFERENCES tb_espectador (id_espectador)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;