<?php include 'includes/header.php'; ?>

<main class="glass-container">
    <h1>Contacto</h1>
    <div class="contact-info">
        <h2>Información de Contacto</h2>
        <p><strong>Teléfono:</strong> +57 301 5017283</p>
        <p><strong>Email:</strong> info@luisnavasproducciones.com</p>
        <p><strong>Ubicación:</strong> Barranquilla, Atlántico, Colombia</p>
    </div>

    <div class="contact-form">
        <h2>Envíanos un Mensaje</h2>
        <form action="enviar.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
