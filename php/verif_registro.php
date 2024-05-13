<?php
// Verificamos si se enviaron todos los campos necesarios
if(isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contraseña']) && isset($_POST['fecha_nacimiento']) && isset($_POST['num_tarjeta']) && isset($_POST['direccion'])) {
    // Recupera los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $num_tarjeta = $_POST['num_tarjeta'];
    $direccion = $_POST['direccion'];

    // Es la conexión a la base de datos
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "Proyecto_Final"; 

    // Creamos la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificamos la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta de SQL para verificar si el usuario ya existe
    $sql_verificar = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado_verificar = $conn->query($sql_verificar);

    if ($resultado_verificar->num_rows > 0) {
        // Si el usuario ya está registrado
        // Redireccionamos al usuario de vuelta a la página de registro con el mensaje de error
        header("Location: registro.php?error=Este+correo+electrónico+ya+está+registrado.");
        exit(); 
    } else {
        // Si el usuario no está registrado, procedemos con el insert
        // Consulta SQL para insertar un nuevo usuario
        $sql_insertar = "INSERT INTO Usuarios (id_usuario,nombre_usuario, correo, contraseña, fecha_nacimiento, numero_tarjeta, direccion) VALUES (NULL,'$nombre', '$correo', '$contraseña', '$fecha_nacimiento', '$num_tarjeta', '$direccion')";
        
        if ($conn->query($sql_insertar) === TRUE) {
            echo "Registro exitoso";
            // Redirigimos a inicion de sesion
            header("Location:../html/sesion_inicio.html");

        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "Ese correo ya esta registrado.";
}
?>