<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiniela_futbol";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipo_local = $_POST['equipo_local'];
    $equipo_visitante = $_POST['equipo_visitante'];
    $fecha = $_POST['fecha'];
    
    $sql = "INSERT INTO partidos (equipo_local, equipo_visitante, fecha) 
            VALUES ('$equipo_local', '$equipo_visitante', '$fecha')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo partido agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Partido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Agregar Nuevo Partido</h1>
    <form action="agregar_partido.php" method="POST">
        <label for="equipo_local">Equipo Local:</label>
        <input type="text" id="equipo_local" name="equipo_local" required>
        
        <label for="equipo_visitante">Equipo Visitante:</label>
        <input type="text" id="equipo_visitante" name="equipo_visitante" required>
        
        <label for="fecha">Fecha y Hora:</label>
        <input type="datetime-local" id="fecha" name="fecha" required>
        
        <button type="submit">Agregar Partido</button>
    </form>
</div>

</body>
</html>
