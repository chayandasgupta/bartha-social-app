// import Alpine from 'alpinejs';
// import { createApp } from 'vue';
// import './bootstrap';
// import PostComponent from './components/NewsFeed.vue';
// window.Alpine = Alpine;
// Alpine.start();
// createApp(PostComponent).mount("#newsfeed")
import './bootstrap';

import Alpine from 'alpinejs';

import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h } from 'vue';

window.Alpine = Alpine;
Alpine.start();

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})