document.addEventListener("DOMContentLoaded", async () => {
    if (!window.Translator)
        return console.error("Translator library not found.");

    // Initialize the translator
    const translator = new window.Translator({
        defaultLanguage: "en",
        detectLanguage: false,
        filesLocation: "/lang",
    });

    const savedLang = localStorage.getItem("lang") || "en";

    // Load the translation file and translate the page
    await translator.fetch(savedLang); // ✅ use fetch() instead of load()
    translator.translatePageTo(savedLang);

    setActiveLangButton(savedLang);

    // Listen for language switch clicks
    document.querySelectorAll("[data-lang]").forEach((btn) => {
        btn.addEventListener("click", async (e) => {
            const lang = e.target.getAttribute("data-lang");
            await translator.fetch(lang); // ✅ fetch()
            translator.translatePageTo(lang);
            localStorage.setItem("lang", lang);
            setActiveLangButton(lang);
        });
    });

    // Add "active" style to selected language
    function setActiveLangButton(lang) {
        document.querySelectorAll("[data-lang]").forEach((btn) => {
            const isActive = btn.getAttribute("data-lang") === lang;

            let url = window.location.href;
            let shouldBeActive =
                url.includes("policy") || url.includes("term")
                    ? !isActive
                    : isActive;

            btn.classList.toggle("active", shouldBeActive);
            btn.classList.toggle("bg-white", shouldBeActive);
            btn.classList.toggle("text-black", shouldBeActive);
            btn.classList.toggle("border", !shouldBeActive);
            btn.classList.toggle("text-white", !shouldBeActive);
        });
    }
});
