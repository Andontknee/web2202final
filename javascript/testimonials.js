document.addEventListener('DOMContentLoaded', function() {
    const dots = document.querySelectorAll('.dot');
    const cards = document.querySelectorAll('.testimonial-card');
    const leftNav = document.querySelector('.left-nav');
    const rightNav = document.querySelector('.right-nav');
    let currentIndex = 0;

    function updateActiveCard(index) {
        if (index >= cards.length) index = 0;
        if (index < 0) index = cards.length - 1;

        cards.forEach(card => card.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        cards[index].classList.add('active');
        dots[index].classList.add('active');
        currentIndex = index;
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => updateActiveCard(index));
    });

    leftNav.addEventListener('click', () => updateActiveCard(currentIndex - 1));
    rightNav.addEventListener('click', () => updateActiveCard(currentIndex + 1));

    let autoRotate = setInterval(() => updateActiveCard(currentIndex + 1), 5000);

    document.querySelector('.testimonial-carousel').addEventListener('mouseenter', () => {
        clearInterval(autoRotate);
    });

    document.querySelector('.testimonial-carousel').addEventListener('mouseleave', () => {
        autoRotate = setInterval(() => updateActiveCard(currentIndex + 1), 5000);
    });
});