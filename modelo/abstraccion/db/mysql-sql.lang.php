<?php

/*
La decisi�n de implementar la un archivo fuera de la estructura l�gica de la programaci�n fue:
Por los diferentes manejadores de bases de datos que existen en los actuales momentos y por una sugerencia de http://www.lacorona.com.mx/fortiz/adodb/tips_portable_sql-es.htm en donde habla de hacer �SQL� portables.

Sito:

En general para proporcionar una portabilidad real, tienes que tratar el c�digo SQL como un ejercicio de tropicalizacion. En PHP, se ha hecho com�n definir archivos de lenguaje diferente para: Ingles, Ruso, Coreano, etc. Similarmente, Yo te sugiero que tengas archivos separados para Sybase, Intebase, MySQL, etc., e incluir condicionalmente el SQL seg�n la base de datos. Por ejemplo, cada enunciado SQL de MySQL se almacenar�a en una variable separada, en un archivo llamado 'mysql-lang.inc.php', [para PostgreSQL se almacenar�a en una variable separada, en un archivo llamado 'postgresql-lang.inc.php'.]

*/
class mysql_sql {

public $select = " select %s from %s";

public $update = " update %s set %s ";

public $delete = " delete from %s";

public $where = " where %s ";

public $limit = " limit %s,%s";



#*CODIGO*#


}
?>
