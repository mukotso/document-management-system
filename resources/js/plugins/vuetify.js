// import Vue from 'vue'
// import Vuetify, {
//     VApp,
//     VAppBar,
//     VNavigationDrawer,
//     VToolbar,
//     VContainer,
//     VContent
// } from 'vuetify/lib'
//
// Vue.use(Vuetify, {
//     components: {
//         VApp,
//         VAppBar,
//         VNavigationDrawer,
//         VToolbar,
//         VContainer,
//         VContent
//     },
// })
//
// const opts = {}
//
// export default new Vuetify(opts)


import Vue from 'vue'
import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.css'
import '@mdi/font/css/materialdesignicons.css'
Vue.use(Vuetify)

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: '#3f51b5',
                secondary: '#696969',
                accent: '#8c9eff',
                error: '#b71c1c',
            },
        },
    },
})
