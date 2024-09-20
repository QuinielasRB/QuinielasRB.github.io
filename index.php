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
$sql = "SELECT * FROM partidos WHERE estado = 'disponible'";
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
    <title>Panel de Usuario - Quiniela de Fútbol</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
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
        input, select, button {
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
        .match {
            margin-bottom: 20px;
            width: 100%;
        }
        .match label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .match select {
            width: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Selecciona los Resultados de los Partidos</h1>
    <form id="quinielaForm">
        <label for="nombre">Tu Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <?php if (count($partidos) > 0): ?>
            <?php foreach ($partidos as $partido): ?>
                <div class="match">
                    <label for="partido_<?php echo $partido['id']; ?>">
                        <?php echo $partido['equipo_local']; ?> vs <?php echo $partido['equipo_visitante']; ?>
                    </label>
                    <select id="partido_<?php echo $partido['id']; ?>" name="partido_<?php echo $partido['id']; ?>">
                        <option value="local">Victoria Local</option>
                        <option value="empate">Empate</option>
                        <option value="visitante">Victoria Visitante</option>
                    </select>
                </div>
            <?php endforeach; ?>
            <button type="button" onclick="enviarWhatsApp()">Enviar Selecciones a WhatsApp</button>
            <button type="button" onclick="resetearSelecciones()">Resetear Selecciones</button>
        <?php else: ?>
            <p>No hay partidos disponibles.</p>
        <?php endif; ?>
    </form>
</div>

<script>
    function enviarWhatsApp() {
        var form = document.getElementById('quinielaForm');
        var formData = new FormData(form);
        var url = 'https://api.whatsapp.com/send?phone=8994344588'; // Reemplaza con el número del administrador
        
        var nombre = formData.get('nombre');
        var mensaje = 'Nombre: ' + nombre + '\nSelecciones de los partidos:\n';
        formData.forEach(function(value, key) {
            if (key !== 'nombre') {
                var partidoID = key.split('_')[1];
                mensaje += 'Partido ID ' + partidoID + ': ' + (value === 'local' ? 'Victoria Local' : value === 'empate' ? 'Empate' : 'Victoria Visitante') + '\n';
            }
        });

        url += '&text=' + encodeURIComponent(mensaje);

        window.open(url, '_blank');
    }

    function resetearSelecciones() {
        var form = document.getElementById('quinielaForm');
        form.reset();
    }
</script>

</body>
</html>
