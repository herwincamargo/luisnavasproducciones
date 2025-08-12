<?php
include 'includes/header.php';
include 'includes/config.php';

$event_slug = $_GET['slug'] ?? '';

if (empty($event_slug)) {
    //
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
        <div class="hero gradient-border">
            <h1 class="title"><?= htmlspecialchars($evento['nombre']) ?></h1>
            <div class="card-meta">
                <span class="badge primary"><i class="fas fa-calendar"></i> <?= date('d M Y', strtotime($evento['fecha'])) ?></span>
                <span class="badge"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>, <?= htmlspecialchars($evento['ciudad']) ?></span>
            </div>
        </div>

        <div class="grid cols-2 mt-6">
            <div>
                <img src="assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>" style="border-radius: var(--r-lg);">
            </div>
            <div class="card">
                <h3>Detalles del Evento</h3>
                <p><?= nl2br(htmlspecialchars($evento['descripcion'])) ?></p>
                <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20estoy%20interesado%20en%20el%20evento%20<?= urlencode($evento['nombre']) ?>" class="btn block mt-5" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
