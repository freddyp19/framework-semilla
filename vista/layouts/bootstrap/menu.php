<!-- Inicio Menu de Navegacion -->
	<div class="navbar-header">
		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
		 <span class="sr-only">Toggle navigation</span>
		 <span class="icon-bar"></span>
		 <span class="icon-bar"></span>
		 <span class="icon-bar"></span>
		 </button>
		 <!-- 
		 <a class="navbar-brand" href="#"></a>
		 -->
	</div>
	
	<div id="menu" class="collapse navbar-collapse">

		<ul class="nav navbar-nav">
		
<?php include(RUTA_SISTEMA."/vista/menu/menu.php"); ?>		
		
<?php foreach($menu as $modulo => $submenus) { ?>
<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		 	<?php echo $modulo; ?>
	 	<strong class="caret"></strong>
		</a>
		
	<ul class="dropdown-menu">
        <?php foreach($submenus as $texto => $link) { ?>
        <li><a href="<?php echo $link; ?>"><?php echo $texto; ?></a></li>
        <?php } ?>
	</ul>
</li>

<?php } ?>			
<li class="dropdown">
<a href="<?php echo "/".$sistema ."/" ?>">Salir del Sistema</a>
</li>			
		</ul>
	</div>
	
<!-- Fin Menu de Navegacion -->