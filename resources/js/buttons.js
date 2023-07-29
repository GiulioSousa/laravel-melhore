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
