document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.product-carousel').forEach((carousel) => {
        const track = carousel.querySelector('.product-track');
        if (!track) return;

        const count = Number(carousel.dataset.productCount) || track.children.length;

        if (count > 4) {
            // Duplikasi track agar animasi seamless (translateX -50%)
            track.append(...track.children.cloneNode(true).children);
        } else {
            // Data <= 4: matikan auto-scroll, tampilkan statis sebagai grid
            carousel.classList.add('is-static');
            track.style.animation = 'none';
        }
    });

    document.querySelectorAll('.project-carousel').forEach((carousel) => {
        const track = carousel.querySelector('.product-track, .project-track');
        if (!track || track.scrollWidth === 0) return;

        const speed = carousel.classList.contains('product-carousel') ? 0.5 : 0.6;
        let paused = false;
        let dragging = false;
        let pointerStart = 0;
        let scrollStart = 0;
        let moved = false;
        let resumeTimer;

        track.style.animation = 'none';

        const resume = (delay = 1000) => {
            clearTimeout(resumeTimer);
            resumeTimer = setTimeout(() => {
                paused = false;
            }, delay);
        };

        const loopScroll = () => {
            const gap = Number.parseFloat(getComputedStyle(track).columnGap) || 0;
            const cycleWidth = (track.scrollWidth + gap) / 2;

            if (!paused && cycleWidth > 0) {
                carousel.scrollLeft += speed;
            }
            if (carousel.scrollLeft >= cycleWidth) {
                carousel.scrollLeft -= cycleWidth;
            } else if (carousel.scrollLeft <= 0 && paused) {
                carousel.scrollLeft += cycleWidth;
            }
            requestAnimationFrame(loopScroll);
        };

        carousel.addEventListener('pointerdown', (event) => {
            dragging = true;
            moved = false;
            paused = true;
            pointerStart = event.clientX;
            scrollStart = carousel.scrollLeft;
            carousel.setPointerCapture(event.pointerId);
            carousel.classList.add('is-dragging');
        });

        carousel.addEventListener('pointermove', (event) => {
            if (!dragging) return;
            const distance = event.clientX - pointerStart;
            if (Math.abs(distance) > 4) moved = true;
            carousel.scrollLeft = scrollStart - distance;
        });

        const endDrag = (event) => {
            if (!dragging) return;
            dragging = false;
            carousel.releasePointerCapture?.(event.pointerId);
            carousel.classList.remove('is-dragging');
            resume();
        };

        carousel.addEventListener('pointerup', endDrag);
        carousel.addEventListener('pointercancel', endDrag);
        carousel.addEventListener('click', (event) => {
            if (moved) {
                event.preventDefault();
                event.stopPropagation();
                moved = false;
            }
        }, true);
        carousel.addEventListener('mouseenter', () => {
            if (!dragging) paused = true;
        });
        carousel.addEventListener('mouseleave', () => {
            if (!dragging) resume(400);
        });

        requestAnimationFrame(loopScroll);
    });
});
