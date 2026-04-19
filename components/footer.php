<!-- Intersection Observer for Lazy Loading Animations (Optional) & Navigation Scroll Spy -->
<script defer>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Scroll Spy Navigation
        const sections = document.querySelectorAll('section, header[id="hero"], footer[id="contact"]');
        const navLinks = document.querySelectorAll('.nav-link');

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.4
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(link => {
                        link.classList.remove('text-accent-pink', 'text-accent-blue');
                        link.classList.add('text-ink');

                        if (link.getAttribute('href').substring(1) === entry.target.id) {
                            // Toggle active state colors
                            const activeColor = (entry.target.id === 'music' || entry.target.id === 'hero') ? 'text-accent-pink' : 'text-accent-blue';
                            link.classList.remove('text-ink');
                            link.classList.add(activeColor, 'font-black');
                        } else {
                            link.classList.remove('font-black');
                        }
                    });
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            observer.observe(section);
        });

        // 2. Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                    // Update URL without jump
                    history.pushState(null, null, '#' + targetId);
                }
            });
        });
    });

</script>

</body>

</html>