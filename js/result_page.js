const toTop = document.querySelector(".to-top");

window.addEventListener('scroll', event => {
    let nav = document.querySelector('.header');

    (window.scrollY >= 150) ? nav.classList.add('scroll') : nav.classList.remove('scroll');
})

window.addEventListener("scroll", () => {
    if (window.pageYOffset > 150) {
        toTop.classList.add("active");
    } else{
        toTop.classList.remove("active");
    }
})