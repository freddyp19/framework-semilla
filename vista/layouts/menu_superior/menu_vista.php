 <?php
include(RUTA_SISTEMA."/vista/menu/menu.php");
?>

<div class="clearFix" style="padding:0;background:#FFFFFF;border:1px solid;border-color:#55A1FF;" id="menu">
<ul id="Menu1" class="MM">
<?php foreach($menu as $modulo => $submenus) { ?>
	<li><a href="#"><?php echo $modulo; ?></a>
		<ul>
			<?php foreach($submenus as $texto => $link) { ?>
			<li><a href="<?php echo $link; ?>"><?php echo $texto; ?></a></li>
			<?php } ?>
		</ul>
	</li>

<?php } ?>

<!--<a class="menuitem" href="../../documentacion/MANUAL_DE_USUARIO.pdf" target="_blank">Manual de Usuario</a> -->
<li>
<a class="menuitem" href="<?php echo "/".$sistema ."/" ?>">Salir del Sistema</a>
</li>
</ul>
</div> <!-- fin de "glossymenu" -->