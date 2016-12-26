<?
     /* A continuación, realizamos la conexión con nuestra base de datos en MySQL */
	 
 	$link = mysql_connect("localhost","chilecop","cHilecop2016");
	mysql_select_db("chilecop_cademo",$link);


     /* El query valida si el usuario ingresado existe en la base de datos. Se utiliza la función 
     htmlentities para evitar inyecciones SQL. */
     mysql_set_charset("utf8",$link);
     $myusuario = mysql_query("select id_user from usuarios 
                                 where nombre =  '".htmlentities($_POST["user"])."'",$link);
     $nmyusuario = mysql_num_rows($myusuario);

     //Si existe el usuario, validamos también la contraseña ingresada y el estado del usuario...
     if($nmyusuario != 0){
          $sql = "SELECT * FROM usuarios WHERE nombre='". $_POST['user'] ."' AND pass='" . $_POST['password'] . "'";
          $resultado = mysql_query($sql,$link);
          

          //Si el usuario y clave ingresado son correctos (y el usuario está activo en la BD), creamos la sesión del mismo.
          if($fila = mysql_fetch_array($resultado)){
               session_start();
               //Guardamos dos variables de sesión que nos auxiliará para saber si se está o no "logueado" un usuario
               $_SESSION["autentica"] = "SIP";
               $_SESSION["nombreUsuario"] = $fila['nombrePersona']; //nombre del usuario logueado.
               //Direccionamos a nuestra página principal del sistema.
               header ("Location: ../escritorio.php");
          }
          else{
               echo"<script>alert('La contrase\u00f1a del usuario no es correcta.');
               window.location.href=\"index.html\"</script>"; 
          }
     }else{
          echo"<script>alert('El usuario no existe.');window.location.href=\"index.html\"</script>";
     }
     mysql_close($link);
?>
