if (/term|policy|signup|login/.test(location.href)) {
    const img = document.querySelector(".navbar-brand img");
    if (img) img.style.filter = "invert(1)";
    [".legal", ".lang"].forEach(sel =>
        document.querySelectorAll(sel).forEach(el => el.style.filter = "invert(1)")
    );
}
