document.addEventListener('DOMContentLoaded', function() {
    // Efectos de scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.glass-effect').forEach(card => {
        observer.observe(card);
    });

    // Botón WhatsApp flotante
    const whatsappBtn = document.createElement('a');
    whatsappBtn.href = 'https://wa.me/573015017283';
    whatsappBtn.className = 'float-whatsapp';
    whatsappBtn.innerHTML = '<i class="fab fa-whatsapp"></i>';
    document.body.appendChild(whatsappBtn);
});
