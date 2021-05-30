<template>
<section>
    <div>
        <section class="hero is-success">
            <div class="hero-body">
                <p class="title">
                    Indirizzo
                </p>
                <p class="subtitle">
                    {{ data.alec.numero_aula }}
                    <br><br>
                    {{ data.alec.descrizione }}
                </p>
            </div>
        </section>
        <h1 class="testoCentrato">
            Queste immagini rappresentano i nostri laboratori e gli elementi che li
            compongono
        </h1>
        <div class="container is-max-desktop">
            <div class="m-2 p-2 is-flex is-justify-content-center is-flex-direction-column">
                <div class="card-content" v-for="multimedia of data.alec.centenutoMultimediales" :key="multimedia.id">
                    <Multimedia v-bind:multimedia="multimedia" />
                </div>
            </div>
        </div>
    </div>
</section>
</template>

<script>
import axios from "axios";
import Multimedia from "./Multimedia";

export default {
    data: () => ({
        data: [],
        isOpen: 0,
    }),

    components: {
        Multimedia,
    },

    created() {
        const id = document.getElementById("app").getAttribute("alec");

        axios
            .post(`/alec/data/` + id)
            .then((response) => {
                this.data = response.data;
            })
            .catch((e) => {
                console.error(e);
            });
    },
};
</script>

<style>
.break {
    overflow-wrap: break-word;
}

body {
    font-family: "Plus Jakarta Display", BlinkMacSystemFont, -apple-system,
        "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans",
        "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif !important;
}

* {
    transition: background-color 0.4s ease;
}

.testoCentrato {
    text-align: center;
    margin-top: 50px;
    font-size: 25px;
    color: rgb(27, 143, 221)
}

@import url("https://cdn.jsdelivr.net/npm/@xz/fonts@1/serve/plus-jakarta-display.min.css");
</style>
