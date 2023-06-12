/*!
* Start Bootstrap - Creative v7.0.7 (https://startbootstrap.com/theme/creative)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-creative/blob/master/LICENSE)
*/
//
// Scripts
// 


// Navbar blanche au scroll
window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});


// Bouton pour revenir en haut
window.addEventListener('load', function () {
    let btnTop = document.getElementById("btn-top");
    // display the button when user scrolls more than 20px
    window.onscroll = function () {
        if (
            document.body.scrollTop > 20 || document.documentElement.scrollTop > 20
        ) {
            btnTop.style.display = "block";
        } else {
            btnTop.style.display = "none";
        }
    };
    btnTop.addEventListener("click", function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });
})

// Horaires
const time = () => {

    const activerow = document.querySelector('#activerow');

    const monday = document.querySelector('.monday');
    const tuesday = document.querySelector('.tuesday');
    const wednesday = document.querySelector('.wednesday');
    const thursday = document.querySelector('.thursday');
    const friday = document.querySelector('.friday');
    const saturday = document.querySelector('.saturday');
    const sunday = document.querySelector('.sunday');


    switch (new Date().getDay()) {

        case 1:
            monday.setAttribute("id", "activerow");
            break;
        case 2:
            tuesday.setAttribute("id", "activerow");
            break;
        case 3:
            wednesday.setAttribute("id", "activerow");
            break;
        case 4:
            thursday.setAttribute("id", "activerow");
            break;
        case 5:
            friday.setAttribute("id", "activerow");
            break;
        case 6:
            saturday.setAttribute("id", "activerow");
            break;
        case 0:
            sunday.setAttribute("id", "activerow");
            break;
    }

}
time();

  function password_show_hide() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
      x.type = "text";
      show_eye.style.display = "none";
      hide_eye.style.display = "block";
    } else {
      x.type = "password";
      show_eye.style.display = "block";
      hide_eye.style.display = "none";
    }
  }
