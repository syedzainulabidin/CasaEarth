window.addEventListener("scroll", () => {
    const scrollTop = document.documentElement.scrollTop;
    const scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    const scrollPercent = (scrollTop / scrollHeight) * 100;

    const nav = document.querySelector(".nav");

    if (scrollPercent >= 3) {
        nav.classList.add("scrolled");
    } else {
        nav.classList.remove("scrolled");
    }
});
