SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

CREATE SCHEMA schema_auditoria;

SET search_path = schema_auditoria, pg_catalog;

SET default_with_oids = false;

CREATE TABLE tbl_cambios_tablas (
    usuario character varying,
    fecha date DEFAULT now() NOT NULL,
    hora time without time zone DEFAULT now() NOT NULL,
    nombre_esquema character varying(60) NOT NULL,
    nombre_tabla character varying(60) NOT NULL,
    accion character(6) NOT NULL,
    dato_anterior text,
    dato_nuevo text
);

COMMENT ON COLUMN tbl_cambios_tablas.usuario IS 'Nombre de Usuario que realiza el cambio en los datos de la Tabla del Sistema.';

COMMENT ON COLUMN tbl_cambios_tablas.fecha IS 'Fecha en que realiza el cambio en los datos de la Tabla.';

COMMENT ON COLUMN tbl_cambios_tablas.hora IS 'Hora en que se realiza el cambio en los datos de la Tabla.';

COMMENT ON COLUMN tbl_cambios_tablas.nombre_esquema IS 'Nombre del Esquema donde esta la Tabla a la que se le realiza el cambio de los datos.';

COMMENT ON COLUMN tbl_cambios_tablas.nombre_tabla IS 'Nombre de la Tabla a la que se le realiza el cambio de los datos.';

COMMENT ON COLUMN tbl_cambios_tablas.accion IS 'Tipo de cambio en los datos de la Tabla: INSERT, UPDATE o DELETE.';

COMMENT ON COLUMN tbl_cambios_tablas.dato_anterior IS 'Datos anteriores de la fila afectada en la tabla (En caso de UPDATE o DELETE).';

COMMENT ON COLUMN tbl_cambios_tablas.dato_nuevo IS 'Datos nuevos de la fila afectada en la tabla (En caso de INSERT o UPDATE).';

SET default_with_oids = true;

CREATE TABLE tbl_cuenta_transaccion (
    nombre_tabla character varying(60) NOT NULL,
    fecha date NOT NULL,
    accion character(6) NOT NULL,
    cantidad bigint DEFAULT 0
);

COMMENT ON TABLE tbl_cuenta_transaccion IS 'Tabla que lleva el registro de las diferentes transacciones que se realizan en el sistema. Se pueden llamar transacciones a Consultar, Insertar, Eliminar ó Actualizar.';

COMMENT ON COLUMN tbl_cuenta_transaccion.nombre_tabla IS 'Nombre de la tabla a la cual el usuario ingresa para realizar cualquier acción.';

COMMENT ON COLUMN tbl_cuenta_transaccion.fecha IS 'Fecha en la cual el usuario ingresa al sistema para realizar cualquier acción.';

COMMENT ON COLUMN tbl_cuenta_transaccion.accion IS 'Es la trasacción que realiza el usuario ya sea Insertar, Modificar ó Eliminar.';

COMMENT ON COLUMN tbl_cuenta_transaccion.cantidad IS 'Número de veces que el usuario realiza acciones dentro de la tabla del sistema.';

SET default_with_oids = false;

CREATE TABLE tbl_ingreso_salida_sistema (
    id integer NOT NULL,
    usuario character varying(20) NOT NULL,
    fecha_entrada date NOT NULL,
    hora_entrada time without time zone NOT NULL,
    fecha_salida date,
    hora_salida time without time zone
);

COMMENT ON COLUMN tbl_ingreso_salida_sistema.id IS 'Número correlativo que identifica los ingresos y salidas del sistemas.';
COMMENT ON COLUMN tbl_ingreso_salida_sistema.usuario IS 'Nombre de usuario, quien ingresa al sistema.';
COMMENT ON COLUMN tbl_ingreso_salida_sistema.fecha_entrada IS 'Fecha en la cual el usuario ingresa al sistema.';
COMMENT ON COLUMN tbl_ingreso_salida_sistema.hora_entrada IS 'Hora en la cual el usuario ingresa al sistema.';
COMMENT ON COLUMN tbl_ingreso_salida_sistema.fecha_salida IS 'Fecha de salida del usuario donde el mismo cierra sesión. Cuando el usuario cierra el navegador sin hacer click en "Cerrar Sesion", esta fecha no se registra.';
COMMENT ON COLUMN tbl_ingreso_salida_sistema.hora_salida IS 'Hora de salida del usuario, donde el mismo cierra sesión. Cuando el usuario cierra el navegador sin hacer click en "Cerrar Sesion", esta hora no se registra.';
CREATE SEQUENCE tbl_ingreso_salida_sistema_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;

CREATE TABLE tbl_movimiento_susuario (
    usuario character varying(20) NOT NULL,
    fecha date DEFAULT now() NOT NULL,
    hora time without time zone DEFAULT now() NOT NULL,
    descripcion text NOT NULL,
    ip character varying(50)
);

ALTER TABLE ONLY tbl_ingreso_salida_sistema ALTER COLUMN id SET DEFAULT nextval('tbl_ingreso_salida_sistema_id_seq'::regclass);
ALTER TABLE ONLY tbl_cuenta_transaccion ADD CONSTRAINT tbl_cuenta_transaccion_pkey PRIMARY KEY (nombre_tabla, fecha, accion);
ALTER TABLE ONLY tbl_movimiento_susuario ADD CONSTRAINT tbl_movimiento_susuario_usuario_fkey FOREIGN KEY (usuario) REFERENCES schema_usuarios.tbl_usuarios(usuario) ON UPDATE CASCADE ON DELETE RESTRICT;
COMMENT ON COLUMN tbl_movimiento_susuario.usuario IS 'Nombre de Usuario que se navega por el Sistema.';
COMMENT ON COLUMN tbl_movimiento_susuario.fecha IS 'Fecha en la cual el usuario realiza la acción en el Sistema.';
COMMENT ON COLUMN tbl_movimiento_susuario.hora IS 'Hora en la cual el usuario realiza la acción en el Sistema.';
COMMENT ON COLUMN tbl_movimiento_susuario.descripcion IS 'Breve descripcion de la accion del usuario en el Sistema.';
COMMENT ON COLUMN tbl_movimiento_susuario.ip IS 'Direccion IP de donde el usuario se conecta al Sistema.'
