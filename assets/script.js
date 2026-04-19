console.log("Prince Neupane Portfolio Loaded! 🎸");

document.addEventListener('DOMContentLoaded', () => {

    // 1. FAKE DRAGGABLE EFFECT FOR GALLERY
    const galleryItems = document.querySelectorAll('.gallery-item');
    let highestZIndex = 100; // Counter to bring active item to top

    galleryItems.forEach(item => {
        let isDragging = false;
        let startX, startY;
        let initialX = 0, initialY = 0;

        // Mouse Events
        item.addEventListener('mousedown', startDrag);
        document.addEventListener('mousemove', drag);
        document.addEventListener('mouseup', stopDrag);

        // Touch Events (Mobile Support)
        item.addEventListener('touchstart', startDrag, { passive: false });
        document.addEventListener('touchmove', drag, { passive: false });
        document.addEventListener('touchend', stopDrag);

        function startDrag(e) {
            isDragging = true;
            highestZIndex++;
            item.style.zIndex = highestZIndex;

            // Remove transition during drag to prevent sluggish follow
            item.style.transition = 'none';
            // Slight visual indicator of grab
            item.style.cursor = 'grabbing';
            item.style.filter = 'brightness(1.1)';

            const event = e.type.includes('mouse') ? e : e.touches[0];
            startX = event.clientX - initialX;
            startY = event.clientY - initialY;

            // Prevent default behavior (like image dragging ghost) only for touch if needed, or mouse down
            if (e.type === 'mousedown') {
                e.preventDefault();
            }
        }

        function drag(e) {
            if (!isDragging) return;

            const event = e.type.includes('mouse') ? e : e.touches[0];

            initialX = event.clientX - startX;
            initialY = event.clientY - startY;

            // Keep the original rotation but translate
            // Extract current rotation if possible, but for simplicity, we will just apply a subtle tilt based on X movement
            const tilt = initialX * 0.05; // Subtle rotate based on movement
            item.style.transform = `translate(${initialX}px, ${initialY}px) rotate(${tilt}deg)`;
        }

        function stopDrag() {
            if (!isDragging) return;
            isDragging = false;

            // Re-enable transition for smooth hover states
            item.style.transition = 'all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            item.style.cursor = 'grab';
            item.style.filter = '';

            // Snap a bit or reset tilt (Keep translation)
            item.style.transform = `translate(${initialX}px, ${initialY}px) rotate(${Math.random() * 10 - 5}deg)`;
        }
    });

    // 2. PARALLAX HOVER TILT (For hero cards, about containers)
    const interactiveElements = document.querySelectorAll('.interactive-hover');

    interactiveElements.forEach(el => {
        el.addEventListener('mousemove', (e) => {
            const rect = el.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // Calculate center
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            // Calculate distance from center (-1 to 1)
            const rotateX = ((y - centerY) / centerY) * -5; // Up/down tilt
            const rotateY = ((x - centerX) / centerX) * 5; // Left/right tilt

            el.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
        });

        // Reset on leave
        el.addEventListener('mouseleave', () => {
            el.style.transform = '';
            el.style.transition = 'transform 0.5s ease, box-shadow 0.5s ease';

            // Quick clean transition reset
            setTimeout(() => {
                el.style.transition = '';
            }, 500);
        });
    });

    // 3. SMOOTH SCROLL FOR NAV LINKS
    document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElem = document.querySelector(targetId);
            if (targetElem) {
                targetElem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

});
