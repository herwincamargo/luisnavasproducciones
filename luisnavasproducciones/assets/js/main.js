// Preloader
window.addEventListener('load', function() {
    gsap.to('#preloader', {
        opacity: 0,
        duration: 0.5,
        onComplete: function() {
            document.getElementById('preloader').style.display = 'none';
        }
    });

    // Animaciones después de que carga la página
    initAnimations();
});

// Cursor Personalizado
const cursor = document.querySelector('.cursor');
const cursorFollower = document.querySelector('.cursor-follower');

document.addEventListener('mousemove', (e) => {
    cursor.style.left = e.clientX + 'px';
    cursor.style.top = e.clientY + 'px';

    gsap.to(cursorFollower, {
        left: e.clientX,
        top: e.clientY,
        duration: 0.5
    });
});

document.querySelectorAll('a, button, .btn, input, .glass-effect').forEach(item => {
    item.addEventListener('mouseenter', () => {
        cursor.style.transform = 'scale(2)';
        cursorFollower.style.transform = 'scale(0.5)';
    });

    item.addEventListener('mouseleave', () => {
        cursor.style.transform = 'scale(1)';
        cursorFollower.style.transform = 'scale(1)';
    });
});

function initHeroCarousel() {
    const slides = gsap.utils.toArray('.hero-text-slide');
    if (slides.length < 2) {
        if (slides.length === 1) {
            gsap.set(slides[0], { autoAlpha: 1, position: 'relative' });
        }
        return;
    }

    let currentSlide = 0;
    let autoPlayInterval;
    let isAnimating = false;

    gsap.set(slides, { autoAlpha: 0, position: 'absolute', top: 0, left: 0, width: '100%' });
    gsap.set(slides[0], { autoAlpha: 1, position: 'relative' });
    gsap.from(slides[0].children, { y: 30, opacity: 0, stagger: 0.1, ease: 'power3.out', duration: 0.8 });

    function goToSlide(slideIndex) {
        if (isAnimating || slideIndex === currentSlide) return;
        isAnimating = true;

        const outgoingSlide = slides[currentSlide];
        const incomingSlide = slides[slideIndex];

        const tl = gsap.timeline({
            onComplete: () => {
                currentSlide = slideIndex;
                isAnimating = false;
            }
        });
        tl.to(outgoingSlide.children, { y: -30, opacity: 0, stagger: 0.1, ease: 'power3.in', duration: 0.5 })
          .set(outgoingSlide, { autoAlpha: 0, position: 'absolute' })
          .set(incomingSlide, { autoAlpha: 1, position: 'relative' })
          .from(incomingSlide.children, { y: 30, opacity: 0, stagger: 0.1, ease: 'power3.out', duration: 0.8 });
    }

    function startAutoplay() {
        clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(() => {
            const nextSlide = (currentSlide + 1) % slides.length;
            goToSlide(nextSlide);
        }, 5000);
    }

    function stopAutoplay() {
        clearInterval(autoPlayInterval);
    }

    const heroWrapper = document.querySelector('.hero-content-wrapper');
    if (heroWrapper) {
        heroWrapper.addEventListener('mouseenter', stopAutoplay);
        heroWrapper.addEventListener('mouseleave', startAutoplay);
    }

    startAutoplay();
}

// Scroll Animations
function initAnimations() {
    initHeroCarousel();

    gsap.utils.toArray('.section').forEach((section, i) => {
        const content = section.querySelector('.container');

        gsap.from(content, {
            scrollTrigger: {
                trigger: section,
                start: 'top 70%',
                toggleActions: 'play none none none'
            },
            y: 50,
            opacity: 0,
            duration: 0.8,
            ease: 'power2.out'
        });
    });

    gsap.to('.hero-video', {
        scrollTrigger: {
            trigger: '.hero',
            start: 'top top',
            end: 'bottom top',
            scrub: true
        },
        y: 100,
        ease: 'none'
    });

    gsap.utils.toArray('.glass-effect').forEach((card, i) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top 80%',
                toggleActions: 'play none none none'
            },
            y: 50,
            opacity: 0,
            duration: 0.6,
            delay: i * 0.1,
            ease: 'back.out(1)'
        });
    });
}

// Smooth Scroll para enlaces internos
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        gsap.to('.page-transition', {
            scaleY: 1,
            transformOrigin: 'bottom',
            duration: 0.5,
            ease: 'power2.in',
            onComplete: function() {
                document.querySelector(anchor.getAttribute('href')).scrollIntoView({
                    behavior: 'auto'
                });
                gsap.to('.page-transition', {
                    scaleY: 0,
                    transformOrigin: 'top',
                    duration: 0.5,
                    ease: 'power2.out'
                });
            }
        });
    });
});

// Header Scroll Effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.site-header');
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Formulario de contacto
const contactForm = document.getElementById('form-contacto');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        gsap.to('#form-contacto', {
            opacity: 0.5,
            duration: 0.3,
            onComplete: function() {
                alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');
                contactForm.reset();
                gsap.to('#form-contacto', {
                    opacity: 1,
                    duration: 0.3
                });
            }
        });
    });
}

// Lazy Loading para imágenes
if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
        if (img.dataset.src) {
            img.src = img.dataset.src;
        }
    });
} else {
    const lazyLoadInstance = new LazyLoad({
        elements_selector: ".lazy"
    });
}
