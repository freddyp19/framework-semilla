<?php include(RUTA_SISTEMA."/vista/menu/menu.php"); ?>

<div class="urbangreymenu" id="menu">
<?php foreach($menu as $modulo => $submenus) { ?>
<h3 class="headerbar"><a href="#"><?php echo $modulo; ?></a></h3>
<ul class="submenu">
        <?php foreach($submenus as $texto => $link) { ?>
        <li><a href="<?php echo $link; ?>"><?php echo $texto; ?></a></li>
        <?php } ?>
</ul>
<?php } ?>

<!--<a class="menuitem" href="../../documentacion/MANUAL_DE_USUARIO.pdf" target="_blank">Manual de Usuario</a> -->
<h3 class="headerbar"><a href="<?php echo "/".$sistema ."/" ?>">Salir del Sistema</h3>

</div> <!-- fin de "urbangreymenu" -->