<?php
include 'includes/header.php';
include 'includes/config.php';
include 'includes/functions.php';

// Obtener los últimos 3 eventos
$stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC LIMIT 3");
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <!-- Hero Section -->
    <section id="inicio" class="hero">
        <div class="hero-content">
            <h1>Transformamos ideas en eventos inolvidables</h1>
            <p>10 años de experiencia en producción de conciertos y eventos corporativos</p>
            <a href="#eventos" class="btn">Ver Próximos Eventos</a>
        </div>
    </section>

    <!-- Últimos Eventos -->
    <section id="eventos" class="events container">
        <h2>Últimos Eventos</h2>
        <div class="events-grid">
            <?php if (empty($eventos)): ?>
                <p>No hay eventos próximos en este momento. ¡Vuelve pronto!</p>
            <?php else: ?>
                <?php foreach($eventos as $evento): ?>
                <div class="event-card">
                    <img src="assets/uploads/<?= htmlspecialchars($evento['imagen']) ?>" alt="<?= htmlspecialchars($evento['nombre']) ?>">
                    <div class="event-info">
                        <h3><?= htmlspecialchars($evento['nombre']) ?></h3>
                        <p><i class="fas fa-calendar"></i> <?= date('d M Y', strtotime($evento['fecha'])) ?></p>
                        <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($evento['lugar']) ?>, <?= htmlspecialchars($evento['ciudad']) ?></p>
                        <a href="evento/<?= htmlspecialchars($evento['slug']) ?>" class="btn">Más detalles</a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- Sobre Nosotros -->
    <section id="nosotros" class="about container">
        <h2>Nuestra Historia</h2>
        <p>Con más de 10 años de experiencia, Luis Navas Producciones ha transformado ideas en eventos inolvidables en todo el Atlántico y Colombia. Desde nuestros inicios, nos hemos dedicado a brindar soluciones completas y personalizadas para cada cliente.</p>
        <h3>Misión</h3>
        <p>Nuestra misión es crear experiencias únicas y memorables a través de la organización de eventos de alta calidad, adaptados a las necesidades y sueños de cada cliente.</p>
        <h3>Visión</h3>
        <p>Nuestra visión es consolidarnos como la empresa líder en organización de eventos en Colombia, reconocida por nuestra creatividad y profesionalismo.</p>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="container">
        <div class="contact-form">
            <h2>Contacto</h2>
            <p>Ponte en contacto con nosotros.</p>

            <div class="contact-info">
                <p><i class="fas fa-phone"></i> +57 301 5017283</p>
                <p><i class="fas fa-envelope"></i> info@luisnavasproducciones.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Barranquilla, Atlántico, Colombia</p>
            </div>

            <form action="enviar.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" required></textarea>
                </div>
                <button type="submit" class="btn">Enviar Mensaje</button>
            </form>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
