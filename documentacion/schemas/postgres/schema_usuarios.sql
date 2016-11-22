SET client_encoding = 'UTF8';
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

CREATE SCHEMA schema_usuarios;

SET search_path = schema_usuarios, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

CREATE TABLE tbl_estatus_usuarios (
    id_estatu_usuario integer NOT NULL,
    estatu_usuario character varying(80) NOT NULL
);

CREATE SEQUENCE tbl_estatus_usuarios_id_estatu_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


CREATE TABLE tbl_modulos (
    id_modulo integer NOT NULL,
    modulo character varying(80) NOT NULL,
    descripcion_modulo text NOT NULL,
    posicion_modulo integer NOT NULL
);

CREATE SEQUENCE tbl_modulos_id_modulo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;



CREATE TABLE tbl_perfiles (
    id_perfil integer NOT NULL,
    perfil character varying(120) NOT NULL
);

CREATE SEQUENCE tbl_perfiles_id_perfil_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;



CREATE SEQUENCE tbl_perfiles_usuarios_id_perfil_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

CREATE TABLE tbl_regiones (
    id_region integer NOT NULL,
    region character varying(250) NOT NULL
);

CREATE SEQUENCE tbl_regiones_id_region_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;



CREATE TABLE tbl_sub_modulos (
    id_sub_modulo integer NOT NULL,
    sub_modulo text NOT NULL,
    id_modulo integer NOT NULL,
    posicion_sub_modulo integer NOT NULL,
    descripcion_sub_modulo text NOT NULL,
    enlace text NOT NULL
);

CREATE SEQUENCE tbl_sub_modulos_id_sub_modulo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


CREATE TABLE tbl_usuarios (
    cedula character varying(12),
    nombres character(80) NOT NULL,
    apellidos character(80) NOT NULL,
    correo_electronico character varying(80) NOT NULL,
    usuario character varying(30) NOT NULL,
    clave character varying(15),
    id_estatu_usuario integer NOT NULL,
    id_perfil integer NOT NULL,
    id_region integer NOT NULL
);


CREATE TABLE tbl_modulos_perfiles (
  id_modulo_perfil integer NOT NULL,
  id_modulo integer NOT NULL,
  id_perfil integer NOT NULL
);

CREATE SEQUENCE tbl_modulos_perfiles_id_modulo_perfil_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

ALTER TABLE tbl_estatus_usuarios ALTER COLUMN id_estatu_usuario SET DEFAULT nextval('tbl_estatus_usuarios_id_estatu_usuario_seq'::regclass);

ALTER TABLE tbl_modulos ALTER COLUMN id_modulo SET DEFAULT nextval('tbl_modulos_id_modulo_seq'::regclass);

ALTER TABLE tbl_perfiles ALTER COLUMN id_perfil SET DEFAULT nextval('tbl_perfiles_id_perfil_seq'::regclass);

ALTER TABLE tbl_regiones ALTER COLUMN id_region SET DEFAULT nextval('tbl_regiones_id_region_seq'::regclass);

ALTER TABLE tbl_sub_modulos ALTER COLUMN id_sub_modulo SET DEFAULT nextval('tbl_sub_modulos_id_sub_modulo_seq'::regclass);

ALTER TABLE tbl_modulos_perfiles ALTER COLUMN id_modulo_perfil SET DEFAULT nextval('tbl_modulos_perfiles_id_modulo_perfil_seq'::regclass);

ALTER TABLE ONLY tbl_regiones
    ADD CONSTRAINT pk_id_region PRIMARY KEY (id_region);

ALTER TABLE ONLY tbl_estatus_usuarios
    ADD CONSTRAINT pk_tbl_estatus_usarios_id_estatu_usuario PRIMARY KEY (id_estatu_usuario);

ALTER TABLE ONLY tbl_modulos
    ADD CONSTRAINT pk_tbl_modulos_id_modulo PRIMARY KEY (id_modulo);
	
ALTER TABLE ONLY tbl_modulos_perfiles
    ADD CONSTRAINT pk_id_modulo_pefil PRIMARY KEY (id_modulo_perfil);

ALTER TABLE ONLY tbl_perfiles
    ADD CONSTRAINT pk_tbl_perfiles_id_perfil PRIMARY KEY (id_perfil);

ALTER TABLE ONLY tbl_sub_modulos
    ADD CONSTRAINT pk_tbl_sub_modulos_id_sub_modulo PRIMARY KEY (id_sub_modulo);

ALTER TABLE ONLY tbl_usuarios
    ADD CONSTRAINT pk_usuario PRIMARY KEY (usuario);

ALTER TABLE ONLY tbl_usuarios
    ADD CONSTRAINT fk_id_perfil FOREIGN KEY (id_perfil) REFERENCES tbl_perfiles(id_perfil) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE ONLY tbl_usuarios
    ADD CONSTRAINT fk_id_region FOREIGN KEY (id_region) REFERENCES tbl_regiones(id_region) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE ONLY tbl_sub_modulos
    ADD CONSTRAINT fk_tbl_sub_modulos_id_modulo FOREIGN KEY (id_modulo) REFERENCES tbl_modulos(id_modulo);

ALTER TABLE ONLY tbl_modulos_perfiles
    ADD CONSTRAINT fk_modulo_id_modulo FOREIGN KEY (id_modulo) REFERENCES tbl_modulos(id_modulo) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE ONLY tbl_modulos_perfiles
    ADD CONSTRAINT fk_modulo_id_perfil FOREIGN KEY (id_perfil) REFERENCES tbl_perfiles(id_perfil) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE ONLY tbl_usuarios
    ADD CONSTRAINT fk_tbl_usuarios_id_estatu_usuario FOREIGN KEY (id_estatu_usuario) REFERENCES tbl_estatus_usuarios(id_estatu_usuario) ON UPDATE CASCADE ON DELETE RESTRICT;
	
SET client_encoding = 'UTF8';
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = schema_usuarios, pg_catalog;

SELECT pg_catalog.setval('tbl_estatus_usuarios_id_estatu_usuario_seq', 2, true);

SELECT pg_catalog.setval('tbl_modulos_id_modulo_seq', 1, true);

SELECT pg_catalog.setval('tbl_perfiles_id_perfil_seq', 1, true);


SELECT pg_catalog.setval('tbl_perfiles_usuarios_id_perfil_usuario_seq', 1, false);

SELECT pg_catalog.setval('tbl_regiones_id_region_seq', 2, true);

SELECT pg_catalog.setval('tbl_sub_modulos_id_sub_modulo_seq', 6, true);

INSERT INTO tbl_estatus_usuarios (id_estatu_usuario, estatu_usuario) VALUES (1, 'Activos');
INSERT INTO tbl_estatus_usuarios (id_estatu_usuario, estatu_usuario) VALUES (2, 'Inactivo');

INSERT INTO tbl_perfiles (id_perfil, perfil) VALUES (1, 'Super Administrador del sistema');

INSERT INTO tbl_regiones (id_region, region) VALUES (1, 'Distrito Capital');
INSERT INTO tbl_regiones (id_region, region) VALUES (2, 'Maturin');

INSERT INTO tbl_modulos (id_modulo, modulo, descripcion_modulo, posicion_modulo) VALUES (1, 'Configuracion Base', 'Configuracion Base', 1);
INSERT INTO tbl_modulos_perfiles (id_modulo_perfil, id_modulo, id_perfil) VALUES (1, 1, 1);

INSERT INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (1, 'Perfiles', 1, 1, 'Perfiles', '../../schema_usuarios/tbl_perfiles/formulario.php?accion=insertar');
INSERT INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (2, 'Modulos', 1, 2, 'Modulos', '../../schema_usuarios/tbl_modulos/formulario.php?accion=insertar');
INSERT INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (3, 'Modulos Perfiles', 1, 3, 'Modulos Perfiles', '../../schema_usuarios/tbl_modulos_perfiles/formulario.php?accion=insertar');
INSERT INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (4, 'Sub Modulos', 1, 3, 'sub_modulos', '../../schema_usuarios/tbl_sub_modulos/formulario.php?accion=insertar');
INSERT INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (5, 'Regiones', 1, 4, 'Regiones', '../../schema_usuarios/tbl_regiones/formulario.php?accion=insertar');
INSERT INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (6, 'Estatus Usuarios', 1, 5, 'Estatus Usuarios', '../../schema_usuarios/tbl_estatus_usuarios/formulario.php?accion=insertar');
INSERT INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (7, 'Usuarios', 1, 6, 'Usuarios', '../../schema_usuarios/tbl_usuarios/formulario.php?accion=insertar')
