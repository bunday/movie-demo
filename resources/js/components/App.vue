<template>
  <div class="h-screen text-white">
    <div class="flex flex-col">
      <div class="bg-purple-500 px-16 py-4 w-full">
        <div class="flex justify-between">
          <router-link to="/movies" class="text-white">Movies</router-link>
          <router-link to="/movies/create" class="rounded-lg shadow p-2 bg-purple-700">Add a Movie</router-link>
        </div>
      </div>
      <div class="flex w-full px-16 py-4">
        <router-view class="p-6 overflow-x-hidden w-full"></router-view>
      </div>
    </div>
  </div>
</template>
