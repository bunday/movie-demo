<template>
    <div v-if="loading"> loading</div>
  <div v-else class="flex mx-4 flex-col">
    <div class="flex flex-col md:flex-row">
      <img class="h-full w-full md:w-1/2 object-cover" :src="movie.image" />
      <div class="md:px-4 w-full md:w-1/2">
        <div class="flex flex-col leading-loose">
          <p class="text-purple-500 font-bold text-lg">{{movie.title}}</p>

          <p class="text-gray-500">
            <span class="text-gray-600">Price:</span>
            NGN {{movie.price}}
          </p>
          <p class="text-gray-500">
            <span class="text-gray-600">Release Date:</span>
            {{movie.release_date}}
          </p>
          <p class="text-gray-500">
            <span class="text-gray-600">Country:</span>
            {{movie.country}}
          </p>
          <p class="text-gray-500">
            <span class="text-gray-600">Genre:</span>
            {{movie.genre}}
          </p>
          <p class="text-gray-500">
            <span class="text-gray-600">Rating:</span>
            {{movie.rating}}/5
          </p>
          <p class="text-gray-500 leading-tight">
            <span class="text-gray-600">Description:</span>
            {{movie.description}} {{movie.description}} {{movie.description}} {{movie.description}}
          </p>
        </div>
      </div>
    </div>
    <div class="py-4">
      <p class="text-white text-xl">Comments</p>
      <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2 w-full mx-2">
            <div v-if="movie.comments.length < 1">
                No Comments yet ...
            </div>
          <div v-else class="py-2" v-for="comment in movie.comments" v-bind:key="comment.id">
            <p>
              <span class="font-bold">{{comment.name}}:</span>
              {{ comment.content}}
            </p>
            <p class="text-sm text-right">{{ comment.created }}</p>
          </div>
        </div>
        <div class="md:w-1/2 w-full mx-2">
          <form @submit="formSubmit">
            <div class="mb-4">
              <p class="block text-gray-300 text-sm font-bold mb-2">Add a New Comment</p>
              <div class="flex">
                <textarea
                  rows="5"
                  class="shadow appearance-none w-full border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                  v-model="comment"
                  required
                ></textarea>
              </div>
            </div>
            <div class="my-4">
              <button
                type="submit"
                class="px-4 rounded-md text-center text-lg py-2 bg-purple-500"
              >Comment</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    axios
      .get("/api/movies/" + this.$route.params.slug)
      .then(response => {
        this.movie = response.data.data;
        this.loading = false;
      })
      .catch(error => {
        this.loading = false;

        if (error.response.status === 404) {
          window.location.href = "/movies";
        }
      });
  },
  data: function() {
    return {
      movie: null,
      loading: true,
      comment: ''
    };
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      const dto = {
        content: this.comment,
        movie_id: this.movie.id
      }
      axios
        .post("/api/movies/comment", dto)
        .then(response => {
          console.log(response);
          window.location.href = "/movies/"+this.$route.params.slug;
        })
    }
  }
};
</script>

<style>
</style>
