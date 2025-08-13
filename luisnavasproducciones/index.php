<?php
include 'includes/header.php';
include 'includes/config.php';
?>

<!-- Hero Section -->
<section id="inicio" class="hero">
    <video autoplay muted loop playsinline class="hero-video" loading="lazy">
        <source src="https://assets.mixkit.co/videos/preview/mixkit-concert-crowd-dancing-in-darkness-3066-large.mp4" type="video/mp4">
    </video>
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Experiencias que trascienden</h1>
            <p class="hero-subtitle">Más de 10 años creando eventos memorables en Colombia con producción de primer nivel y atención personalizada.</p>
            <a href="#contacto" class="btn btn-primary">Contáctanos</a>
        </div>
    </div>
</section>

<!-- Nosotros Section -->
<section id="nosotros" class="section about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-image glass-effect">
                <img src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Equipo Luis Navas Producciones" loading="lazy">
            </div>
            <div class="about-text">
                <h2>Nuestra Historia</h2>
                <p>Con más de 10 años de experiencia, Luis Navas Producciones ha transformado ideas en eventos inolvidables en todo el Atlántico y Colombia. Desde nuestros inicios, nos hemos dedicado a brindar soluciones completas y personalizadas para cada cliente.</p>
                <p>Nuestro compromiso con la excelencia y la pasión por los detalles nos han convertido en un referente en la organización de eventos en el país, llevando cada producción más allá de las expectativas.</p>
                <a href="#contacto" class="btn btn-primary">Conoce más</a>
            </div>
        </div>
    </div>
</section>

<!-- Servicios Section -->
<section id="servicios" class="section services-section">
    <div class="container">
        <h2 class="section-title">Nuestros Servicios</h2>
        <div class="services-grid">
            <!-- Items de servicios -->
        </div>
    </div>
</section>

<!-- Eventos Section -->
<section id="eventos" class="section events-section">
    <div class="container">
        <h2 class="section-title">Próximos Eventos</h2>
        <div class="events-grid">
            <?php
            // Obtener los últimos 4 eventos para el grid
            $stmt = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC LIMIT 4");
            $stmt->execute();
            $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($eventos)) {
                echo "<p class='text-center'>No hay eventos próximos en este momento. ¡Vuelve pronto!</p>";
            } else {
                foreach($eventos as $evento) {
                    echo '
                    <div class="event-card">
                        <a href="/evento/'.htmlspecialchars($evento['slug']).'" class="event-image-link">
                            <img src="/assets/uploads/'.htmlspecialchars($evento['imagen']).'" alt="'.htmlspecialchars($evento['nombre']).'" loading="lazy">
                        </a>
                        <div class="event-info-container">
                            <h3>'.htmlspecialchars($evento['nombre']).'</h3>
                            <div class="event-meta">
                                <div class="event-date">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>'.date('d M Y', strtotime($evento['fecha'])).'</span>
                                </div>
                                <div class="event-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>'.htmlspecialchars($evento['ciudad']).'</span>
                                </div>
                            </div>
                            <p class="event-description">'.substr(htmlspecialchars($evento['descripcion']), 0, 100).'...</p>
                            <a href="/evento/'.htmlspecialchars($evento['slug']).'" class="btn-whatsapp">
                                Más información
                            </a>
                        </div>
                    </div>';
                }
            }
            ?>
        </div>
        <div class="text-center" style="margin-top: 40px;">
            <a href="/eventos.php" class="btn btn-primary">Ver Todos los Eventos</a>
        </div>
    </div>
</section>

<!-- Galería Section -->
<section id="galeria" class="section gallery-section">
    <div class="container">
        <h2 class="section-title">Galería de Eventos</h2>
        <div class="gallery-grid">
            <!-- Imágenes de la galería -->
        </div>
    </div>
</section>

<!-- Patrocinadores Section -->
<section class="sponsors-section">
    <div class="container">
        <h3 class="sponsors-title">Nuestros Aliados</h3>
        <div class="sponsors-grid">
            <!-- Logos de patrocinadores -->
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content glass-effect">
            <h2 class="cta-title">Organiza tu Concierto o Evento Privado con Nosotros</h2>
            <p class="cta-subtitle">Transformamos tus ideas en experiencias inolvidables con producción profesional y atención personalizada.</p>
            <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20quiero%20organizar%20un%20evento%20privado%20o%20concierto" class="btn btn-primary" target="_blank">
                Contáctanos ahora
            </a>
        </div>
    </div>
</section>

<!-- Contacto Section -->
<section id="contacto" class="section contact-section">
    <div class="container">
        <h2 class="section-title">Contáctanos</h2>
        <div class="contact-grid">
            <div class="contact-info">
                <!-- ... -->
            </div>
            <div class="contact-form">
                <form id="form-contacto">
                    <!-- ... -->
                </form>
            </div>
        </div>
        <div class="map-container glass-effect">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.982646603049!2d-74.8019959240336!3d10.96392588919067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef42d44a12d3f2d%3A0x5a00cac5a84f6343!2sBarranquilla%2C%20Atl%C3%A1ntico%2C%20Colombia!5e0!3m2!1sen!2sus!4v1690831834623!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
