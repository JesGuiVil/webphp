<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar Usuario</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "baseprueba";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$id_usuario = null;  // Inicializa la variable $id_usuario

if (isset($_GET["id"])) { 
    $id_usuario = $_GET["id"];  // Asigna el valor de "id" de la URL a $id_usuario
    $consulta = "SELECT * FROM usuarios WHERE id = $id_usuario";
    $result = $conexion->query($consulta);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre = $row["nombre"];
        $email = $row["email"];
        $edad = $row["edad"];
    } else {
        echo "No se encontró el usuario con ID proporcionado.";
    }
} else {
    echo "ID de usuario no proporcionada";
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $edad = $_POST["edad"];
    
    // Consulta SQL para actualizar el usuario
    $actualizar = "UPDATE usuarios SET nombre = '$nombre', email = '$email', edad = $edad WHERE id = $id_usuario";
    
    if ($conexion->query($actualizar) === TRUE) {
        echo "Usuario actualizado correctamente"; 
        header("Location: tabla.php");
        exit;
    } else {
        echo "Error al actualizar el usuario: " . $conexion->error;
    }
}
$conexion->close();
?>
<h2>Editar usuario</h2>
<form action="editar_usuario.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id_usuario; ?>">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
    <label for="edad">Edad</label>
    <input type="text" id="edad" name="edad" value="<?php echo $edad; ?>"><br>
    <input type="submit" value="Actualizar">
</form>
</body>
</html>
