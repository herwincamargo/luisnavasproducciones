<?php
include 'includes/header.php';
include 'includes/config.php';

// Obtener todos los eventos
$stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="section">
    <div class="container">
        <h1 class="text-center">Todos los Eventos</h1>
        <p class="text-center muted mb-6">Explora nuestro archivo completo de eventos pasados y futuros.</p>

        <div class="grid auto">
            <?php if (empty($eventos)): ?>
                <p class="text-center">No hay eventos para mostrar.</p>
            <?php else: ?>
                <?php foreach($eventos as $evento): ?>
                <a href="evento/<?= htmlspecialchars($evento['slug']) ?>" class="card hoverable">
                    <img src="assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>">
                    <div class="card-title mt-4"><?= htmlspecialchars($evento['nombre']) ?></div>
                    <div class="card-meta">
                        <span class="badge primary"><i class="fas fa-calendar"></i> <?= date('d M Y', strtotime($evento['fecha'])) ?></span>
                        <span class="badge"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($evento['ciudad']) ?></span>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
