// Menu and Navbar
let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

// Dropdown user
let dropdown = document.querySelector('.dropdown');
let dropdownMenu = document.querySelector('.dropdown-menu');
dropdown.onclick = () => {
    dropdownMenu.classList.toggle('active');
}

// Alert
let alertBox = document.querySelector('.alert');
document.querySelector('#btn-alert-close').onclick = () => {
    alertBox.classList.remove('active');
}
