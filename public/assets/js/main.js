let legalDropDown = document.querySelector(".legal-dropdown");

legalDropDown.addEventListener("click", () => {
    document
        .querySelector(".legal-dropdown-options")
        .classList.toggle("hidden");
});

document.querySelector(".menu").addEventListener("click", () => {
    // legalDropDown.classList.toggle("max-[680px]:hidden");
    document.querySelector(".mob-nav").classList.toggle("top-0");
});

document.querySelector(".close-promo").addEventListener("click", () => {
    document.querySelector(".soon-bar").classList.add("hidden");
    document.querySelector(".nav").classList.add("top-[0px]");
});


window.addEventListener("resize", (e) => {
    if (e.target.innerWidth >= 680) {
        document.querySelector(".mob-nav").classList.remove("top-0");
    }
});
