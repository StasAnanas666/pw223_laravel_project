document.addEventListener("DOMContentLoaded", () => {
    //навигация

    const app = document.querySelector("#app");
    app.addEventListener("click", async (e) => {
        if (e.target.classList.contains("ajax-link")) {
            e.preventDefault();
            const url = e.target.getAttribute("href");
            console.log(url);
            try {
                const response = await fetchPage(url);
                const html = new DOMParser().parseFromString(
                    response,
                    "text/html"
                );
                const mainContent = html.querySelector("main").innerHTML;
                document.querySelector("#content").innerHTML = mainContent;
                history.pushState(null, "", url);
            } catch (error) {
                console.error("Ошибка загрузки страницы: ", error);
            }
        }
    });
});

async function fetchPage(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error("Ошибка: ", response.status);
        }
        return await response.text();
    } catch (error) {
        throw new Error("Ошибка загрузки страницы: ", error);
    }
}
