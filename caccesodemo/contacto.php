<!DOCTYPE html>
<html lang="es">
	<head>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Control de Acceso</title>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="shortcut icon" href="images/favicon.ico"/>
		<link rel="stylesheet" href="css/estilos.css"/>
		<link rel="stylesheet" href="css/contacto.css"/>
	</head>
	<body>
		<header>
			
		</header>
		<div id="content">
            <header>
              <h2 class="page_title">Ingresar Empresa</h2>
            </header>
            <div class="content-inner">
              <div class="form-wrapper">
                <form action="php/send.php" method="post">
                  <div class="form-group">
                    <label class="sr-only">Nombre</label>
                    <input type="text" class="form-control" id="title" placeholder="Nombre" name="nombre">
                  </div>
                  <div class="form-group">
                    <label class="sr-only">E-mail</label>
                    <input type="text" class="form-control" id="title" placeholder="E-mail" name="nombre">
                  </div>
                  <div class="form-group">
                    <label class="sr-only">Mensaje</label>
                    <input type="text" class="form-control" id="title" placeholder="Mensaje" name="mensaje">
                  </div>

                  <div class="clearfix">
                    <button type="submit" class="btn btn-primary pull-right"> Enviar Mensaje</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
		<footer>

		</footer>
	</body>
</html>