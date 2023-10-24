<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <title>Ver Tabla</title>
</head>
<body>
    <h2>Tabla de Usuarios</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Edad</th>
        </tr>
        <?php
        $servidor = "localhost";
        $usuario = "root";
        $contraseña = "";
        $base_de_datos = "baseprueba";

        $conexion = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $consulta = "SELECT * FROM usuarios";
        $result = $conexion->query($consulta);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["edad"] . "</td>";
                echo "<td><a href='editar_usuario.php?id=" . $row['id'] . "'>Editar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No se encontraron registros.</td></tr>";
        }
        $conexion->close();
        ?>
    </table>
</body>
</html>
