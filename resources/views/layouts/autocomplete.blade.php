<script>
    class GeoapifyAutocomplete {
        constructor(selector, apiKey) {
            this.apiKey = apiKey;
            this.inputs = document.querySelectorAll(selector);

            this.inputs.forEach(input => {
                this.createAutocomplete(input);
            });
        }

        createAutocomplete(input) {
            const wrapper = document.createElement("div");
            wrapper.style.position = "relative";
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);

            const list = document.createElement("div");
            list.classList.add("autocomplete-list");
            list.style.position = "absolute";
            list.style.border = "1px solid #ccc";
            list.style.background = "white";
            list.style.maxHeight = "200px";
            list.style.overflowY = "auto";
            list.style.width = "100%";
            wrapper.appendChild(list);

            input.addEventListener("input", async () => {
                const query = input.value.trim();
                if (query.length < 3) {
                    list.innerHTML = "";
                    return;
                }

                const url =
                    `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(query)}&limit=5&apiKey=${this.apiKey}`;

                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    list.innerHTML = "";

                    if (data.features.length) {
                        data.features.forEach((feature) => {
                            const item = document.createElement("div");
                            item.classList.add("autocomplete-item");
                            item.textContent = feature.properties.formatted;
                            item.style.padding = "8px";
                            item.style.cursor = "pointer";

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
        }
    }

    // Initialize autocomplete for all inputs with the class "autocomplete-address"
    new GeoapifyAutocomplete(".autocomplete-address", "46bc8355b7f3494ebcb210ce851ba1ad");
</script>
<script>
    class GeoapifyCityAutocomplete {
        constructor(selector, apiKey) {
            this.apiKey = apiKey;
            this.inputs = document.querySelectorAll(selector);

            this.inputs.forEach(input => {
                this.createAutocomplete(input);
            });
        }

        createAutocomplete(input) {
            const wrapper = document.createElement("div");
            wrapper.style.position = "relative";
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);

            const list = document.createElement("div");
            list.classList.add("autocomplete-list");
            list.style.position = "absolute";
            list.style.border = "1px solid #ccc";
            list.style.background = "white";
            list.style.maxHeight = "200px";
            list.style.overflowY = "auto";
            list.style.width = "100%";
            wrapper.appendChild(list);

            input.addEventListener("input", async () => {
                const query = input.value.trim();
                if (query.length < 3) {
                    list.innerHTML = "";
                    return;
                }

                const url =
                    `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(query)}&limit=10&apiKey=${this.apiKey}`;

                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    list.innerHTML = "";

                    if (data.features.length) {
                        data.features.forEach((feature) => {
                            if (feature.properties.city) {
                                const item = document.createElement("div");
                                item.classList.add("autocomplete-item");
                                item.textContent = feature.properties.city;
                                item.style.padding = "8px";
                                item.style.cursor = "pointer";

                                item.addEventListener("click", () => {
                                    input.value = feature.properties.city;
                                    list.innerHTML = "";
                                });

                                list.appendChild(item);
                            }
                        });
                    }
                } catch (error) {
                    console.error("Error fetching city suggestions:", error);
                }
            });

            document.addEventListener("click", (event) => {
                if (!list.contains(event.target) && event.target !== input) {
                    list.innerHTML = "";
                }
            });
        }
    }

    // Initialize autocomplete for all inputs with the class "autocomplete-city"
    new GeoapifyCityAutocomplete(".autocomplete-city", "46bc8355b7f3494ebcb210ce851ba1ad");
</script>
