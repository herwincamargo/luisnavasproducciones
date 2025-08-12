<?php
include 'includes/header.php';
include 'includes/config.php';
?>

<!-- Hero Section -->
<section id="inicio" class="hero">
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
                <img src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Equipo Luis Navas Producciones">
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
                <i class="fas fa-chess-queen"></i>
                <h3>Organización Integral</h3>
                <p>Coordinamos cada aspecto de tu evento con precisión y atención al detalle.</p>
            </div>

            <div class="service-card glass-effect">
                <i class="fas fa-truck-moving"></i>
                <h3>Logística de Eventos</h3>
                <p>Gestión completa de infraestructura y operación para eventos impecables.</p>
            </div>

            <div class="service-card glass-effect">
                <i class="fas fa-music"></i>
                <h3>Producción Musical</h3>
                <p>Talentos musicales de alta calidad para crear la atmósfera perfecta.</p>
            </div>

            <div class="service-card glass-effect">
                <i class="fas fa-wine-glass-alt"></i>
                <h3>Abastecimiento Premium</h3>
                <p>Selección exclusiva de licores y bebidas para tu evento.</p>
            </div>
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
                    <a href="evento/'.htmlspecialchars($evento['slug']).'" class="event-card glass-effect">
                        <img src="assets/uploads/'.htmlspecialchars($evento['imagen']).'" alt="'.htmlspecialchars($evento['nombre']).'">
                        <div class="event-info">
                            <h3>'.htmlspecialchars($evento['nombre']).'</h3>
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i>
                                <span>'.date('d M Y', strtotime($evento['fecha'])).'</span>
                            </div>
                            <div class="event-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>'.htmlspecialchars($evento['ciudad']).', '.htmlspecialchars($evento['pais']).'</span>
                            </div>
                        </div>
                    </a>';
                }
            }
            ?>
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
                <form id="form-contacto" action="enviar.php" method="POST">
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
