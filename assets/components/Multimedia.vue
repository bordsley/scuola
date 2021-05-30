<template>
<div class="my-6">
    <b-image :src="'img/' + multimedia.link" ratio="6by4" v-if="multimedia.tipologia=='immagine'"></b-image>
    <div class="card mx-6" v-else>
        <div class="card-content">
            <p class="title is-size-5">
                {{multimedia.link}}
            </p>
            <b-progress :value="time"></b-progress>
        </div>
        <footer class="card-footer">
            <p class="card-footer-item" v-on:click="play()">
                <b-icon :icon="interval?'pause':'play'" size="is-medium">
                </b-icon>
            </p>
        </footer>
    </div>
</div>
</template>

<script>
export default ({
    data: () => ({
        time: 0,
        interval: null,
    }),

    props: {
        multimedia: Object,
    },

    methods: {
        play: function () {
            if (this.interval) {
                clearInterval(this.interval)
                this.interval = null;
            } else {
                this.interval = setInterval(() => {
                    this.time++;
                    if (this.time >= 120) {
                        this.time = 0;
                        clearInterval(this.interval)
                        this.interval = null;
                    }
                    console.log(this.time)
                }, 30);
            }
        }
    },
})
</script>
