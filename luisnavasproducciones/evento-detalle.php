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

<div class="section" style="background: var(--black);">
    <div class="container text-center">
        <!-- Título de página simple con fondo oscuro -->
        <div class="page-title" style="padding: 60px 0;">
             <h1 class="hero-title"><?= htmlspecialchars($evento['nombre']) ?></h1>
             <p class="hero-subtitle">
                <i class="far fa-calendar-alt"></i> <?= format_date_spanish($evento['fecha']) ?>
                <span style="margin: 0 10px;">|</span>
                <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>, <?= htmlspecialchars($evento['ciudad']) ?>
             </p>
        </div>

        <div class="grid cols-2 mt-6" style="gap: 40px; align-items: flex-start; text-align: left;">
            <div>
                <img src="/assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>" style="border-radius: 12px; width: 100%;">
            </div>
            <div class="card glass-effect">
                <h3>Descripción del Evento</h3>
                <p style="white-space: pre-wrap;"><?= htmlspecialchars($evento['descripcion']) ?></p>
                <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20estoy%20interesado%20en%20el%20evento%20<?= urlencode($evento['nombre']) ?>" class="btn btn-primary block mt-5" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
