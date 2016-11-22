<?php include(RUTA_SISTEMA."/vista/menu/menu.php"); ?>

<div class="glossymenu" id="menu">
<?php foreach($menu as $modulo => $submenus) { ?>
<a class="menuitem submenuheader" href="#"><?php echo $modulo; ?></a>
<div class="submenu">
	<ul>
        <?php foreach($submenus as $texto => $link) { ?>
        <li><a href="<?php echo $link; ?>"><?php echo $texto; ?></a></li>
        <?php } ?>
    </ul>
</div>
<?php } ?>

<!--<a class="menuitem" href="../../documentacion/MANUAL_DE_USUARIO.pdf" target="_blank">Manual de Usuario</a> -->
<a class="menuitem" href="<?php echo "/".$sistema ."/" ?>">Salir del Sistema</a>
</div> <!-- fin de "glossymenu" -->