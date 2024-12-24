import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import ContentHeader from './components/ContentHeader.vue'
import Content from './components/Content.vue'
import * as Sentry from "@sentry/vue";

const app = createApp(App)

app.component('content-header', ContentHeader).component('content', Content)

Sentry.init({
    app,
    dsn: "https://e37dd302df32dc6d54d87d0306517466@o4506315473027072.ingest.us.sentry.io/4508520866250752",
    integrations: [
      Sentry.browserTracingIntegration({ router }),
      Sentry.replayIntegration(),
    ],
    // Tracing
    tracesSampleRate: 1.0, //  Capture 100% of the transactions
    // Set 'tracePropagationTargets' to control for which URLs distributed tracing should be enabled
    tracePropagationTargets: ["localhost", /^https:\/\/yourserver\.io\/api/],
    // Session Replay
    replaysSessionSampleRate: 0.1, // This sets the sample rate at 10%. You may want to change it to 100% while in development and then sample at a lower rate in production.
    replaysOnErrorSampleRate: 1.0, // If you're not already sampling the entire session, change the sample rate to 100% when sampling sessions where errors occur.
  });

app.use(router)

app.mount('#app')
