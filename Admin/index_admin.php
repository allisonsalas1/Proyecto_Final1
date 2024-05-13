<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
    <title>Pagina del Administrador</title>
    <a href="../html/sesion_inicio.html" class="btn btn-outline-dark">Cerrar sesion</a>
    <link href="../Productos/css/styles.css" rel="stylesheet"/>

    <style>

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #333;
    text-align: center;
}

form {
    margin-bottom: 20px;
    text-align: center;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="text"],
input[type="number"],
select {
    width: 70%; 
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"],
.btn-secondary {
    width: 50%; 
    padding: 8px; 
    background-color: #ff5555; 
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover,
.btn-secondary:hover {
    background-color: #ff3333; 
}


    </style>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == '1') {
    
    }
    ?>
    <h1>Pagina del Administrador</h1>
    
    <?php if(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] == '1'): ?>
        <div>
            <h2>Checar historial de compras del usuario</h2>
            <form action="checar.php" method="POST">
                <label for="id_usuario">Usuario:</label>
                <input type="number" id="id_usuario" name="id_usuario">
                <button type="submit">Consultar</button>
            </form>
        </div>

        <div>
            <h2>Alta o Baja de Producto</h2>
            <form action="alt_ba_producto.php" method="POST">
                <button type="submit">Ingresar</button>
            </form>
        </div>

        <div>
            <h2>Cambiar Producto</h2>
            <form action="cambiar_producto.php" method="POST">
                <label for="id_producto">ID del Producto:</label>
                <input type="text" id="id_producto" name="id_producto">
                <button type="submit">Cambiar</button>
            </form>
        </div>
    <?php else: ?>
    <?php endif; ?>
</body>
</html>