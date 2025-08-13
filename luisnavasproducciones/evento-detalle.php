<?php
include 'includes/header.php';
include 'includes/config.php';

$event_slug = $_GET['slug'] ?? '';

if (empty($event_slug)) {
    die("Evento no especificado.");
}

$stmt = $conn->prepare("SELECT * FROM eventos WHERE slug = ?");
$stmt->execute([$event_slug]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    die("Evento no encontrado.");
}
?>

<div class="section">
    <div class="container">
        <!-- Usamos un hero simple para el título del evento -->
        <div class="hero text-center">
             <h1 class="hero-title"><?= htmlspecialchars($evento['nombre']) ?></h1>
             <p class="hero-subtitle">
                <i class="far fa-calendar-alt"></i> <?= date('d F, Y', strtotime($evento['fecha'])) ?>
                <span style="margin: 0 10px;">|</span>
                <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>, <?= htmlspecialchars($evento['ciudad']) ?>
             </p>
        </div>

        <div class="grid cols-2 mt-6" style="gap: 40px; align-items: flex-start;">
            <div>
                <img src="/assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>" style="border-radius: var(--r-lg); width: 100%;">
            </div>
            <div class="card">
                <h3>Descripción del Evento</h3>
                <p><?= nl2br(htmlspecialchars($evento['descripcion'])) ?></p>
                <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20estoy%20interesado%20en%20el%20evento%20<?= urlencode($evento['nombre']) ?>" class="btn btn-whatsapp block mt-5" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
