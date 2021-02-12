import Vue from "vue";
import vmodal from 'vue-js-modal';
// window.axios = require('axios');
// window.Qs = require('qs');

Vue.use(vmodal)

Vue.component("App", require("./components/App.vue").default);

new Vue({
    el: "#cfc-vue"
});
