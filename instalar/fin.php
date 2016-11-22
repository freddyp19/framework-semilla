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
					<div class="button1-left">
					<div class="next">
					<a href="#" rel="next" title="Siguiente">Fin</a>
					</div>
					</div>
			</div>
			<h2>Fin</h2>
		</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_siguiente").click(function(){
			//$("#adminForm").submit();
			window.close();
		});
		
	});
</script>
<form action="index.php" method="post" id="adminForm" class="form-validate">
	<div id="installer">
		<div class="m">
			<h3>Fin</h3>
			<div class="install-text">
			Tomate un tiempo y lee gracias	
			</div>
			<div class="install-body">
				<div class="m">
					<fieldset>
						Simplemente Gracias opor ser parte de esto
					</fieldset>
				</div>
				<div class="clr"></div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
</form>
<?php include("pie.php"); ?>