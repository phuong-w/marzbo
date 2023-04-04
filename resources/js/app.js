import { createApp, h } from 'vue'
import { createInertiaApp, usePage } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import { Acl } from '@/composables/acl'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    title: title => {
        const appName = usePage().props.appName
        return title ? `${title} | ${appName}` : appName
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .provide('Acl', Acl)
            .mount(el)
    },
})
