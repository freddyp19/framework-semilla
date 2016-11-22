/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS tbl_estatus_usuarios (
    id_estatu_usuario INT(11) NOT NULL AUTO_INCREMENT,
    estatu_usuario VARCHAR(50) NOT NULL,
	PRIMARY KEY (id_estatu_usuario)
)ENGINE=INNODB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tbl_modulos (
    id_modulo INT(11) NOT NULL AUTO_INCREMENT,
    modulo VARCHAR(80) NOT NULL,
    descripcion_modulo TEXT NOT NULL,
    posicion_modulo  INT(11) NOT NULL,
    PRIMARY KEY (id_modulo)
)ENGINE=INNODB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tbl_perfiles (
    id_perfil INT(11) NOT NULL AUTO_INCREMENT,
    perfil VARCHAR(120) NOT NULL,
	PRIMARY KEY (id_perfil)
)ENGINE=INNODB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tbl_regiones (
    id_region  INT(11) NOT NULL AUTO_INCREMENT,
    region VARCHAR(250) NOT NULL,
	PRIMARY KEY (id_region)
)ENGINE=INNODB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS tbl_sub_modulos (
    id_sub_modulo  INT(11) NOT NULL AUTO_INCREMENT,
    sub_modulo TEXT NOT NULL,
    id_modulo  INT(11) NOT NULL,
    posicion_sub_modulo  INT(11) NOT NULL,
    descripcion_sub_modulo TEXT NOT NULL,
    enlace TEXT NOT NULL,
	PRIMARY KEY (id_sub_modulo)
)ENGINE=INNODB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tbl_usuarios (
    cedula VARCHAR(12),
	usuario VARCHAR(50) NOT NULL,
    clave VARCHAR(15) NOT NULL,
    nombres VARCHAR(80) NOT NULL,
    apellidos VARCHAR(80) NOT NULL,
    correo_electronico VARCHAR(80) NOT NULL,
    id_estatu_usuario  INT(11) NOT NULL,
    id_perfil  INT(11) NOT NULL,
    id_region  INT(11) NOT NULL,
	PRIMARY KEY (usuario)
)ENGINE=INNODB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tbl_modulos_perfiles (
  id_modulo_perfil INT(11) NOT NULL AUTO_INCREMENT,
  id_modulo INT(11) NOT NULL,
  id_perfil INT(11) NOT NULL,
  PRIMARY KEY (id_modulo_perfil) 
) ENGINE=INNODB  DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE tbl_sub_modulos DROP FOREIGN KEY fk_tbl_sub_modulos_id_modulo;
ALTER TABLE tbl_sub_modulos DROP INDEX fk_tbl_sub_modulos_id_modulo;
ALTER IGNORE TABLE tbl_sub_modulos ADD CONSTRAINT fk_tbl_sub_modulos_id_modulo FOREIGN KEY (id_modulo) REFERENCES tbl_modulos(id_modulo);

ALTER TABLE tbl_modulos_perfiles DROP FOREIGN KEY FK_modulo_id_modulo;
ALTER TABLE tbl_modulos_perfiles DROP INDEX FK_modulo_id_modulo;
ALTER IGNORE TABLE tbl_modulos_perfiles ADD CONSTRAINT FK_modulo_id_modulo FOREIGN KEY (id_modulo) REFERENCES tbl_modulos(id_modulo) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE tbl_modulos_perfiles DROP FOREIGN KEY FK_modulo_id_perfil;
ALTER TABLE tbl_modulos_perfiles DROP INDEX FK_modulo_id_perfil;
ALTER IGNORE TABLE tbl_modulos_perfiles ADD CONSTRAINT FK_modulo_id_perfil FOREIGN KEY (id_perfil) REFERENCES tbl_perfiles(id_perfil) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE tbl_usuarios DROP FOREIGN KEY fk_id_perfil;
ALTER TABLE tbl_usuarios DROP INDEX fk_id_perfil;
ALTER IGNORE TABLE tbl_usuarios ADD CONSTRAINT fk_id_perfil FOREIGN KEY (id_perfil) REFERENCES tbl_perfiles(id_perfil) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE tbl_usuarios DROP FOREIGN KEY fk_id_region;
ALTER TABLE tbl_usuarios DROP INDEX fk_id_region;
ALTER IGNORE TABLE tbl_usuarios ADD CONSTRAINT fk_id_region FOREIGN KEY (id_region) REFERENCES tbl_regiones(id_region) ON UPDATE CASCADE ON DELETE RESTRICT;

ALTER TABLE tbl_usuarios DROP FOREIGN KEY fk_tbl_usuarios_id_estatu_usuario;
ALTER TABLE tbl_usuarios DROP INDEX fk_tbl_usuarios_id_estatu_usuario;
ALTER IGNORE TABLE tbl_usuarios ADD CONSTRAINT fk_tbl_usuarios_id_estatu_usuario FOREIGN KEY (id_estatu_usuario) REFERENCES tbl_estatus_usuarios(id_estatu_usuario) ON UPDATE CASCADE ON DELETE RESTRICT;

SET FOREIGN_KEY_CHECKS = 1;

INSERT IGNORE INTO tbl_estatus_usuarios (id_estatu_usuario, estatu_usuario) VALUES (1, 'Activos');
INSERT IGNORE INTO tbl_estatus_usuarios (id_estatu_usuario, estatu_usuario) VALUES (2, 'Inactivo');

INSERT IGNORE INTO tbl_perfiles (id_perfil, perfil) VALUES (1, 'Super Administrador del sistema');

INSERT IGNORE INTO tbl_regiones (id_region, region) VALUES (1, 'Distrito Capital');
INSERT IGNORE INTO tbl_regiones (id_region, region) VALUES (2, 'Maturin');

INSERT IGNORE INTO tbl_modulos (id_modulo, modulo, descripcion_modulo, posicion_modulo) VALUES (1, 'Configuracion del Sistema', 'Configuracion del Sistema', 1);

INSERT IGNORE INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (1, 'Perfiles', 1, 1, 'Perfiles', '../tbl_perfiles/formulario.php?accion=insertar');
INSERT IGNORE INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (2, 'Modulos', 1, 2, 'Modulos', '../tbl_modulos/formulario.php?accion=insertar');
INSERT IGNORE INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (3, 'Modulos Perfiles', 1, 3, 'Modulos Perfiles', '../tbl_modulos_perfiles/formulario.php?accion=insertar');
INSERT IGNORE INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (4, 'Sub Modulos', 1, 4, 'sub_modulos', '../tbl_sub_modulos/formulario.php?accion=insertar');
INSERT IGNORE INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (5, 'Regiones', 1, 5, 'Regiones', '../tbl_regiones/formulario.php?accion=insertar');
INSERT IGNORE INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (6, 'Estatus Usuarios', 1, 6, 'Estatus Usuarios', '../tbl_estatus_usuarios/formulario.php?accion=insertar');
INSERT IGNORE INTO tbl_sub_modulos (id_sub_modulo, sub_modulo, id_modulo, posicion_sub_modulo, descripcion_sub_modulo, enlace) VALUES (7, 'Usuarios', 1, 7, 'Usuarios', '../tbl_usuarios/formulario.php?accion=insertar');


INSERT IGNORE INTO tbl_modulos_perfiles (id_modulo_perfil, id_modulo, id_perfil) VALUES (1, 1, 1);

INSERT IGNORE INTO tbl_usuarios(cedula,usuario,clave,nombres,apellidos,correo_electronico,id_estatu_usuario,id_perfil,id_region) VALUES (1,'super_admin','123456','super administrador','del sistema','super@gmail.com',1,1,1);
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;