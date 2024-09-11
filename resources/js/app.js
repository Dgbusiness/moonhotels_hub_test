import './bootstrap';
import { createApp } from 'vue';
import Sample from './components/Sample.vue'


const app = createApp({
    components: {
        Sample,
    }
})


app.mount("#app")
