<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Agrega tu contraseña si tienes una
$dbname = "olimpicos_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pais = $_POST['pais'];
    $oro = intval($_POST['oro']);
    $plata = intval($_POST['plata']);
    $bronce = intval($_POST['bronce']);
    
    $sql = "INSERT INTO medallas (pais, oro, plata, bronce) VALUES ('$pais', $oro, $plata, $bronce)";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Registro agregado correctamente</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Obtener los datos de la tabla
$sql = "SELECT * FROM medallas ORDER BY total DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Medallas - Juegos Olímpicos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Registro de Medallas - Juegos Olímpicos</h1>

    <form method="POST" action="index.php" class="mt-4">
        <div class="form-group">
            <label for="pais">País:</label>
            <input type="text" class="form-control" id="pais" name="pais" placeholder="Ingrese el país" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="oro">Medallas de Oro:</label>
                <input type="number" class="form-control" id="oro" name="oro" min="0" value="0" required>
            </div>
            <div class="form-group col-md-4">
                <label for="plata">Medallas de Plata:</label>
                <input type="number" class="form-control" id="plata" name="plata" min="0" value="0" required>
            </div>
            <div class="form-group col-md-4">
                <label for="bronce">Medallas de Bronce:</label>
                <input type="number" class="form-control" id="bronce" name="bronce" min="0" value="0" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block">Agregar Medallas</button>
    </form>

    <table class="table table-striped mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">País</th>
                <th scope="col">Oro</th>
                <th scope="col">Plata</th>
                <th scope="col">Bronce</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Mostrar los datos
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["pais"] . "</td>";
                    echo "<td>" . $row["oro"] . "</td>";
                    echo "<td>" . $row["plata"] . "</td>";
                    echo "<td>" . $row["bronce"] . "</td>";
                    echo "<td>" . $row["total"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay registros</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
