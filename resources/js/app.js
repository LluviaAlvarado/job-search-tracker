import { createApp, h } from "vue"
import { createInertiaApp } from "@inertiajs/vue3"
import MainLayout from "./Layouts/MainLayout.vue"
import "../css/app.css"

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob("./Pages/**/*.vue", { eager: true })
    const page =  pages[`./Pages/${name}.vue`]
    // setting main layout for all pages if no other specified
    page.default.layout = page.default.layout || MainLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})