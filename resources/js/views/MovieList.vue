<template>
  <div >
    <div v-if="loading">loading</div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2" v-else>
      <router-link :to="'/movies/' + movie.slug" class="mx-2 border border-purple-500 rounded-md" v-for="movie in movies" v-bind:key="movie.id">
        <img class="h-64 lg:h-full w-full object-cover" :src="movie.image"/>
        <div class="p-4">
          <p class="text-lg">{{ movie.title }}</p>
          <p class="text-gray-500 text-sm">{{ movie.genre }}</p>
        </div>
      </router-link>
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
