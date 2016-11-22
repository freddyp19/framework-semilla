<?php

function chmod_R($path, $filemode) {
    if (!is_dir($path))
       return chmod($path, $filemode);

    $dh = opendir($path);
    while ($file = readdir($dh)) {
        if($file != '.' && $file != '..') {
            $fullpath = $path.'/'.$file;
            if(!is_dir($fullpath)) {
              if (!chmod($fullpath, $filemode))
                    //echo $fullpath;
                    //return FALSE;
                    continue;
            } else {
              if (!chmod_R($fullpath, $filemode))
                    //return FALSE;
                    continue;
            }
        }
    }
 
    closedir($dh);
   
    if(chmod($path, $filemode))
      return TRUE;
    else
      return FALSE;
}

include("../inc/config.sistema.php");
chmod_R(RUTA_SISTEMA,0777);
?>
<script language="javascript">window.location="fin.php";</script>