CREATE OR REPLACE FUNCTION "schema_laboratoriosemilla"."fn_consultar_destinos" (p_id_destino integer,p_destino varchar, p_ordenamiento varchar, p_numpagina integer, p_elementosporpagina integer, p_totalregistros integer, p_cursor_numregistros "pg_catalog"."refcursor", p_cursor_registros "pg_catalog"."refcursor") RETURNS SETOF "pg_catalog"."refcursor" AS
$body$
/*
eschema: schema_laboratoriosemilla
nombre: fn_consultar_destinos(integer,varchar,varchar,integer,integer,integer,refcursor,refcursor):varchar
autor: [autor]
fecha: 10/07/2014
organismo: Ministerio del Poder Popular de Petróleo y Minería
función: consulta destinos
*/
DECLARE
v_sqlid_destino varchar;
v_sqldestino varchar;
v_sqlordenamiento varchar;
v_sqlpaginacion varchar;
v_maxumpaginas float4;
v_sqlcondicion varchar;
v_execsql varchar;
v_execsqlcount varchar;
v_joins varchar;
BEGIN
v_sqlid_destino := '';
v_sqldestino := '';
v_sqlordenamiento := '';
v_sqlpaginacion := '';
v_maxumpaginas := 0;
v_sqlcondicion := '';
v_execsql := '';
v_execsqlcount := '';
v_joins := '';

IF (nullvalue(p_id_destino) != TRUE) THEN
	v_sqlid_destino := ' AND d.id_destino = ' || p_id_destino;
END IF;
IF (nullvalue(p_destino) != TRUE) THEN
	v_sqldestino := ' AND lower(d.destino) like ' || quote_literal('%' || lower(p_destino) || '%');
END IF;
IF (nullvalue(p_ordenamiento) != TRUE) THEN
   v_sqlordenamiento := ' ORDER BY ' || p_ordenamiento;
END IF;

v_joins := '';
v_sqlcondicion := v_joins || ' WHERE true ' || v_sqlid_destino || v_sqldestino;

IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
   v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((p_numpagina-1)*p_elementosporpagina);
END IF;

IF (p_totalregistros = 0) THEN
   v_execsqlcount := 'SELECT COUNT(*) FROM tbl_destinos d' || v_sqlcondicion;
   OPEN p_cursor_numregistros FOR EXECUTE v_execsqlcount;
   RETURN NEXT p_cursor_numregistros;
ELSE
    v_maxumpaginas := ceil(p_totalregistros/p_elementosporpagina);
    IF (v_maxumpaginas<p_numpagina) THEN
       IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
          v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((v_maxumpaginas)*p_elementosporpagina);
       END IF;
    END IF;
END IF;
   v_execsql := 'SELECT d.id_destino as id_destino,d.destino as destino FROM tbl_destinos d ' || v_sqlcondicion || v_sqlordenamiento || v_sqlpaginacion;
   --RAISE NOTICE '%', v_execsql;
   --BEGIN; SELECT * FROM fn_consultar_destinos (NULL,NULL,NULL,0,0,0,'cnr','cr'); FETCH ALL IN cr; END;
   OPEN p_cursor_registros FOR EXECUTE v_execsql;
   RETURN NEXT p_cursor_registros;
RETURN;
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

CREATE OR REPLACE FUNCTION "schema_laboratoriosemilla"."fn_consultar_personas" (p_id_persona integer,p_cedula_persona varchar,p_nombre_persona varchar,p_id_sexo integer,p_usuario varchar, p_ordenamiento varchar, p_numpagina integer, p_elementosporpagina integer, p_totalregistros integer, p_cursor_numregistros "pg_catalog"."refcursor", p_cursor_registros "pg_catalog"."refcursor") RETURNS SETOF "pg_catalog"."refcursor" AS
$body$
/*
eschema: schema_laboratoriosemilla
nombre: fn_consultar_personas(integer,varchar,varchar,integer,varchar,varchar,integer,integer,integer,refcursor,refcursor):varchar
autor: [autor]
fecha: 10/07/2014
organismo: Ministerio del Poder Popular de Petróleo y Minería
función: consulta personas
*/
DECLARE
v_sqlid_persona varchar;
v_sqlcedula_persona varchar;
v_sqlnombre_persona varchar;
v_sqlid_sexo varchar;
v_sqlusuario varchar;
v_sqlordenamiento varchar;
v_sqlpaginacion varchar;
v_maxumpaginas float4;
v_sqlcondicion varchar;
v_execsql varchar;
v_execsqlcount varchar;
v_joins varchar;
BEGIN
v_sqlid_persona := '';
v_sqlcedula_persona := '';
v_sqlnombre_persona := '';
v_sqlid_sexo := '';
v_sqlusuario := '';
v_sqlordenamiento := '';
v_sqlpaginacion := '';
v_maxumpaginas := 0;
v_sqlcondicion := '';
v_execsql := '';
v_execsqlcount := '';
v_joins := '';

IF (nullvalue(p_id_persona) != TRUE) THEN
	v_sqlid_persona := ' AND p.id_persona = ' || p_id_persona;
END IF;
IF (nullvalue(p_cedula_persona) != TRUE) THEN
	v_sqlcedula_persona := ' AND lower(p.cedula_persona) like ' || quote_literal('%' || lower(p_cedula_persona) || '%');
END IF;
IF (nullvalue(p_nombre_persona) != TRUE) THEN
	v_sqlnombre_persona := ' AND lower(p.nombre_persona) like ' || quote_literal('%' || lower(p_nombre_persona) || '%');
END IF;
IF (nullvalue(p_id_sexo) != TRUE) THEN
	v_sqlid_sexo := ' AND p.id_sexo = ' || p_id_sexo;
END IF;
IF (nullvalue(p_usuario) != TRUE) THEN
	v_sqlusuario := ' AND lower(p.usuario) like ' || quote_literal('%' || lower(p_usuario) || '%');
END IF;
IF (nullvalue(p_ordenamiento) != TRUE) THEN
   v_sqlordenamiento := ' ORDER BY ' || p_ordenamiento;
END IF;

v_joins := ' inner join tbl_sexos sex on sex.id_sexo = p.id_sexo inner join tbl_usuarios usu on usu.usuario = p.usuario';
v_sqlcondicion := v_joins || ' WHERE true ' || v_sqlid_persona || v_sqlcedula_persona || v_sqlnombre_persona || v_sqlid_sexo || v_sqlusuario;

IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
   v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((p_numpagina-1)*p_elementosporpagina);
END IF;

IF (p_totalregistros = 0) THEN
   v_execsqlcount := 'SELECT COUNT(*) FROM tbl_personas p' || v_sqlcondicion;
   OPEN p_cursor_numregistros FOR EXECUTE v_execsqlcount;
   RETURN NEXT p_cursor_numregistros;
ELSE
    v_maxumpaginas := ceil(p_totalregistros/p_elementosporpagina);
    IF (v_maxumpaginas<p_numpagina) THEN
       IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
          v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((v_maxumpaginas)*p_elementosporpagina);
       END IF;
    END IF;
END IF;
   v_execsql := 'SELECT p.id_persona as id_persona,p.cedula_persona as cedula_persona,p.nombre_persona as nombre_persona,p.id_sexo as id_sexo,p.usuario as usuario FROM tbl_personas p ' || v_sqlcondicion || v_sqlordenamiento || v_sqlpaginacion;
   --RAISE NOTICE '%', v_execsql;
   --BEGIN; SELECT * FROM fn_consultar_personas (NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'cnr','cr'); FETCH ALL IN cr; END;
   OPEN p_cursor_registros FOR EXECUTE v_execsql;
   RETURN NEXT p_cursor_registros;
RETURN;
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

CREATE OR REPLACE FUNCTION "schema_laboratoriosemilla"."fn_consultar_sexos" (p_id_sexo integer,p_sexo varchar, p_ordenamiento varchar, p_numpagina integer, p_elementosporpagina integer, p_totalregistros integer, p_cursor_numregistros "pg_catalog"."refcursor", p_cursor_registros "pg_catalog"."refcursor") RETURNS SETOF "pg_catalog"."refcursor" AS
$body$
/*
eschema: schema_laboratoriosemilla
nombre: fn_consultar_sexos(integer,varchar,varchar,integer,integer,integer,refcursor,refcursor):varchar
autor: [autor]
fecha: 10/07/2014
organismo: Ministerio del Poder Popular de Petróleo y Minería
función: consulta sexos
*/
DECLARE
v_sqlid_sexo varchar;
v_sqlsexo varchar;
v_sqlordenamiento varchar;
v_sqlpaginacion varchar;
v_maxumpaginas float4;
v_sqlcondicion varchar;
v_execsql varchar;
v_execsqlcount varchar;
v_joins varchar;
BEGIN
v_sqlid_sexo := '';
v_sqlsexo := '';
v_sqlordenamiento := '';
v_sqlpaginacion := '';
v_maxumpaginas := 0;
v_sqlcondicion := '';
v_execsql := '';
v_execsqlcount := '';
v_joins := '';

IF (nullvalue(p_id_sexo) != TRUE) THEN
	v_sqlid_sexo := ' AND s.id_sexo = ' || p_id_sexo;
END IF;
IF (nullvalue(p_sexo) != TRUE) THEN
	v_sqlsexo := ' AND lower(s.sexo) like ' || quote_literal('%' || lower(p_sexo) || '%');
END IF;
IF (nullvalue(p_ordenamiento) != TRUE) THEN
   v_sqlordenamiento := ' ORDER BY ' || p_ordenamiento;
END IF;

v_joins := '';
v_sqlcondicion := v_joins || ' WHERE true ' || v_sqlid_sexo || v_sqlsexo;

IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
   v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((p_numpagina-1)*p_elementosporpagina);
END IF;

IF (p_totalregistros = 0) THEN
   v_execsqlcount := 'SELECT COUNT(*) FROM tbl_sexos s' || v_sqlcondicion;
   OPEN p_cursor_numregistros FOR EXECUTE v_execsqlcount;
   RETURN NEXT p_cursor_numregistros;
ELSE
    v_maxumpaginas := ceil(p_totalregistros/p_elementosporpagina);
    IF (v_maxumpaginas<p_numpagina) THEN
       IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
          v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((v_maxumpaginas)*p_elementosporpagina);
       END IF;
    END IF;
END IF;
   v_execsql := 'SELECT s.id_sexo as id_sexo,s.sexo as sexo FROM tbl_sexos s ' || v_sqlcondicion || v_sqlordenamiento || v_sqlpaginacion;
   --RAISE NOTICE '%', v_execsql;
   --BEGIN; SELECT * FROM fn_consultar_sexos (NULL,NULL,NULL,0,0,0,'cnr','cr'); FETCH ALL IN cr; END;
   OPEN p_cursor_registros FOR EXECUTE v_execsql;
   RETURN NEXT p_cursor_registros;
RETURN;
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

CREATE OR REPLACE FUNCTION "schema_laboratoriosemilla"."fn_consultar_viajes" (p_id_viaje integer,p_fecha_viajedesde text,p_fecha_viajehasta text,p_id_persona integer,p_id_destino integer,p_usuario varchar, p_ordenamiento varchar, p_numpagina integer, p_elementosporpagina integer, p_totalregistros integer, p_cursor_numregistros "pg_catalog"."refcursor", p_cursor_registros "pg_catalog"."refcursor") RETURNS SETOF "pg_catalog"."refcursor" AS
$body$
/*
eschema: schema_laboratoriosemilla
nombre: fn_consultar_viajes(integer,text,text,integer,integer,varchar,varchar,integer,integer,integer,refcursor,refcursor):varchar
autor: [autor]
fecha: 10/07/2014
organismo: Ministerio del Poder Popular de Petróleo y Minería
función: consulta viajes
*/
DECLARE
v_sqlid_viaje varchar;
v_sqlfecha_viaje varchar;
v_sqlid_persona varchar;
v_sqlid_destino varchar;
v_sqlusuario varchar;
v_sqlordenamiento varchar;
v_sqlpaginacion varchar;
v_maxumpaginas float4;
v_sqlcondicion varchar;
v_execsql varchar;
v_execsqlcount varchar;
v_joins varchar;
BEGIN
v_sqlid_viaje := '';
v_sqlfecha_viaje := '';
v_sqlid_persona := '';
v_sqlid_destino := '';
v_sqlusuario := '';
v_sqlordenamiento := '';
v_sqlpaginacion := '';
v_maxumpaginas := 0;
v_sqlcondicion := '';
v_execsql := '';
v_execsqlcount := '';
v_joins := '';

IF (nullvalue(p_id_viaje) != TRUE) THEN
	v_sqlid_viaje := ' AND v.id_viaje = ' || p_id_viaje;
END IF;
IF (nullvalue(p_fecha_viajedesde) != TRUE) THEN
	IF (nullvalue(p_fecha_viajedesde) != TRUE) THEN
		v_sqlfecha_viaje := ' AND v.fecha_viaje BETWEEN ''' || to_date(p_fecha_viajedesde,'DD/MM/YYYY') || ''' AND ''' || to_date(p_fecha_viajehasta,'DD/MM/YYYY') || '''';
	ELSE
		v_sqlfecha_viaje := ' AND v.fecha_viaje <= ''' || to_date(p_fecha_viajedesde,'DD/MM/YYYY') || '''';
	END IF;
END IF;
IF (nullvalue(p_id_persona) != TRUE) THEN
	v_sqlid_persona := ' AND v.id_persona = ' || p_id_persona;
END IF;
IF (nullvalue(p_id_destino) != TRUE) THEN
	v_sqlid_destino := ' AND v.id_destino = ' || p_id_destino;
END IF;
IF (nullvalue(p_usuario) != TRUE) THEN
	v_sqlusuario := ' AND lower(v.usuario) like ' || quote_literal('%' || lower(p_usuario) || '%');
END IF;
IF (nullvalue(p_ordenamiento) != TRUE) THEN
   v_sqlordenamiento := ' ORDER BY ' || p_ordenamiento;
END IF;

v_joins := ' inner join tbl_personas per on per.id_persona = v.id_persona inner join tbl_destinos des on des.id_destino = v.id_destino inner join tbl_usuarios usu on usu.usuario = v.usuario';
v_sqlcondicion := v_joins || ' WHERE true ' || v_sqlid_viaje || v_sqlfecha_viaje || v_sqlid_persona || v_sqlid_destino || v_sqlusuario;

IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
   v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((p_numpagina-1)*p_elementosporpagina);
END IF;

IF (p_totalregistros = 0) THEN
   v_execsqlcount := 'SELECT COUNT(*) FROM tbl_viajes v' || v_sqlcondicion;
   OPEN p_cursor_numregistros FOR EXECUTE v_execsqlcount;
   RETURN NEXT p_cursor_numregistros;
ELSE
    v_maxumpaginas := ceil(p_totalregistros/p_elementosporpagina);
    IF (v_maxumpaginas<p_numpagina) THEN
       IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
          v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((v_maxumpaginas)*p_elementosporpagina);
       END IF;
    END IF;
END IF;
   v_execsql := 'SELECT v.id_viaje as id_viaje,to_char(v.fecha_viaje,''DD/MM/YYYY'') as fecha_viajemostrar,v.id_persona as id_persona,v.id_destino as id_destino,v.usuario as usuario FROM tbl_viajes v ' || v_sqlcondicion || v_sqlordenamiento || v_sqlpaginacion;
   --RAISE NOTICE '%', v_execsql;
   --BEGIN; SELECT * FROM fn_consultar_viajes (NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,'cnr','cr'); FETCH ALL IN cr; END;
   OPEN p_cursor_registros FOR EXECUTE v_execsql;
   RETURN NEXT p_cursor_registros;
RETURN;
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

