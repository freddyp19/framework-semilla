<?php

/*
La decisión de implementar la un archivo fuera de la estructura lógica de la programación fue:
Por los diferentes manejadores de bases de datos que existen en los actuales momentos y por una sugerencia de http://www.lacorona.com.mx/fortiz/adodb/tips_portable_sql-es.htm en donde habla de hacer “SQL” portables.

Sito:

En general para proporcionar una portabilidad real, tienes que tratar el código SQL como un ejercicio de tropicalizacion. En PHP, se ha hecho común definir archivos de lenguaje diferente para: Ingles, Ruso, Coreano, etc. Similarmente, Yo te sugiero que tengas archivos separados para Sybase, Intebase, MySQL, etc., e incluir condicionalmente el SQL según la base de datos. Por ejemplo, cada enunciado SQL de MySQL se almacenaría en una variable separada, en un archivo llamado 'mysql-lang.inc.php', [para PostgreSQL se almacenaría en una variable separada, en un archivo llamado 'postgresql-lang.inc.php'.]

*/
class sql_sql {



public $where = " where %s ";

public $limit = " limit %s,%s";

public $select = " select %s from %s";

public $delete = " delete from %s";



#*CODIGO*#

}
?>