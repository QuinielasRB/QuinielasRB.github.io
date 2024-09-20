<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
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
        h1 {
            color: #007bff;
        }
        a {
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }
        a:hover {
            text-decoration: underline;
        }
        .nav {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Panel de Administrador</h1>
    <div class="nav">
        <a href="agregar_partido.php">Agregar Nuevo Partido</a> |
        <a href="actualizar_partido.php">Actualizar Estado del Partido</a> |
        <a href="mostrar_partidos.php">Mostrar Partidos</a>
    </div>
</div>

</body>
</html>
