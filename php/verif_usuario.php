<?php

session_start();

// Verificamos si se enviaron el correo electrónico y la contraseña
if(isset($_POST['correo']) && isset($_POST['contraseña'])) {
    // Es la conexión a la base de datos
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "Proyecto_Final"; 

    // se hace la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificamos la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recuperamos el correo electrónico y contraseña de la pagina de inicio
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL para verificar si existe el usuario
    $sql = "SELECT id_usuario FROM Usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // El usuario está registrado y todo es válido
        $row = $resultado->fetch_assoc();
        // Guarda el ID del usuario en la sesión
        $_SESSION['id_usuario'] = $row['id_usuario'];
        
        // Verificamos si el correo del usuario es admin@correo.com
        if ($correo == 'admin@gmail.com') {
            // De ser asi se redirecciona al usuario a la página de administrador
            header("Location: ../Admin/index_admin.php");
            exit();
        } else {
            // Redireccionamos al usuario a la página de inicio
            header("Location: ../html/inicio.html");
            exit();
        }
    } else {
        // Si el usuario no está registrado o las credenciales son incorrectas
        echo "Correo electrónico o contraseña incorrectos";
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se enviaron el correo electrónico y la contraseña
    echo "Por favor, ingresa correo electrónico y contraseña.";
}
?>

