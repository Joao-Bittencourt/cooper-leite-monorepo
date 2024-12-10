import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import ContentHeader from './components/ContentHeader.vue'
import Content from './components/Content.vue'

const app = createApp(App)

app.component('content-header', ContentHeader).component('content', Content)

app.use(router)

app.mount('#app')
