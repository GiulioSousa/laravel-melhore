let header = document.querySelector('.header');
let headerLogoColor = header.querySelector('#logo-color');
let headerLogoTransp = header.querySelector('#logo-transp');
let headerMenu = document.querySelector('.header__menu');
let headerMenuIc = headerMenu.querySelectorAll('.menu-ic');
let lateralMenu = document.querySelector('.lateral-menu');

window.addEventListener('scroll', () => {
    let switchEffect = false;
    if(window.scrollY > 10 && !switchEffect) {
        header.classList.add('header--transition');
        headerLogoColor.classList.remove('header__logo--invisible');
        headerLogoTransp.classList.add('header__logo--invisible');
        headerMenuIc.forEach(ic => ic.classList.add('menu-ic--color'));
        switchEffect = true;
    } else {
        header.classList.remove('header--transition');
        headerLogoColor.classList.add('header__logo--invisible');
        headerLogoTransp.classList.remove('header__logo--invisible');
        headerMenuIc.forEach(ic => ic.classList.remove('menu-ic--color'));
        switchEffect = false;
    }
});

headerMenu.addEventListener('click', () => {
    headerMenuIc.forEach(ic => {
        ic.classList.toggle('menu-ic--active');
    });

    headerMenu.classList.toggle('header__menu--active');
    lateralMenu.classList.toggle('lateral-menu--active');
});
