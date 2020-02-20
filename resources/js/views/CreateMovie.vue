<template>
  <div>
    <p>Create a New Movie</p>
    <div class="flex container mx-4 lg:mx-48">
      <form @submit="formSubmit" enctype="multipart/form-data">
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Title</p>
          <div class="flex">
            <input
              class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              placeholder="Title"
              required
              v-model="title"
            />
          </div>
        </div>
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Poster</p>
          <div class="flex">
            <input
              class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              type="file"
              required
              v-on:change="onImageChange"
            />
          </div>
        </div>
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Release Date</p>
          <div class="flex">
            <input
              class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              type="date"
              required
              v-model="release_date"
            />
          </div>
        </div>
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Rating</p>
          <div class="flex">
            <select
              class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              v-model="rating"
              required
            >
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Price</p>
          <div class="flex">
            <input
              class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              type="number"
              required
              v-model="price"
            />
          </div>
        </div>
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Country</p>
          <div class="flex">
            <input
              class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              type="text"
              v-model="country"
              required
            />
          </div>
        </div>
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Genre</p>
          <div class="flex">
            <input
              class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              type="text"
              v-model="genre"
              required
            />
          </div>
        </div>
        <div class="my-4">
          <p class="block text-gray-300 text-sm font-bold mb-2">Description</p>
          <div class="flex">
            <textarea
              rows="5"
              class="shadow appearance-none w-full border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
              v-model="description"
              required
            ></textarea>
          </div>
        </div>
        <div class="my-4">
          <button
            type="submit"
            class="px-4 rounded-md text-center text-lg py-2 bg-purple-500"
          >Create</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "",
      image: "",
      release_date: "",
      rating: "",
      price: "",
      country: "",
      genre: "",
      description: ""
    };
  },
  methods: {
    onImageChange(e) {
      this.image = e.target.files[0];
    },
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;

      const config = {
        headers: { "content-type": "multipart/form-data" }
      };

      let formData = new FormData();
      formData.append("image", this.image);
      formData.append("title", this.title);
      formData.append("release_date", this.release_date);
      formData.append("rating", this.rating);
      formData.append("price", this.price);
      formData.append("country", this.country);
      formData.append("genre", this.genre);
      formData.append("description", this.description);

      axios
        .post("/api/movies", formData, config)
        .then((response) => {
            console.log(response)
            // Redirect to list of movies
            window.location.href="/movies"
        })
        .catch((error) => {
          console.log(error)
          console.log(error.response.data.data)
          const errorObj = error.response.data.data;

        });
    }
  }
};
</script>

<style>
</style>
