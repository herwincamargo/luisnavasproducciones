<?php
session_start();
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include dirname(__DIR__) . '/includes/config.php';

$error_message = '';
$success_message = '';

// Procesar formulario
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadOk = 1;
    $error_message = '';

    // --- Validación de la Imagen ---
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $targetDir = dirname(__DIR__) . "/assets/uploads/";
        $fileName = basename($_FILES["imagen"]["name"]);
        $targetFile = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Verificar si es una imagen real
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check === false) {
            $error_message = "El archivo no es una imagen.";
            $uploadOk = 0;
        }

        // Permitir ciertos formatos de archivo
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $error_message = "Lo sentimos, solo se permiten archivos JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
    } else {
        $error_message = "No se ha subido ninguna imagen o ha ocurrido un error en la subida.";
        $uploadOk = 0;
    }

    // --- Intentar Subir Archivo y Guardar en BD ---
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            try {
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
                $success_message = "¡El evento '".htmlspecialchars($_POST['nombre'])."' ha sido creado con éxito!";

            } catch (PDOException $e) {
                // Capturar error de la base de datos (ej. slug duplicado)
                if ($e->errorInfo[1] == 1062) { // 1062 es el código de error para entrada duplicada
                    $error_message = "Error: Ya existe un evento con un nombre similar. Por favor, elige un nombre único.";
                } else {
                    $error_message = "Error de la base de datos: " . $e->getMessage();
                }
                // Si la BD falla, eliminar el archivo que ya se subió
                unlink($targetFile);
            }
        } else {
            $error_message = "Lo sentimos, hubo un error al subir tu archivo. Verifica los permisos de la carpeta 'assets/uploads/'.";
        }
    }
}

// Obtener eventos para mostrar en la lista
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
        <a href="index.php">Volver al Panel</a>
        <hr>

        <?php if ($error_message): ?>
            <p class="error"><?= $error_message ?></p>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <p class="success"><?= $success_message ?></p>
        <?php endif; ?>

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
                <a href="delete_event.php?id=<?= $evento['id'] ?>" class="delete-btn" onclick="return confirm('¿Estás seguro de que quieres eliminar este evento?');">Eliminar</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
