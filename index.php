<?php 
session_start();
session_unset();
session_destroy();
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Importaciones</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
	<div class="container">
	<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12" ><img src="images/ImportacionesCyberlux.png" width="100%"/></div>
  </div>
		<div class="row">
                    <br><br><br><br><br>
                </div>
                    <div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12">
			<div class="row">
            			<div class="col-md-4"></div>
            			<div class="col-md-4"><form role="form" action="login.php" method="POST">
					<ul>
						<li>
							<div class="form-group">
								<label for="txtUsuario">Usuario</label>
								<input type="usuario" class="form-control" id="txtUsuario" name="usuario" placeholder="Su Usuario" >
							</div>
						</li>
						<li>
							<div class="form-group">
								<label for="txtPassword">Clave</label>
								<input type="password" class="form-control" id="txtPassword" name="pass" placeholder="password" size="30">
							</div>
						</li>
						<li>
							<button type="submit" class="btn btn-success">Ingresar</button>
						</li>
					</ul>	
				</form></div>
            			<div class="col-md-4"></div>
          		</div>
                      </div>
                    </div>
                  </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    		<script src="js/bootstrap.min.js"></script>
    		

</body>
</html>