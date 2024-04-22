// toggle active nav item
const navLinks = document.querySelectorAll('.main-nav-item')
navLinks.forEach(navLink => {
    console.log(navLink)
    navLink.addEventListener('click', ()=> {
        navLink.classList.add('active');
})})
console.log(navLinks)
document.querySelectorAll('.add-menu-item-radio-icon input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        // Update all radios in the same group
        document.querySelectorAll(`input[name='${this.name}']`).forEach(el => {
            let icon = el.nextElementSibling;
            if (el.checked) {
                icon.className = 'fas fa-dot-circle';
            } else {
                icon.className = 'far fa-circle';
            }
        });
    });
});
