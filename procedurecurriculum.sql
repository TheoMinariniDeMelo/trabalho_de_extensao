DELIMITER $$

CREATE PROCEDURE sp_salvar_curriculum (
    IN p_id INT,
    IN p_logradouro VARCHAR(60),
    IN p_numero VARCHAR(4),
    IN p_complemento VARCHAR(20),
    IN p_bairro VARCHAR(50),
    IN p_cep VARCHAR(8),
    IN p_cidade_id INT,
    IN p_celular VARCHAR(11),
    IN p_nascimento DATE,
    IN p_sexo CHAR(1),
    IN p_foto VARCHAR(120),
    IN p_email VARCHAR(120),
    IN p_apresentacaoPessoal TEXT,
    IN p_json_escolaridade JSON,
    IN p_json_experiencia JSON,
    IN p_json_qualificacao JSON,
    IN p_acao VARCHAR(10)
)
salvar: BEGIN
    DECLARE v_curriculum_id INT;

    IF p_acao = 'delete' THEN
        DELETE FROM curriculum_escolaridade WHERE curriculum_id = p_id;
        DELETE FROM curriculum_experiencia WHERE curriculum_id = p_id;
        DELETE FROM curriculum_qualificacao WHERE curriculum_id = p_id;
        DELETE FROM curriculum WHERE id = p_id;
        LEAVE salvar;
    END IF;

    IF p_acao = 'insert' THEN
        INSERT INTO curriculum (
            logradouro, numero, complemento, bairro, cep, cidade_id,
            celular, nascimento, sexo, foto, email, apresentacaoPessoal, statusRegistro
        ) VALUES (
            p_logradouro, p_numero, p_complemento, p_bairro, p_cep, p_cidade_id,
            p_celular, p_nascimento, p_sexo, p_foto, p_email, p_apresentacaoPessoal, 1
        );
        SET v_curriculum_id = LAST_INSERT_ID();
    ELSE
        UPDATE curriculum SET
            logradouro = p_logradouro,
            numero = p_numero,
            complemento = p_complemento,
            bairro = p_bairro,
            cep = p_cep,
            cidade_id = p_cidade_id,
            celular = p_celular,
            nascimento = p_nascimento,
            sexo = p_sexo,
            foto = p_foto,
            email = p_email,
            apresentacaoPessoal = p_apresentacaoPessoal
        WHERE id = p_id;
        SET v_curriculum_id = p_id;

        DELETE FROM curriculum_escolaridade WHERE curriculum_id = v_curriculum_id;
        DELETE FROM curriculum_experiencia WHERE curriculum_id = v_curriculum_id;
        DELETE FROM curriculum_qualificacao WHERE curriculum_id = v_curriculum_id;
    END IF;

    -- aqui seguem as inserções de escolaridade, experiência e qualificação
    -- como no seu código anterior
END $$

DELIMITER ;
