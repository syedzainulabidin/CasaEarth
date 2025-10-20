let currentUrl = window.location.href;
if (currentUrl.includes("term") || currentUrl.includes("policy")) {
    document.querySelector(".navbar-brand img").style.filter = "invert(1) drop-shadow(0 0 4px rgba(0,0,0,0.6)) drop-shadow(0 0 8px rgba(0,0,0,0.3))";
}
