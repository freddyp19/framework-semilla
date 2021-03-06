CREATE OR REPLACE FUNCTION "[nombre_del_esquema]"."fn_consultar_[nombre_fn]" ([parametrostiposdatos_entrada], p_ordenamiento varchar, p_numpagina integer, p_elementosporpagina integer, p_totalregistros integer, p_cursor_numregistros "pg_catalog"."refcursor", p_cursor_registros "pg_catalog"."refcursor") RETURNS SETOF "pg_catalog"."refcursor" AS
$body$
/*
eschema: [nombre_del_esquema]
nombre: fn_consultar_[nombre_fn]([tipos_datos_entrada],varchar,integer,integer,integer,refcursor,refcursor):[tipo_dato_retorno]
autor: [autor]
fecha: [fecha_creacion]
organismo: [nombre_organismo]
funcion: consulta [nombre_fn]
*/
DECLARE
[declaracion_variables]
v_sqlordenamiento varchar;
v_sqlpaginacion varchar;
v_maxumpaginas float4;
v_sqlcondicion varchar;
v_execsql varchar;
v_execsqlcount varchar;
v_joins varchar;
BEGIN
[inicializacion_variables]
v_sqlordenamiento := '';
v_sqlpaginacion := '';
v_maxumpaginas := 0;
v_sqlcondicion := '';
v_execsql := '';
v_execsqlcount := '';
v_joins := '';
[lista_condiciones_sql]
IF (nullvalue(p_ordenamiento) != TRUE) THEN
   v_sqlordenamiento := ' ORDER BY ' || p_ordenamiento;
END IF;

v_joins := '[lista_joins_sql]';
v_sqlcondicion := v_joins || ' WHERE true '[lista_variables_sql];

IF ((p_numpagina != 0) AND (p_elementosporpagina != 0)) THEN
   v_sqlpaginacion := ' LIMIT ' || p_elementosporpagina || ' OFFSET ' || ((p_numpagina-1)*p_elementosporpagina);
END IF;

IF (p_totalregistros = 0) THEN
   v_execsqlcount := 'SELECT COUNT(*) FROM [nombre_tabla] [alias_tabla]' || v_sqlcondicion;
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
   v_execsql := 'SELECT [campos_consulta] FROM [nombre_tabla] [alias_tabla] ' || v_sqlcondicion || v_sqlordenamiento || v_sqlpaginacion;
   --RAISE NOTICE '%', v_execsql;
   --BEGIN; SELECT * FROM fn_consultar_[nombre_fn] ([nulls]NULL,0,0,0,'cnr','cr'); FETCH ALL IN cr; END;
   OPEN p_cursor_registros FOR EXECUTE v_execsql;
   RETURN NEXT p_cursor_registros;
RETURN;
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

