import { createApp } from 'vue';
import router from './router'
import { createPinia } from 'pinia'
import UserName from './components/layout/UserName.vue'
import NavigationLinks from './components/layout/NavigationLinks.vue'

require('./bootstrap');
import Alpine from 'alpinejs';

window.Alpine = Alpine;
createApp({
    components: {
        UserName,
        NavigationLinks,
    }
})
.use(createPinia())
.use(router)
.mount('#app')

Alpine.start();
