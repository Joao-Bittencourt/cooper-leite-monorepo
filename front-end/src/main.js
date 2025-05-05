import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import ContentHeader from './components/ContentHeader.vue'
import Content from './components/Content.vue'
import * as Sentry from "@sentry/vue";

const app = createApp(App)

Sentry.init({
    app,
    dsn: "https://6778d42769e09f7e18ab7220f777e66e@o4506315473027072.ingest.us.sentry.io/4509260276760576",
    // Setting this option to true will send default PII data to Sentry.
    // For example, automatic IP address collection on events
    sendDefaultPii: true
});
app.component('content-header', ContentHeader).component('content', Content)

app.use(router)

app.mount('#app')
