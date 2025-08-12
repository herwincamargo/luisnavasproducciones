<?php
include 'includes/header.php';
include 'includes/config.php';

// Obtener los últimos 4 eventos para el grid
$stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC LIMIT 4");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Hero Section -->
<section class="hero text-center">
    <h1 class="title">Transformamos Ideas en Eventos Inolvidables</h1>
    <p class="subtitle max-600">Con más de 10 años de experiencia, creamos momentos memorables a través de la música y producción de primer nivel en toda Colombia.</p>
    <div class="actions">
        <a href="#eventos" class="btn">Próximos Eventos</a>
        <a href="#contacto" class="btn ghost">Contáctanos</a>
    </div>
</section>

<!-- Eventos Section -->
<section id="eventos" class="section">
    <div class="container">
        <h2 class="text-center">Próximos Eventos</h2>
        <div class="grid auto">
            <?php if (empty($eventos)): ?>
                <p class="text-center">No hay eventos próximos en este momento. ¡Vuelve pronto!</p>
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
        <div class="text-center mt-5">
            <a href="eventos.php" class="btn secondary">Ver todos los eventos</a>
        </div>
    </div>
</section>

<!-- Sobre Nosotros (Nosotros) Section -->
<section id="nosotros" class="section">
    <div class="container text-center max-600">
        <h2>Nuestra Historia</h2>
        <p>En Luis Navas Producciones, cada proyecto cuenta una historia y refleja nuestra pasión por crear experiencias memorables. Con una misión clara, una visión ambiciosa y valores sólidos, hemos construido una trayectoria que nos inspira a superar expectativas en cada evento.</p>
    </div>
</section>

<!-- Contacto Section -->
<section id="contacto" class="section">
    <div class="container max-600">
        <div class="card">
            <h2 class="text-center">Contáctanos</h2>
            <p class="text-center muted mb-5">¿Listo para empezar tu próximo evento? Envíanos un mensaje.</p>
            <form action="enviar.php" method="post">
                <div class="form-row">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="input" required>
                </div>
                <div class="form-row mt-4">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="input" required>
                </div>
                <div class="form-row mt-4">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" class="input" required></textarea>
                </div>
                <button type="submit" class="btn block mt-5">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
