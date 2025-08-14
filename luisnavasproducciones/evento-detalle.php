<?php
include 'includes/header.php';
include 'includes/config.php';

$event_slug = $_GET['slug'] ?? '';

if (empty($event_slug)) {
    header("Location: /index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM eventos WHERE slug = ?");
$stmt->execute([$event_slug]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    header("Location: /404.php"); // O a una página de "no encontrado"
    exit;
}
?>

<div class="section">
    <div class="container">
        <div class="page-title text-center">
             <h1 class="hero-title"><?= htmlspecialchars($evento['nombre']) ?></h1>
             <p class="hero-subtitle">
                <i class="far fa-calendar-alt"></i> <?= date('d F, Y', strtotime($evento['fecha'])) ?>
                <span style="margin: 0 10px;">|</span>
                <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>, <?= htmlspecialchars($evento['ciudad']) ?>
             </p>
        </div>

        <div class="event-detail-grid mt-6">
            <div class="event-detail-image">
                <img src="/assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>">
            </div>
            <div class="event-detail-info card glass-effect">
                <h3>Descripción del Evento</h3>
                <p class="event-full-description"><?= nl2br(htmlspecialchars($evento['descripcion'])) ?></p>
                <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20estoy%20interesado%20en%20el%20evento%20<?= urlencode($evento['nombre']) ?>" class="btn-whatsapp-contact" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
