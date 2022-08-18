ALTER TABLE tb_condicao ADD ordem TINYINT DEFAULT NULL NULL;


UPDATE tb_condicao
	SET ordem=1
	WHERE id_condicao=1;
UPDATE tb_condicao
	SET ordem=6
	WHERE id_condicao=2;
UPDATE tb_condicao
	SET ordem=2
	WHERE id_condicao=3;
UPDATE tb_condicao
	SET ordem=3
	WHERE id_condicao=4;
UPDATE tb_condicao
	SET ordem=5
	WHERE id_condicao=5;
UPDATE tb_condicao
	SET ordem=4
	WHERE id_condicao=6;


UPDATE tb_condicao
	SET ds_condicao='PCD'
	WHERE id_condicao=1;


INSERT INTO tb_tipo_deficiencia_fisica (id_tipo_deficiencia_fisica,ds_tipo_deficiencia_fisica)
	VALUES (15,'Síndrome de down');

ALTER TABLE tb_anexo ADD chk_termo_brinquedo CHAR DEFAULT NULL NULL;





