<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 40px;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
        }
        
        .form-label {
            margin-top: 10px;
        }
        
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
        }
        
        .text-center {
            text-align: center;
        }
    </style>
</head>
    
<body>
    <h1>Registro de usuario</h1>
    
    <!-- Mouestra el mensaje de error si ya existe el usuario-->
    <?php
    if(isset($_GET['error'])) {
        $error_message = $_GET['error'];
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

<form action="verif_registro.php" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required><br>

    <label for="correo">Correo electrónico:</label><br>
    <input type="email" id="correo" name="correo" required><br>

    <label for="contraseña">Contraseña:</label><br>
    <input type="password" id="contraseña" name="contraseña" required><br>

    <label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br>

    <label for="num_tarjeta">Número de Tarjeta:</label><br>
    <input type="text" id="num_tarjeta" name="num_tarjeta" required><br>

    <label for="direccion">Dirección:</label><br>
    <input type="text" id="direccion" name="direccion" required><br>

    <input type="submit" value="Registrate">
</form>

</body>
</html>
