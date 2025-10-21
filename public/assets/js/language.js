document.addEventListener("DOMContentLoaded", () => {
    if (!window.Translator) {
        return console.error("Translator library not found.");
    }

    const translator = new window.Translator({
        defaultLanguage: "en",
        detectLanguage: false,
        filesLocation: "/lang",
    });

    const savedLang = localStorage.getItem("lang") || "en";

    // Load saved language
    translator
        .fetch([savedLang])
        .then(() => translator.translatePageTo(savedLang))
        .catch((err) => console.error("Translation load failed:", err));

    // Highlight the saved active language
    document.querySelectorAll(".lang").forEach((link) => {
        const lang = link.getAttribute("data-lang");
        if (lang === savedLang) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }

        // Handle language switch
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const newLang = e.target.getAttribute("data-lang");

            localStorage.setItem("lang", newLang);

            translator
                .fetch([newLang])
                .then(() => translator.translatePageTo(newLang))
                .catch((err) =>
                    console.error("Translation switch failed:", err)
                );

            // Update active class
            document
                .querySelectorAll(".lang")
                .forEach((el) => el.classList.remove("active"));
            e.target.classList.add("active");
            location.reload();
        });
    });
    const legalButton = document.querySelector(".legal");
    const menu = document.querySelector(".legal-menu");
    if (legalButton && menu) {
        legalButton.addEventListener("click", () =>
            menu.classList.toggle("active")
        );
    }
});
