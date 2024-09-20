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

// Consulta para obtener los partidos
$sql = "SELECT * FROM partidos";
$result = $conn->query($sql);

$partidos = [];

if ($result->num_rows > 0) {
    // Almacena los datos en un array
    while($row = $result->fetch_assoc()) {
        $partidos[] = $row;
    }
} else {
    $partidos = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Partidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Partidos de Fútbol Disponibles</h1>
    
    <?php if (count($partidos) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Equipo Local</th>
                    <th>Equipo Visitante</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partidos as $partido): ?>
                    <tr>
                        <td><?php echo $partido['id']; ?></td>
                        <td><?php echo $partido['equipo_local']; ?></td>
                        <td><?php echo $partido['equipo_visitante']; ?></td>
                        <td><?php echo $partido['fecha']; ?></td>
                        <td><?php echo $partido['estado']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay partidos disponibles.</p>
    <?php endif; ?>
</div>

</body>
</html>
