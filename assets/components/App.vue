<template>
<section>
    <div>
        <div v-for="indirizzi in data.indirizzi" :key="indirizzi.id">
            <section class="hero is-success">
                <div class="hero-body">
                    <p class="title">
                        Indirizzo
                    </p>
                    <p class="subtitle">
                        {{ indirizzi.descrizione }}
                    </p>
                </div>
            </section>
            <div class="container is-max-desktop">
                <div class="m-6 p-6 is-flex is-justify-content-center is-flex-direction-column">
                    <b-collapse class="card" animation="slide" v-for="(al_ec, index) of indirizzi.al_ecs" :key="index" :open="isOpen == index" @open="isOpen = index">
                        <template #trigger="props">
                            <div class="card-header" role="button">
                                <p class="card-header-title">
                                    aula
                                    {{ al_ec.numero_aula }}
                                </p>
                                <a class="card-header-icon">
                                    <b-icon :icon="props.open ? 'menu-down' : 'menu-up'">
                                    </b-icon>
                                </a>
                            </div>
                        </template>
                        <div class="card-content">
                            <div class="content">
                                {{ al_ec.descrizione }}
                            </div>
                        </div>
                    </b-collapse>
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
        Multimedia
    },

    created() {
        axios
            .post(`/indirizzi`)
            .then((response) => {
                this.data = response.data;
                console.log(this.data);
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

@import url("https://cdn.jsdelivr.net/npm/@xz/fonts@1/serve/plus-jakarta-display.min.css");
</style>
