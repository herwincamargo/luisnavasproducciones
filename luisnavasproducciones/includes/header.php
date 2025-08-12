<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luis Navas Producciones</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="#inicio"><img src="assets/images/logo.png" alt="Luis Navas Producciones"></a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#eventos">Eventos</a></li>
                    <li><a href="#nosotros">Nosotros</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.querySelector('.hamburger');
            const mainNav = document.querySelector('.main-nav');

            hamburger.addEventListener('click', () => {
                mainNav.classList.toggle('active');
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
<div class="container">
