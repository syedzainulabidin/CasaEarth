let legalDropDown = document.querySelector(".legal-dropdown");

legalDropDown.addEventListener("click", () => {
  document.querySelector(".legal-dropdown-options").classList.toggle("hidden");
});

document.querySelector(".menu").addEventListener("click", () => {
  // legalDropDown.classList.toggle("max-[680px]:hidden");
  document.querySelector(".mob-nav").classList.toggle("top-0");
});

document.querySelector(".close-promo").addEventListener("click", () => {
  document.querySelector(".soon-bar").classList.add("hidden");
  document.querySelector(".nav").classList.add("top-[0px]");
});

window.addEventListener("scroll", () => {
  const scrollTop = document.documentElement.scrollTop;
  const scrollHeight =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;
  const scrollPercent = (scrollTop / scrollHeight) * 100;

  const nav = document.querySelector(".nav");

  if (scrollPercent >= 1) {
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
});

window.addEventListener("resize", (e) => {
  if (e.target.innerWidth >= 680) {
    document.querySelector(".mob-nav").classList.remove("top-0");
  }
});


