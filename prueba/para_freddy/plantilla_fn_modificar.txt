CREATE OR REPLACE FUNCTION "[nombre_del_esquema]"."fn_modificar_[nombre_fn]" ([parametrostiposdatos_entrada]) RETURNS varchar AS
$body$
/*
eschema: [nombre_del_esquema]
nombre: fn_modificar_[nombre_fn]([tipos_datos_entrada]):[tipo_dato_retorno]
autor: [autor]
fecha: [fecha_creacion]
organismo: [nombre_organismo]
función: modifica [nombre_fn] de acuerdo a su [campos_tabla]
*/
BEGIN
IF (EXISTS (SELECT 1 FROM [nombre_tabla] where [lista_comparaciones])) THEN
    RETURN 'Ya existe un [nombre_fn] con esas características';
ELSE
    BEGIN
    UPDATE [nombre_tabla]
    SET [set_elementos]
    WHERE [condicion_claveprimaria];
    EXCEPTION
    WHEN OTHERS THEN
            RETURN 'Ha ocurrido un error al ejecutar la instrucción';
    END;
    RETURN 'OK';
END IF;
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

