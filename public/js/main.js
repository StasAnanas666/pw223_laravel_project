document.addEventListener("DOMContentLoaded", () => {
    //навигация

    const app = document.querySelector("#app");
    app.addEventListener("click", async (e) => {
        if (e.target.classList.contains("ajax-link")) {
            e.preventDefault();
            const url = e.target.getAttribute("href");
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

    //чекбоксы доп услуг, пересчет суммы заказа
    document.addEventListener("change", (e) => {
        if(e.target.classList.contains("additional-service-checkbox")) {
            let totalPriceElement = document.querySelector("#total-price");
            console.log(totalPriceElement);
            const checkbox = e.target;
            let price = parseFloat(checkbox.value);
            console.log(price);
            let totalPrice = parseFloat(totalPriceElement.textContent);
            console.log(totalPrice);
            if(checkbox.checked) {
                console.log("Checked!");
                totalPrice += price;
            }
            else {
                totalPrice -= price;
            }
            totalPriceElement.textContent = totalPrice;
        }
    })
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
