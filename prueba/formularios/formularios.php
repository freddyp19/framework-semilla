<html lang="en">
	<head>
    <meta charset="utf-8">
    <title>Prueba Formulario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 
    <link href="bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="custom.css" rel="stylesheet" type="text/css"/>

    
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
<body>
    <div class="container">
      <div class="row clearfix">
	          <!-- Components -->
        <div class="col-md-6">
          <h2>Componentes</h2>
          <hr>
          <div class="tabbable">
            <ul class="nav nav-tabs" id="formtabs">
              <!-- Tab nav -->
            </ul>
            <form class="form-horizontal" id="components" role="form">
              <fieldset>
                <div class="tab-content">
                  <!-- Tabs of snippets go here -->
                </div>
              </fieldset>
            </form>
          </div>
        </div>
        <!-- / Components -->
        <!-- Building Form. -->
        <div class="col-md-6">
          <div class="clearfix">
            <h2>Formulario</h2>
            <hr>
            <div id="build">
              <form id="target" class="form-horizontal">
              </form>
            </div>
          </div>
        </div>
        <!-- / Building Form. -->
      </div>
    </div> <!-- /container -->

    <!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton">Procesar</label>
  <div class="col-md-4">
      <button id="procesar" name="procesar"  onclick="extra()" class="btn btn-primary">Procesar</button>
  </div>
</div>
    
    
    <script data-main="main-built.js" src="requiere.js" ></script>
    <script src="extra.js" type="text/javascript"></script>
  </body>
</html>
