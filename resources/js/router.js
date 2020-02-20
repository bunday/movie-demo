import Vue from 'vue';
import VueRouter from 'vue-router';
import MovieList from './views/MovieList.vue';
import CreateMovie from './views/CreateMovie.vue';
import MovieDetail from './views/MovieDetail.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/', component: MovieList
        },
        {
            path: '/movies', component: MovieList
        },
        {
            path: '/movies/create', component: CreateMovie
        },
        {
            path: '/movies/:slug', component: MovieDetail
        },
    ],
    mode: 'history'
})
