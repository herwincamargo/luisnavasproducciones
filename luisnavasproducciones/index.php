<?php
include 'includes/header.php';
include 'includes/config.php';

// Obtener los últimos 3 eventos para el carrusel del hero
$stmt_hero = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC LIMIT 3");
$stmt_hero->execute();
$hero_eventos = $stmt_hero->fetchAll(PDO::FETCH_ASSOC);

// Obtener los últimos 6 eventos para el grid
$stmt_eventos_grid = $conn->prepare("SELECT * FROM eventos ORDER BY fecha DESC LIMIT 6");
$stmt_eventos_grid->execute();
$eventos_grid = $stmt_eventos_grid->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Hero Section - Dynamic Text Carousel -->
<section id="inicio" class="hero">
    <div class="container">
        <div class="hero-content-wrapper">
            <?php if (!empty($hero_eventos)): ?>
                <?php foreach($hero_eventos as $index => $evento): ?>
                    <div class="hero-text-slide text-center">
                        <h1 class="hero-title"><?php echo htmlspecialchars($evento['nombre']); ?></h1>
                        <p class="hero-subtitle"><?php echo substr(htmlspecialchars($evento['descripcion']), 0, 150); ?>...</p>
                        <div class="hero-event-meta">
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i>
                                <span><?php echo date('d M Y', strtotime($evento['fecha'])); ?></span>
                            </div>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo htmlspecialchars($evento['ciudad']); ?></span>
                            </div>
                        </div>
                        <a href="/evento/<?php echo htmlspecialchars($evento['slug']); ?>" class="btn btn-primary">Más información</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="hero-text-slide">
                    <h1 class="hero-title">Conciertos y Eventos Privados</h1>
                    <p class="hero-subtitle">Producción de eventos de primer nivel con logística integral, talento musical y suministro de licores para crear experiencias inolvidables.</p>
                    <a href="#eventos" class="btn btn-primary">Ver Próximos Eventos</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Eventos Section -->
<section id="eventos" class="section events-section">
    <div class="container">
        <h2 class="section-title">Próximos Eventos</h2>
        <div class="events-grid">
            <?php if (empty($eventos_grid)): ?>
                <p class="text-center">No hay eventos próximos en este momento. ¡Vuelve pronto!</p>
            <?php else: ?>
                <?php foreach($eventos_grid as $evento): ?>
                    <div class="event-card">
                        <a href="/evento/<?php echo htmlspecialchars($evento['slug']); ?>" class="event-image-link">
                            <img src="/assets/uploads/<?php echo htmlspecialchars($evento['imagen']); ?>" alt="<?php echo htmlspecialchars($evento['nombre']); ?>" loading="lazy">
                        </a>
                        <div class="event-info-container">
                            <h3><?php echo htmlspecialchars($evento['nombre']); ?></h3>
                            <div class="event-meta">
                                <div class="event-date">
                                    <i class="far fa-calendar-alt"></i>
                                    <span><?php echo date('d M Y', strtotime($evento['fecha'])); ?></span>
                                </div>
                                <div class="event-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo htmlspecialchars($evento['ciudad']); ?></span>
                                </div>
                            </div>
                            <p class="event-description"><?php echo substr(htmlspecialchars($evento['descripcion']), 0, 100); ?>...</p>
                            <div class="event-button-container">
                                <a href="/evento/<?php echo htmlspecialchars($evento['slug']); ?>" class="btn btn-primary">
                                    Más información
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center" style="margin-top: 40px;">
            <a href="/eventos.php" class="btn btn-primary">Ver Todos los Eventos</a>
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
            <div class="service-card glass-effect">
                <div class="service-content">
                    <i class="fas fa-chess-queen"></i>
                    <h3>Organización Integral</h3>
                    <p>Coordinamos cada aspecto de tu evento con precisión y atención al detalle.</p>
                </div>
                <div class="service-cta">
                    <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20quiero%20más%20información%20sobre%20Organización%20Integral" class="btn btn-primary" target="_blank">
                        Más información
                    </a>
                </div>
            </div>
            <div class="service-card glass-effect">
                <div class="service-content">
                    <i class="fas fa-truck-moving"></i>
                    <h3>Logística de Eventos</h3>
                    <p>Gestión completa de infraestructura y operación para eventos impecables.</p>
                </div>
                <div class="service-cta">
                    <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20quiero%20más%20información%20sobre%20Logística%20de%20Eventos" class="btn btn-primary" target="_blank">
                        Más información
                    </a>
                </div>
            </div>
            <div class="service-card glass-effect">
                <div class="service-content">
                    <i class="fas fa-music"></i>
                    <h3>Producción Musical</h3>
                    <p>Talentos musicales de alta calidad para crear la atmósfera perfecta.</p>
                </div>
                <div class="service-cta">
                    <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20quiero%20más%20información%20sobre%20Producción%20Musical" class="btn btn-primary" target="_blank">
                        Más información
                    </a>
                </div>
            </div>
            <div class="service-card glass-effect">
                <div class="service-content">
                    <i class="fas fa-wine-glass-alt"></i>
                    <h3>Abastecimiento Premium</h3>
                    <p>Selección exclusiva de licores y bebidas para tu evento.</p>
                </div>
                <div class="service-cta">
                    <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20quiero%20más%20información%20sobre%20Abastecimiento%20Premium" class="btn btn-primary" target="_blank">
                        Más información
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galería Section -->
<section id="galeria" class="section gallery-section">
    <div class="container">
        <h2 class="section-title">Galería de Eventos</h2>
        <div class="gallery-grid">
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 1" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 2" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 3" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 4" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 5" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 6" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 7" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="gallery-item glass-effect">
                <img src="https://images.unsplash.com/photo-1481886727447-8057b5571563?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Evento 8" loading="lazy">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Aliados Section -->
<section class="sponsors-section">
    <div class="container">
        <h3 class="section-title">Nuestros Aliados</h3>
        <div class="sponsors-grid">
            <div class="sponsor-item glass-effect">
                <img src="https://via.placeholder.com/150x80?text=Aliado+1" alt="Aliado 1" loading="lazy">
            </div>
            <div class="sponsor-item glass-effect">
                <img src="https://via.placeholder.com/150x80?text=Aliado+2" alt="Aliado 2" loading="lazy">
            </div>
            <div class="sponsor-item glass-effect">
                <img src="https://via.placeholder.com/150x80?text=Aliado+3" alt="Aliado 3" loading="lazy">
            </div>
            <div class="sponsor-item glass-effect">
                <img src="https://via.placeholder.com/150x80?text=Aliado+4" alt="Aliado 4" loading="lazy">
            </div>
            <div class="sponsor-item glass-effect">
                <img src="https://via.placeholder.com/150x80?text=Aliado+5" alt="Aliado 5" loading="lazy">
            </div>
            <div class="sponsor-item glass-effect">
                <img src="https://via.placeholder.com/150x80?text=Aliado+6" alt="Aliado 6" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section - Horizontal -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content-horizontal glass-effect">
            <div class="cta-text">
                <h2 class="cta-title">Organiza tu Concierto o Evento Privado con Nosotros</h2>
                <p class="cta-subtitle">Transformamos tus ideas en experiencias inolvidables con producción profesional y atención personalizada.</p>
            </div>
            <a href="https://wa.me/573015017283?text=Hola%20Luis%20Navas%20Producciones,%20quiero%20organizar%20un%20evento%20privado%20o%20concierto" class="btn btn-cta-white" target="_blank">
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
                <h3>Información de Contacto</h3>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                    <div>
                        <h4>Teléfono</h4>
                        <p>+57 301 5017283</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h4>Email</h4>
                        <p>info@luisnavasproducciones.com</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h4>Ubicación</h4>
                        <p>Barranquilla, Atlántico, Colombia</p>
                    </div>
                </div>
                <div class="social-links">
                    <a href="https://www.instagram.com/luisnavasb/" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <div class="contact-form">
                <form id="form-contacto" action="/enviar.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>
        </div>
        <div class="map-container glass-effect">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.982646603049!2d-74.8019959240336!3d10.96392588919067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef42d44a12d3f2d%3A0x5a00cac5a84f6343!2sBarranquilla%2C%20Atl%C3%A1ntico%2C%20Colombia!5e0!3m2!1sen!2sus!4v1690831834623!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
