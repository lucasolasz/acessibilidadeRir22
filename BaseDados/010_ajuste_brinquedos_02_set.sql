ALTER TABLE tb_agenda_brinquedo DROP FOREIGN KEY fk_trinta_min_tb_agenda_brinquedo;
ALTER TABLE tb_agenda_brinquedo DROP COLUMN fk_trinta_min;


ALTER TABLE tb_agenda_brinquedo ADD COLUMN fk_hora_montanha_russa TINYINT unsigned DEFAULT NULL;
ALTER TABLE tb_agenda_brinquedo ADD CONSTRAINT fk_hora_montanha_russa_tb_agenda_brinquedo FOREIGN KEY (fk_hora_montanha_russa) REFERENCES tb_hora ( id_hora );


ALTER TABLE tb_agenda_brinquedo CHANGE fk_quinze_min fk_quinze_mega_drop tinyint(3) unsigned DEFAULT NULL NULL;



ALTER TABLE tb_agenda_brinquedo ADD COLUMN fk_quinze_carrosel TINYINT unsigned DEFAULT NULL;
ALTER TABLE tb_agenda_brinquedo ADD CONSTRAINT fk_quinze_carrosel_tb_agenda_brinquedo FOREIGN KEY (fk_quinze_carrosel) REFERENCES tb_quinze_min ( id_quinze_min );


ALTER TABLE tb_agenda_brinquedo ADD COLUMN fk_quinze_discovery TINYINT unsigned DEFAULT NULL;
ALTER TABLE tb_agenda_brinquedo ADD CONSTRAINT fk_quinze_discovery_tb_agenda_brinquedo FOREIGN KEY (fk_quinze_discovery) REFERENCES tb_quinze_min ( id_quinze_min );


--  Auto-generated SQL script #202209021031
INSERT INTO tb_brinquedo (id_brinquedo,ds_brinquedo)
	VALUES (5,'Carrosel');
INSERT INTO tb_brinquedo (id_brinquedo,ds_brinquedo)
	VALUES (6,'Discovery');
UPDATE tb_brinquedo
	SET ds_brinquedo='Mega drop'
	WHERE id_brinquedo=3;



