let currentUrl = window.location.href;
if (
    currentUrl.includes("term") ||
    currentUrl.includes("policy") ||
    currentUrl.includes("signup") ||
    currentUrl.includes("login")
) {
    document.querySelector(".navbar-brand img").style.filter = "invert(1)";
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelector(".legal").style.color = "black";
        document.querySelectorAll(".lang").forEach((element) => {
            element.style.border = "1px solid black";
            element.style.color = "black";
            element.style.filter = "none";

            if (element.classList.contains("active")) {
                element.style.background = "black";
                element.style.color = "white";
            }
        });
        document.querySelectorAll(".nav-link").forEach((e) => {
            e.style.color = "black";
            e.style.filter = "none";
        });
    });
}
