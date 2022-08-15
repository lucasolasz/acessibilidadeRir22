
CREATE TABLE IF NOT EXISTS tb_hora (
  id_hora TINYINT unsigned NOT NULL AUTO_INCREMENT,
  range_hora varchar(30) DEFAULT NULL,
  chk_tirolesa char(1) DEFAULT NULL,
  chk_roda_gigante char(1) DEFAULT NULL,
  PRIMARY KEY (id_hora) USING BTREE,
  UNIQUE KEY id_hora (id_hora)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT INTO tb_hora (id_hora, range_hora) VALUES
	(1, '13:00H-14:00H'),
	(2, '14:00H-15:00H'),
	(3, '15:00H-16:00H'),
	(4, '16:00H-17:00H'),
  (5, '17:00H-18:00H'),
	(6, '18:00H-19:00H'),
	(7, '19:00H-20:00H'),
	(8, '20:00H-21:00H'),
	(9, '21:00H-22:00H'),
	(10, '22:00H-23:00H'),
	(11, '23:00H-00:00H');



CREATE TABLE IF NOT EXISTS tb_trinta_min (
  id_trinta_min TINYINT unsigned NOT NULL AUTO_INCREMENT,
  range_trinta_min varchar(30) DEFAULT NULL,
  chk_montanha_russa char(1) DEFAULT NULL,
  PRIMARY KEY (id_trinta_min) USING BTREE,
  UNIQUE KEY id_trinta_min (id_trinta_min)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT INTO tb_trinta_min (id_trinta_min, range_trinta_min) VALUES
(1,"13:00H-13:30H"),
(2,"13:30H-14:00H"),
(3,"14:00H-14:30H"),
(4,"14:30H-15:00H"),
(5,"15:00H-15:30H"),
(6,"15:30H-16:00H"),
(7,"16:00H-16:30H"),
(8,"16:30H-17:00H"),
(9,"17:00H-17:30H"),
(10,"17:30H-18:00H"),
(11,"18:00H-18:30H"),
(12,"18:30H-19:00H"),
(13,"19:00H-19:30H"),
(14,"19:30H-20:00H"),
(15,"20:00H-20:30H"),
(16,"20:30H-21:00H"),
(17,"21:00H-21:30H"),
(18,"21:30H-22:00H"),
(19,"22:00H-22:30H"),
(20,"22:30H-23:00H"),
(21,"23:00H-23:30H"),
(22,"23:30H-00:00H");


CREATE TABLE IF NOT EXISTS tb_quinze_min (
  id_quinze_min TINYINT unsigned NOT NULL AUTO_INCREMENT,
  range_quinze_min varchar(30) DEFAULT NULL,
  chk_cabum char(1) DEFAULT NULL,
  PRIMARY KEY (id_quinze_min) USING BTREE,
  UNIQUE KEY id_quinze_min (id_quinze_min)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO tb_quinze_min (id_quinze_min, range_quinze_min) VALUES
(1,"13:00H-13:15H"),
(2,"13:15H-13:30H"),
(3,"13:30H-13:45H"),
(4,"13:45H-14:00H"),
(5,"14:00H-14:15H"),
(6,"14:15H-14:30H"),
(7,"14:30H-14:45H"),
(8,"14:45H-15:00H"),
(9,"15:00H-15:15H"),
(10,"15:15H-15:30H"),
(11,"15:30H-15:45H"),
(12,"15:45H-16:00H"),
(13,"16:00H-16:15H"),
(14,"16:15H-16:30H"),
(15,"16:30H-16:45H"),
(16,"16:45H-17:00H"),
(17,"17:00H-17:15H"),
(18,"17:15H-17:30H"),
(19,"17:30H-17:45H"),
(20,"17:45H-18:00H"),
(21,"18:00H-18:15H"),
(22,"18:15H-18:30H"),
(23,"18:30H-18:45H"),
(24,"18:45H-19:00H"),
(25,"19:00H-19:15H"),
(26,"19:15H-19:30H"),
(27,"19:30H-19:45H"),
(28,"19:45H-20:00H"),
(29,"20:00H-20:15H"),
(30,"20:15H-20:30H"),
(31,"20:30H-20:45H"),
(32,"20:45H-21:00H"),
(33,"21:00H-21:15H"),
(34,"21:15H-21:30H"),
(35,"21:30H-21:45H"),
(36,"21:45H-22:00H"),
(37,"22:00H-22:15H"),
(38,"22:15H-22:30H"),
(39,"22:30H-22:45H"),
(40,"22:45H-23:00H"),
(41,"23:00H-23:15H"),
(42,"23:15H-23:30H"),
(43,"23:30H-23:45H"),
(44,"23:45H-00:00H");

CREATE TABLE IF NOT EXISTS tb_brinquedo (
  id_brinquedo TINYINT unsigned NOT NULL AUTO_INCREMENT,
  ds_brinquedo varchar(50) DEFAULT NULL,
  PRIMARY KEY (id_brinquedo) USING BTREE,
  UNIQUE KEY id_brinquedo (id_brinquedo)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO tb_brinquedo (id_brinquedo, ds_brinquedo) VALUES
(1, "Tirolesa"),
(2,"Montanha Russa"),
(3,"Cabum"),
(4,"Roda Gigante");


CREATE TABLE tb_agenda_brinquedo (
  fk_espectador int(4) unsigned DEFAULT NULL,
  fk_brinquedo TINYINT unsigned DEFAULT NULL,
  fk_hora_tirolesa TINYINT unsigned DEFAULT NULL,
  fk_hora_roda_gigante TINYINT unsigned DEFAULT NULL,
  fk_trinta_min TINYINT unsigned DEFAULT NULL,
  fk_quinze_min TINYINT unsigned DEFAULT NULL,
  KEY fk_espectador_tb_espectador (fk_espectador),
  KEY fk_brinquedo_tb_brinquedo (fk_brinquedo),
  KEY fk_hora_tirolesa_tb_hora (fk_hora_tirolesa),
  KEY fk_hora_roda_gigante_tb_hora (fk_hora_roda_gigante),
  KEY fk_trinta_min_tb_trinta_min (fk_trinta_min),
  KEY fk_quinze_min_tb_quinze_min (fk_quinze_min),  
  CONSTRAINT fk_espectador_tb_agenda_brinquedo FOREIGN KEY (fk_espectador) REFERENCES tb_espectador (id_espectador),
  CONSTRAINT fk_brinquedo_tb_agenda_brinquedo FOREIGN KEY (fk_brinquedo) REFERENCES tb_brinquedo (id_brinquedo),
  CONSTRAINT fk_hora_tirolesa_tb_agenda_brinquedo FOREIGN KEY (fk_hora_tirolesa) REFERENCES tb_hora (id_hora),
  CONSTRAINT fk_hora_roda_gigante_tb_agenda_brinquedo FOREIGN KEY (fk_hora_roda_gigante) REFERENCES tb_hora (id_hora),
  CONSTRAINT fk_trinta_min_tb_agenda_brinquedo FOREIGN KEY (fk_trinta_min) REFERENCES tb_trinta_min (id_trinta_min),
  CONSTRAINT fk_quinze_min_tb_agenda_brinquedo FOREIGN KEY (fk_quinze_min) REFERENCES tb_quinze_min (id_quinze_min)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

