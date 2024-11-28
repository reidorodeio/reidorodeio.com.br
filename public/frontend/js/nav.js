// Espera 1.5 segundos e então oculta o preloader
window.addEventListener('load', function() {
    setTimeout(function() {
        document.querySelector('.preloader').classList.add('hidden');
    }, 1500); // 1500 ms = 1.5 segundos
});

// Abre e fecha o menu lateral ao clicar no hambúrguer
document.querySelector("#menu-toggle").addEventListener("change", function () {
    var sidebar = document.querySelector(".sidebar-menu");
    var overlay = document.querySelector(".body-overlay");

    if (this.checked) {
        sidebar.classList.add("active");
        overlay.classList.add("active");
    } else {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
    }
});

// Fecha o menu lateral ao clicar no overlay
document.querySelector(".body-overlay").addEventListener("click", function () {
    document.querySelector("#menu-toggle").checked = false;
    this.classList.remove("active");
    document.querySelector(".sidebar-menu").classList.remove("active");
});
