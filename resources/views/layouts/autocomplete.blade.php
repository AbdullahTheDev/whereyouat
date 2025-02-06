<script>
    const apiKey = "46bc8355b7f3494ebcb210ce851ba1ad";
    const input = document.getElementById("address-input");
    const list = document.getElementById("autocomplete-list");

    input.addEventListener("input", async () => {
        const query = input.value.trim();
        if (query.length < 3) {
            list.innerHTML = "";
            return;
        }
        const url =
            `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(query)}&limit=5&apiKey=${apiKey}`;

        try {
            const response = await fetch(url);
            const data = await response.json();
            list.innerHTML = "";

            if (data.features.length) {
                data.features.forEach((feature) => {
                    const item = document.createElement("div");
                    item.classList.add("autocomplete-item");
                    item.textContent = feature.properties.formatted;
                    item.addEventListener("click", () => {
                        input.value = feature.properties.formatted;
                        list.innerHTML = "";
                    });
                    list.appendChild(item);
                });
            }
        } catch (error) {
            console.error("Error fetching address suggestions:", error);
        }
    });

    document.addEventListener("click", (event) => {
        if (!list.contains(event.target) && event.target !== input) {
            list.innerHTML = "";
        }
    });
</script>