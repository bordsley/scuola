<template>
  <div class="my-6">
    <b-image
      :src="'/img/' + multimedia.link"
      ratio="6by4"
      class="result"
      v-if="multimedia.tipologia == 'immagine'"
    ></b-image>
    <div class="columns is-centered" v-else>
      <iframe
        class="video"
        width="560"
        height="315"
        src="https://www.youtube.com/embed/eg4I1hwqWxM"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
      ></iframe>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    time: 0,
    interval: null,
  }),

  props: {
    multimedia: Object,
  },

  created() {
    console.log(this.multimedia);
  },

  methods: {},
};
</script>

<style>
.video {
  width: 100%;
  height: auto;
  min-height: 400px;
}

.result {
  transition: all 0.5s ease-in-out;

  border-radius: 2rem;
  padding: 1rem;
}

.result:hover {
  transform: scale(1.1, 1.1);
  opacity: 0.9;
}
</style>
