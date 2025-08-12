<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include '../includes/config.php';
include '../includes/functions.php';

// Procesar formulario
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y subir imagen
    $targetDir = "../assets/uploads/";
    $fileName = basename($_FILES["imagen"]["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verificar si es imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Subir archivo
    if ($uploadOk && move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
        $slug = slugify($_POST['nombre']);

        $stmt = $conn->prepare("INSERT INTO eventos (nombre, slug, imagen, fecha, lugar, ciudad, pais, descripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nombre'],
            $slug,
            $fileName,
            $_POST['fecha'],
            $_POST['lugar'],
            $_POST['ciudad'],
            $_POST['pais'],
            $_POST['descripcion']
        ]);
    }
}

// Obtener eventos
$stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrar Eventos</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-container">
        <h1>Administrar Eventos</h1>

        <form method="post" enctype="multipart/form-data" class="event-form">
            <h2>Agregar Nuevo Evento</h2>
            <input type="text" name="nombre" placeholder="Nombre del evento" required>
            <input type="file" name="imagen" accept="image/*" required>
            <input type="date" name="fecha" required>
            <input type="text" name="lugar" placeholder="Lugar (ej: Estadio)" required>
            <input type="text" name="ciudad" placeholder="Ciudad" required>
            <input type="text" name="pais" placeholder="País" required>
            <textarea name="descripcion" placeholder="Descripción"></textarea>
            <button type="submit">Guardar Evento</button>
        </form>

        <div class="events-list">
            <h2>Eventos Existentes</h2>
            <?php foreach($eventos as $evento): ?>
            <div class="admin-event-card">
                <img src="../assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" width="100">
                <div>
                    <h3><?= htmlspecialchars($evento['nombre']) ?></h3>
                    <p><?= date('d/m/Y', strtotime($evento['fecha'])) ?> - <?= htmlspecialchars($evento['lugar']) ?></p>
                </div>
                <a href="delete_event.php?id=<?= $evento['id'] ?>" class="delete-btn">Eliminar</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
