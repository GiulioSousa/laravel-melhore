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

const metricMenu = document.querySelectorAll('.metric-menu')
const metricMenuBtn = childrenMap(metricMenu, 0)
const metricMenuBtnClose = childrenMap(metricMenu, 1)
const metricMenuBtnEdit = childrenMap(metricMenu, 2)
const metricMenuBtnDeleteForm = childrenMap(metricMenu, 3)
const metricMenuBtnDelete = childrenMap(metricMenuBtnDeleteForm, 2)

function childrenMap(nodeList, i) {
    return Array.from(nodeList).map((item) => {
        return item.children[i]
    })
}

function toggleMenu(button, classMod) {
    button.classList.toggle(classMod);
}

metricMenu.forEach((menu, i) => {
    menu.addEventListener('click', () => {
        toggleMenu(menu, 'metric-menu--active');
        toggleMenu(metricMenuBtn[i], 'metric-menu__btn--active');
        toggleMenu(metricMenuBtnClose[i], 'metric-menu__btn-close--active');
        toggleMenu(metricMenuBtnEdit[i], 'metric-menu__edit--active');
        toggleMenu(metricMenuBtnDeleteForm[i], 'metric-menu__form--active')
        toggleMenu(metricMenuBtnDelete[i], 'metric-menu__delete--active');
    });
});
