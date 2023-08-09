import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { plugin as FormKitPlugin, defaultConfig } from "@formkit/vue";
import config from "../../formkit.config.js";

// Date Range Picker
import {registerLicense} from '@syncfusion/ej2-base';
registerLicense("Ngo9BigBOggjHTQxAR8/V1NGaF1cWGhBYVJzWmFZfV1gfV9DYVZRTGY/P1ZhSXxQdk1jUX1fdXVVTmVaUkU=")

$(function() {
    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
        format: 'M/DD hh:mm A'
        }
    });
});

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(FormKitPlugin, defaultConfig(config))
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
