<?php
include 'includes/header.php';
include 'includes/config.php';

$event_slug = '';
if (isset($_GET['slug'])) {
    $event_slug = $_GET['slug'];
}

if (empty($event_slug)) {
    echo "<p>Evento no encontrado.</p>";
    include 'includes/footer.php';
    exit;
}


$stmt = $conn->prepare("SELECT * FROM eventos WHERE slug = ?");
$stmt->execute([$event_slug]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    echo "<p>Evento no encontrado.</p>";
    include 'includes/footer.php';
    exit;
}
?>

<main class="container event-detail">
    <h1><?= htmlspecialchars($evento['nombre']) ?></h1>
    <div class="event-detail-layout">
        <div class="event-detail-img">
            <img src="assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>">
        </div>
        <div class="event-detail-info">
            <p><strong>Fecha:</strong> <?= date('d M Y', strtotime($evento['fecha'])) ?></p>
            <p><strong>Lugar:</strong> <?= htmlspecialchars($evento['lugar']) ?>, <?= htmlspecialchars($evento['ciudad']) ?></p>
            <p><strong>País:</strong> <?= htmlspecialchars($evento['pais']) ?></p>
            <hr>
            <h3>Descripción del Evento</h3>
            <p><?= nl2br(htmlspecialchars($evento['descripcion'])) ?></p>
            <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20estoy%20interesado%20en%20el%20evento%20<?= urlencode($evento['nombre']) ?>" class="btn" target="_blank">
                <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
            </a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
