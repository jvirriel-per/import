<?php

require_once('funciones.php');
conectar('10.10.3.164', 'root', 'localhost', 'importaciones');

$usuario=strip_tags($_REQUEST['usuario']);
$pass=md5($_POST['pass']);

$sQuery=@mysql_query("SELECT * FROM authuser WHERE uname='$usuario' AND passwd='$pass' AND status=1");

                if($sQuery==true){
       $row2= mysql_fetch_row($sQuery);
    }
  if($usuario==true && $pass==true && $usuario==$row2[1] &&  $pass==$row2[2]){
  $tipo_ingreso= $row2[3];
  if($tipo_ingreso=='Administrador'){
                    session_start();
                    $_SESSION['autentica'] = "SIP";
                    $_SESSION["nombre"] = $row2[5];
                    $_SESSION["team"] = $row2[3];
                    $_SESSION["user"] = $row2[1];
                    ?>
                    <script language="javascript" type="text/javascript">window.location="reporte_pd.php";</script>
                        <?php
                        
                }else{

?>
  <script type="text/javascript">
                alert("Usuario No esta Asignado al Sistema Importaciones");
                window.location="index.php"
                </script>
  
 <?php
                        } 
 }else{

?>
  <script type="text/javascript">
                alert("Usuario o Clave Incorrecta");
                window.location="index.php"
                </script>
  
 <?php
 
 }
?>