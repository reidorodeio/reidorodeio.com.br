document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector('.slider .list');
    const items = document.querySelectorAll('.slider .list .item');
    const nextButton = document.getElementById('next');
    const prevButton = document.getElementById('prev');
    const dots = document.querySelectorAll('.slider .dots li');
    
    let activeIndex = 0;
    const totalItems = items.length;

    // Função para atualizar o slider
    function updateSlider() {
        const offset = -activeIndex * slider.parentElement.clientWidth;
        slider.style.transform = `translateX(${offset}px)`;
        document.querySelector('.slider .dots li.active').classList.remove('active');
        dots[activeIndex].classList.add('active');
    }

    // Função para o próximo slide
    function nextSlide() {
        activeIndex = (activeIndex + 1) % totalItems;
        updateSlider();
    }

    // Função para o slide anterior
    function prevSlide() {
        activeIndex = (activeIndex - 1 + totalItems) % totalItems;
        updateSlider();
    }

    // Adicionando os eventos de clique nos botões de navegação
    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    // Adicionando os eventos de clique nos pontos de navegação
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            activeIndex = index;
            updateSlider();
        });
    });

    // Atualiza a posição do slider ao redimensionar a janela
    window.addEventListener('resize', updateSlider);
});
