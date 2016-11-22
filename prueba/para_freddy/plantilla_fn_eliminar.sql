CREATE OR REPLACE FUNCTION "[nombre_del_esquema]"."fn_eliminar_[nombre_fn]" ([parametrostiposdatos_entrada]) RETURNS varchar AS
$body$
/*
eschema: [nombre_del_esquema]
nombre: fn_eliminar_[nombre_fn]([tipos_datos_entrada]):[tipo_dato_retorno]
autor: [autor]
fecha: [fecha_creacion]
organismo: [nombre_organismo]
función: elimina [nombre_fn]
*/
DECLARE
v_flagintegridad boolean;
BEGIN
v_flagintegridad := false;

--IF (EXISTS (SELECT 1 FROM <nombretablaforanea> where <id1> = <id2>...)) THEN
--	v_flagintegridad := true;
--END IF;

IF (v_flagintegridad = true) THEN
   RETURN 'No se puede eliminar el [nombre_fn] porque tiene elementos asociados';
ELSE
    BEGIN
    DELETE FROM [nombre_tabla] WHERE [condicion_claveprimaria];
    EXCEPTION
    WHEN OTHERS THEN
            RETURN 'Ha ocurrido un error al ejecutar la instrucción';
    END;
    RETURN 'OK';
END IF;
END;
$body$
LANGUAGE 'plpgsql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

