;(function ($) {
    "use strict";

    $(document).ready(function () {
        /**-----------------------------
         *  Navbar Fix e Menu Responsivo
         * ---------------------------*/
        // Impede a navegação de menus que têm submenus no desktop
        $(document).on('click', '.navbar-area .navbar-nav li.menu-item-has-children > a', function (e) {
            e.preventDefault();
        });

        // Controle do Menu no Mobile
        $('.navbar-area .menu').on('click', function() {
            $(this).toggleClass('open');
            $('.navbar-area .navbar-collapse').toggleClass('sopen');
        });

        // Adiciona submenus no menu lateral no mobile
        if ($(window).width() < 992) {
            $(".in-mobile").clone().appendTo(".sidebar-inner");
            $(".in-mobile ul li.menu-item-has-children").append('<i class="fas fa-chevron-right"></i>');

            $(".menu-item-has-children a").on('click', function(e) {
                $(this).siblings('.sub-menu').animate({ height: "toggle" }, 300);
            });
        }

        // Configurações para alternar o menu principal no mobile
        var menutoggle = $('.menu-toggle');
        var mainmenu = $('.navbar-nav');
        menutoggle.on('click', function() {
            if (menutoggle.hasClass('is-active')) {
                mainmenu.removeClass('menu-open');
            } else {
                mainmenu.addClass('menu-open');
            }
        });

        /*--------------------------------------------
            Controle do Overlay e Menu Lateral
        ---------------------------------------------*/
        var bodyOverlay = $('#body-overlay');
        var sidebarMenu = $('#sidebar-menu');

        // Fecha o menu lateral e o overlay ao clicar no body-overlay
        $(document).on('click', '#body-overlay', function(e) {
            e.preventDefault();
            bodyOverlay.removeClass('active');
            sidebarMenu.removeClass('active');
        });

        // Abre o menu lateral ao clicar no botão de navegação
        $(document).on('click', '#navigation-button', function(e) {
            e.preventDefault();
            sidebarMenu.addClass('active');
            bodyOverlay.addClass('active');
        });

        // Fecha o menu lateral ao clicar no botão de fechar
        $(document).on('click', '.sidebar-menu-close', function(e) {
            e.preventDefault();
            sidebarMenu.removeClass('active');
            bodyOverlay.removeClass('active');
        });

        /*--------------------------------------------
            Outros Scripts de Interface
        ---------------------------------------------*/
        // Configura sliders, animações, pop-ups e contadores (se aplicável)
        // ...

        /*-------------------------------------------------
           Voltar ao topo
        --------------------------------------------------*/
        $(document).on('click', '.back-to-top', function () {
            $("html, body").animate({ scrollTop: 0 }, 2000);
        });
    });

    /*--------------------------------------------
        Comportamento de Rolagem e Sticky Navbar
    ---------------------------------------------*/
    $(window).on("scroll", function() {
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 1000) {
            ScrollTop.fadeIn(1000);
        } else {
            ScrollTop.fadeOut(1000);
        }

        var scroll = $(window).scrollTop();
        if (scroll < 445) {
            $(".navbar").removeClass("sticky-active");
        } else {
            $(".navbar").addClass("sticky-active");
        }
    });

    /*--------------------------------------------
        Preloader e Inicialização no Load
    ---------------------------------------------*/
    $(window).on('load', function () {
        $(".preloader").fadeOut(3000);
        $('.back-to-top').fadeOut();
    });

})(jQuery);