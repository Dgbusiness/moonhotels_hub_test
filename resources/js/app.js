import 'flowbite';
import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
import Bookingrooms from './components/BookingRooms.vue'
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';


const app = createApp({
    components: {
        Bookingrooms,
    }
})
const pinia = createPinia()
app.use(pinia)

app.use(PrimeVue, {
    theme: {
        preset: Aura
    }
});

app.mount("#app")
