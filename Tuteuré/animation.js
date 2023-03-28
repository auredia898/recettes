const menu = document.querySelector(".menu");
const navMenu = document.querySelector(".nav-menu");

menu.addEventListener("click", () => {
    menu.classList.toggle("active");
  navMenu.classList.toggle("active");
});

document.querySelectorAll(".nav-link").forEach((link) =>
  link.addEventListener("click", () => {
    menu.classList.remove("active");
    navMenu.classList.remove("active");
  })
);

    var typed = new Typed(".multiple-text", {
    strings: ["Le Benin, comme nulle part ailleurs.", "Le pays qui voyage en vous.",
     "Destination Benin, prenez le temps de tout vivre !"],
        typeSpeed:100,
        backSpeed:100,
        backDelay:1000,
        loop: true
})