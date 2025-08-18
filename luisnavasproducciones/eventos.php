<?php
include 'includes/header.php';
include 'includes/config.php';

// Obtener todos los eventos
$stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="section events-page-section" style="background: var(--black);">
    <div class="container text-center">
        <div class="page-title" style="padding: 60px 0;">
            <h1 class="hero-title">Todos Nuestros Eventos</h1>
            <p class="hero-subtitle">Explora nuestro archivo completo de eventos pasados y futuros.</p>
        </div>

        <div class="events-grid mt-6">
            <?php if (empty($eventos)): ?>
                <p>No hay eventos para mostrar.</p>
            <?php else: ?>
                <?php foreach($eventos as $evento): ?>
                <div class="event-card">
                    <a href="/evento/<?= htmlspecialchars($evento['slug']) ?>" class="event-image-link">
                        <img src="/assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>" loading="lazy">
                    </a>
                    <div class="event-info-container">
                        <h3><?= htmlspecialchars($evento['nombre']) ?></h3>
                        <div class="event-meta">
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i>
                                <span><?= format_date_spanish($evento['fecha']) ?></span>
                            </div>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?= htmlspecialchars($evento['ciudad']) ?></span>
                            </div>
                        </div>
                        <p class="event-description"><?= substr(htmlspecialchars($evento['descripcion']), 0, 100) ?>...</p>
                        <a href="/evento/<?= htmlspecialchars($evento['slug']) ?>" class="btn btn-primary">
                            Más información
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
