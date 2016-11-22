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
		<div class="prev"><a href="instalar.php" rel="prev" title="Previo">Previo</a></div>
		</div>
		<div class="button1-left"><div class="next"><a href="config_sist.php" rel="next" title="Siguiente">Siguiente</a></div></div>
	</div>
	<h2>Licencia</h2>
</div>
<form action="index.php" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Licencia Pública General GNU</h3>
			<iframe src="gpl.php" class="license" marginwidth="25" scrolling="auto"></iframe>
		</div>
	</div>

</form>
<?php include("pie.php"); ?>