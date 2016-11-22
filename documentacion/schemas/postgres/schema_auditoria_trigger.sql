SET statement_timeout = 0; /*#FIN#*/
SET client_encoding = 'UTF8'; /*#FIN#*/
SET check_function_bodies = false; /*#FIN#*/
SET client_min_messages = warning; /*#FIN#*/
SET escape_string_warning = off; /*#FIN#*/

SET search_path = schema_auditoria, pg_catalog; /*#FIN#*/

SET default_with_oids = false; /*#FIN#*/



CREATE FUNCTION fn_cuentatransaccion() RETURNS trigger
    LANGUAGE plpgsql
    AS $$ 
/*
eschema: schema_auditoria
nombre: fn_cuentatransaccion():trigger
autor: Carlos Caro
fecha: 09/03/2006
organismo: Ministerio de Energía y Petróleo - MENPET
función: registra la cantidad de tipo de transacción efectuada sobre una tabla
*/
DECLARE
numRegistros integer;
BEGIN
    SELECT COUNT(*) INTO numRegistros FROM schema_auditoria.tbl_cuenta_transaccion WHERE nombre_tabla = TG_RELNAME AND fecha = CURRENT_DATE AND accion = TG_OP;
    IF (numRegistros > 0) THEN
        UPDATE schema_auditoria.tbl_cuenta_transaccion SET cantidad = cantidad + 1 WHERE nombre_tabla = TG_RELNAME AND fecha = CURRENT_DATE AND accion = TG_OP;
    ELSE
        INSERT INTO schema_auditoria.tbl_cuenta_transaccion (cantidad,nombre_tabla,accion,fecha) VALUES (1,TG_RELNAME,TG_OP,CURRENT_DATE);
    END IF;
    RETURN NULL;
END;
$$;

/*#FIN#*/

CREATE FUNCTION fn_eliminacion_tabla() RETURNS trigger
    LANGUAGE plpgsql
    AS $$ 
/*
eschema: schema_auditoria
nombre: fn_eliminacion_tabla():trigger
autor: Rafael Gonzalez
fecha: 14/04/2013
organismo: Ministerio de Energía y Petróleo - MENPET
función: registra la eliminacion efectuada sobre una tabla
*/
DECLARE
numRegistros integer;
BEGIN
    INSERT INTO schema_auditoria.tbl_cambios_tablas (usuario,fecha,hora,nombre_esquema,nombre_tabla,accion,dato_anterior,dato_nuevo) VALUES (OLD.usuario,CURRENT_DATE,CURRENT_TIME,TG_TABLE_SCHEMA,TG_TABLE_NAME,TG_OP,OLD,null);
    RETURN NULL;
END;
$$;

/*#FIN#*/

CREATE FUNCTION fn_insercion_tabla() RETURNS trigger
    LANGUAGE plpgsql
    AS $$ 
/*
eschema: schema_auditoria
nombre: fn_insercion_tabla():trigger
autor: Rafael Gonzalez
fecha: 14/04/2013
organismo: Ministerio de Energía y Petróleo - MENPET
función: registra la insercion efectuada sobre una tabla
*/
DECLARE
numRegistros integer;
BEGIN
    INSERT INTO schema_auditoria.tbl_cambios_tablas (usuario,fecha,hora,nombre_esquema,nombre_tabla,accion,dato_anterior,dato_nuevo) VALUES (NEW.usuario,CURRENT_DATE,CURRENT_TIME,TG_TABLE_SCHEMA,TG_TABLE_NAME,TG_OP,null,NEW);
    RETURN NULL;
END;
$$;

/*#FIN#*/

CREATE FUNCTION fn_modificacion_tabla() RETURNS trigger
    LANGUAGE plpgsql
    AS $$ 
/*
eschema: schema_auditoria
nombre: fn_modificacion_tabla():trigger
autor: Rafael Gonzalez
fecha: 14/04/2013
organismo: Ministerio de Energía y Petróleo - MENPET
función: registra la actualizacion efectuada sobre una tabla
*/
DECLARE
numRegistros integer;
BEGIN
    INSERT INTO schema_auditoria.tbl_cambios_tablas (usuario,fecha,hora,nombre_esquema,nombre_tabla,accion,dato_anterior,dato_nuevo) VALUES (NEW.usuario,CURRENT_DATE,CURRENT_TIME,TG_TABLE_SCHEMA,TG_TABLE_NAME,TG_OP,OLD,NEW);
    RETURN NULL;
END;
$$;
