<template>
  <div>
    <div v-if="loading">loading</div>
    <div v-else>
      <div v-for="movie in movies" v-bind:key="movie.id">
        <div class="h-48 w-32">
          <img :src="movie.image" />
        </div>
        <div>
          <p class="text-lg">{{ movie.title }}</p>
          <p class="text-gray-500 text-sm">{{ movie.genre }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios
      .get("/api/movies")
      .then(response => {
        this.movies = response.data.data;
      })
      .catch(error => {
        alert("Something went wrong");
      })
      .finally(() => (this.loading = false));
  },
  data: function() {
    return {
      movies: [],
      loading: true
    };
  }
};
</script>

<style>
</style>
