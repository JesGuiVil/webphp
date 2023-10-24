<?php
$servidor="localhost";
$usuario="root";
$contraseña="";
$base_de_datos="baseprueba";


$conexion=new mysqli($servidor,$usuario,$contraseña,$base_de_datos);

if($conexion->connect_error){
    die("Error de conexión:".$conexion->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nombre=$_POST["nombre"];
    $email=$_POST["email"];
    $edad=$_POST["edad"];

    $consulta = "INSERT INTO usuarios (id, nombre, email, edad) VALUES (default,'$nombre','$email','$edad')";

    if ($conexion->query($consulta) === true) {
        echo "Registro insertado con éxito.";
       } else {
        echo "Error al insertar registro: " . $conexion->error;
       }  
}
$conexion->close();
?>
