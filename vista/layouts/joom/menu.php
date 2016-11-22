<?php include(RUTA_SISTEMA."/vista/menu/menu.php"); ?>
<div class="arrowlistmenu" id="menu">

<?php foreach($menu as $modulo => $submenus) { ?>
<h3 class="expandable"><a href="#"><?php echo $modulo; ?></a></h3>
<ul class="categoryitems">
        <?php foreach($submenus as $texto => $link) { ?>
        <li><a href="<?php echo $link; ?>"><?php echo $texto; ?></a></li>
        <?php } ?>
</ul>
<?php } ?>

<h3 class="headerbar expandable"><a href="<?php echo "/".$sistema ."/" ?>">Salir del Sistema</a></h3>

<!--
<h3 class="menuheader expandable">CSS Library</h3>
<ul class="categoryitems">
<li><a href="http://www.dynamicdrive.com/style/csslibrary/category/C1/">Horizontal CSS Menus</a></li>
<li><a href="http://www.dynamicdrive.com/style/csslibrary/category/C2/">Vertical CSS Menus</a></li>
<li><a href="http://www.dynamicdrive.com/style/csslibrary/category/C4/">Image CSS</a></li>
<li><a href="http://www.dynamicdrive.com/style/csslibrary/category/C6/">Form CSS</a></li>
<li><a href="http://www.dynamicdrive.com/style/csslibrary/category/C5/">DIVs and containers</a></li>
<li><a href="http://www.dynamicdrive.com/style/csslibrary/category/C7/">Links & Buttons</a></li>
<li><a href="http://www.dynamicdrive.com/style/csslibrary/category/C8/">Other</a></li>
<li><a href="http://www.dynamicdrive.com/style/csslibrary/all/">Browse All</a></li>
</ul>


<h3 class="menuheader expandable">CSS Drive</h3>
<ul class="categoryitems">
<li><a href="http://www.cssdrive.com">CSS Gallery</a></li>
<li><a href="http://www.cssdrive.com/index.php/menudesigns/" class="subexpandable">Menu Gallery</a>
	<ul class="subcategoryitems" style="margin-left: 15px">
	<li><a href="http://www.cssdrive.com/index.php/main/category/C34/">Blue Color</a></li>
	<li><a href="http://www.cssdrive.com/index.php/main/category/C36/">Green Color</a></li>
	<li><a href="http://www.cssdrive.com/index.php/main/category/C37/">Orange Color</a></li>
	<li><a href="http://www.cssdrive.com/index.php/main/category/C33/">Red Color</a></li>
	<li><a href="http://www.cssdrive.com/index.php/main/category/C38/">Brown Color</a></li>
	</ul>
</li>
<li><a href="http://www.cssdrive.com/index.php/news/">Web Design News</a></li>
<li><a href="http://www.cssdrive.com/index.php/examples/">CSS Examples</a></li>
<li><a href="http://www.cssdrive.com/index.php/main/csscompressor/">CSS Compressor</a></li>
<li><a href="http://www.dynamicdrive.com/forums/forumdisplay.php?f=6">CSS Forums</a></li>
</ul>

<h3 class="menuheader expandable">JavaScript Kit</h3>
<ul class="categoryitems">
<li><a href="http://www.javascriptkit.com/cutpastejava.shtml" >Free JavaScripts</a></li>
<li><a href="http://www.javascriptkit.com/javatutors/">JavaScript tutorials</a></li>
<li><a href="http://www.javascriptkit.com/jsref/">JavaScript Reference</a></li>
<li><a href="http://www.javascriptkit.com/domref/">DOM Reference</a></li>
<li><a href="http://www.javascriptkit.com/dhtmltutors/">DHTML & CSS</a></li>
</ul>

<h3 class="menuheader" style="cursor: default">FeedBack</h3>
<div>
Regular contents here. Header does not expand or contact.
</div>
-->
</div>
