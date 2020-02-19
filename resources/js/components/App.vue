<template>
  <div class="h-screen bg-gray-900 text-white">
    <div class="flex flex-col">
      <div class="bg-purple-500 px-16 py-4 w-full">
        <div class="flex justify-between">
          <p class="text-white">Movies</p>
          <p class="rounded-lg shadow p-2 bg-purple-700">Add a Movie</p>
        </div>
      </div>
      <div class="flex w-full px-16 py-4">
        <div class="w-1/6">
          <div class="h-48 w-32">
            <img src="/images/default.png" />
          </div>
          <div>
            <p class="text-lg">Movie Title</p>
            <p class="text-gray-500 text-sm">Drama, Thriller</p>
          </div>
        </div>
        <div class="w-2/6">
          <p>Save a New Movie</p>
          <div>
            <div class="my-4">
              <p class="block text-gray-300 text-sm font-bold mb-2">Movie Title</p>
              <div class="flex">
                <input
                  class="shadow appearance-none w-full h-10 border bg-gray-200 rounded py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="Movie Title"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
