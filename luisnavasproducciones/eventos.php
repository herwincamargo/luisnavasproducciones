<?php
include 'includes/header.php';
include 'includes/config.php';

$stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="events-container">
    <h1>Próximos Eventos</h1>

    <div class="events-grid">
        <?php foreach($eventos as $evento): ?>
        <div class="event-card glass-effect">
            <img src="assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>">
            <div class="event-info">
                <h3><?= htmlspecialchars($evento['nombre']) ?></h3>
                <p><i class="fas fa-calendar"></i> <?= date('d M Y', strtotime($evento['fecha'])) ?></p>
                <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>, <?= htmlspecialchars($evento['ciudad']) ?></p>
                <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20estoy%20interesado%20en%20el%20evento%20<?= urlencode($evento['nombre']) ?>"
                   class="btn-whatsapp"
                   data-tooltip="Hola, ¿cómo podemos ayudarte?">
                    Más información
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
