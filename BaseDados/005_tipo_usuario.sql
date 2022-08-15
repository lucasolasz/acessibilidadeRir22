CREATE TABLE tb_perfil_usuario (
  id_perfil_usuario int(2) unsigned NOT NULL AUTO_INCREMENT,
  ds_perfil_usuario varchar(50) DEFAULT NULL,
  PRIMARY KEY (id_perfil_usuario) USING BTREE,
  UNIQUE KEY id_perfil_usuario (id_perfil_usuario)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tb_perfil_usuario (id_perfil_usuario, ds_perfil_usuario) VALUES
	(1, 'Administrador'),
	(2, 'Monitor'),
	(3, 'Colaborador');

ALTER TABLE tb_usuario ADD fk_perfil_usuario int(2) unsigned;

ALTER TABLE tb_usuario ADD CONSTRAINT fk_perfil_usuario_tb_usuario 
FOREIGN KEY(fk_perfil_usuario) REFERENCES tb_perfil_usuario(id_perfil_usuario);

UPDATE acessibilidaderir.tb_usuario
	SET fk_perfil_usuario=1
	WHERE id_usuario=11;


