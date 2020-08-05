<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Plantilla</title>

    <?php

      function ejecutar($usu,$pass){
        $db_host="localhost";
        $db_nombre="pruebas";
        $db_usuario="root";
        $db_contra="";

        $conexion=mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);

        if (mysqli_connect_errno()) {
          echo "Falló la conexión: <br>", mysqli_connect_error();
          exit();
        }
      
        mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la BBDD");
        mysqli_set_charset($conexion, "utf8");


        $consulta="SELECT * FROM DATOS WHERE USER='$usu'";
        $resultados=mysqli_query($conexion, $consulta);

        while($fila=mysqli_fetch_array($resultados, MYSQLI_ASSOC)){  
          $usuario_bd=$fila['USER'];
          $contraseña_bd= $fila['PASSWORD'];  
        }

        $consulta="SELECT * FROM DATOS WHERE USER='$pass'";
        $resultados=mysqli_query($conexion, $consulta);

        while($fila=mysqli_fetch_array($resultados, MYSQLI_ASSOC)){  
          $contraseña_bd= $fila['PASSWORD'];  
        }

        if($usu === $usuario_bd && $pass === $contraseña_bd){
          echo "<br>BIENVENIDO A TU WEB";
        }else{
          header("Location: index.php");
        }

        mysqli_close($conexion);
      }

    ?>
  </head>
  <body>
    <?php
      error_reporting(E_ERROR); /* Argumentar si se sube a produccion*/
      $usu = $_GET['usu'];
      $pass = $_GET['password'];

      $mipag=$_SERVER["PHP_SELF"];

      if ($usu !=NULL && $pass !=NULL) { 
        ejecutar($usu,$pass);
      }else{ 
        echo "<div class='wrapper fadeInDown'>
                <div id='formContent'>
                  <div class='fadeIn first'>
                    <img src='img/usuario.png' id='icon' alt='User Icon' />
                  </div>
      
                  <form method='get' action='" . $mipag ."'>
                    <input name='usu' type='text' id='login' class='fadeIn second'  placeholder='login'>
                    <input name='password' type='text' id='password' class='fadeIn third'  placeholder='password'>
                    <input  type='submit' class='fadeIn fourth' value='Log In'>
                  </form>
          
                  <div id='formFooter'>
                    <a class='underlineHover' href='#'>Forgot Password?</a>
                  </div>
                </div>
              </div>

            <script src='js/jquery-3.4.1.min.js'></script>
            <script src='js/bootstrap.min.js'></script>";  
      }
    ?>
  </body>
</html>







