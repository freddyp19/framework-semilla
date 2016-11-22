<?php include("header.php");?>
<div id="system-message-container"> </div>

		<div id="content-box">
			<div id="content-pad">
				<div id="stepbar">
					<?php include("menu.php");?>
				</div>
				
<div id="right">
	<div id="rightpad">
		<div id="step">
			<div class="far-right">
				<div class="button1-right">
				<div class="prev">
					<a href="menu_tablas.php" rel="prev" title="Previo">Previo</a></div>
				</div>
				<div class="button1-left">
				<div class="next">
					<a href="fin.html" rel="next" title="Siguiente" id="btn_siguiente">Siguiente</a></div>
				</div>
			</div>
			<h2>Bienvenida</h2>
		</div>

<form action="cambio_permisos.php" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Bienvenida</h3>
			<div class="install-text">
			Tomate un tiempo y lee gracias	
			</div>
			<div class="install-body">
				<div class="m">
					<fieldset>
						
<?php
if ((strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')) {
    echo 'Este un servidor usando Windows!';
} else {
    echo '<h1> Probablemente tendras que correr los cambios de permisos en Linux </h1>';
?>
<br />
<button id="btn_cambios_permisos">Ejecutar Cambios de Permisos 0777</button>
<?php
}
?>

					</fieldset>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</form>
<?php include("pie.php"); ?>
