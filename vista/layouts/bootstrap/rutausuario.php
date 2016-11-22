<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="50%" height="20" class="bleach5">
									<div class="style7">
										Bienvenido(a) 
										
<!--							
<script type="text/javascript" src="../../../js/ajax/ajax-dynamic-content.js"></script>
<script type="text/javascript" src="../../../js/ajax/ajax.js"></script>
<script type="text/javascript" src="../../../js/ajax/ajax-tooltip.js">
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, June 2006
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/	
</script>
<link rel="stylesheet" href="../../../css/ajax-tooltip.css" media="screen" type="text/css">
-->
<?php if (isset($_SESSION["session_usuario"])){ ?>
  <span class="usuario">
  [ <?php echo $_SESSION["session_usuario"]["usuario"];?> ] 
  </span>
<?php } else { ?>
  <span class="usuario">Usted no se ha autenticado. 
  [ <a href="/<?php echo $sistema; ?>" class="ruta">Entrar</a> ]
  </span>
<?php } ?>
										
										
										
										
									</div>
								</td>
								<td width="50%" align="right" height="20" class="bleach6">
									<div class="style6">
										<?php #$fecha = time();  echo FechaFormateada($fecha); ?>
									</div>
									<div align="right">
										<b><a href="<?php echo $servidor."/".$sistema ?>" class="nombresistema">Cerrar Sesi&oacute;n</a></b>
									</div>
								</td>
<!--								

								<td bgcolor="#CC0000" height="20">
									
								</td> -->
							</tr>
						</table>