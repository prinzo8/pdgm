

/* Section back navigation */
const sectionBack = document.querySelector('.section-back');

if (sectionBack) {
    const sections = Array.from(
        document.querySelectorAll('main > section[id]')
    );

    const updateSectionBack = () => {
        const currentScroll = window.scrollY + (window.innerHeight * 0.35);
        let currentIndex = 0;

        sections.forEach((section, index) => {
            if (section.offsetTop <= currentScroll) {
                currentIndex = index;
            }
        });

        if (currentIndex >= 1) {
            sectionBack.classList.add('visible');
            sectionBack.dataset.previousSection = sections[currentIndex - 1].id;
        } else {
            sectionBack.classList.remove('visible');
            sectionBack.removeAttribute('data-previous-section');
        }
    };

    sectionBack.addEventListener('click', () => {
        const previousId = sectionBack.dataset.previousSection;

        if (!previousId) return;

        const previousSection = document.getElementById(previousId);

        if (previousSection) {
            previousSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });

    window.addEventListener('scroll', updateSectionBack, { passive: true });
    window.addEventListener('resize', updateSectionBack);

    updateSectionBack();
}
