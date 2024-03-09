import Alpine from 'alpinejs';
import { createApp } from 'vue';
import './bootstrap';
import PostComponent from './components/NewsFeed.vue';
window.Alpine = Alpine;
Alpine.start();
createApp(PostComponent).mount("#newsfeed")