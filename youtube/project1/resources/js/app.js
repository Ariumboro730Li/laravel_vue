require('./bootstrap');

require('alpinejs');

import {createApp} from 'vue';
import router from './router/index.js';
import CompaniesIndex from "./components/companies/CompaniesIndex.vue";
import CompaniesIndex2 from "./components/companies/CompaniesIndex2.vue";

createApp({
    components: {
        CompaniesIndex,
        CompaniesIndex2,
    }
}).use(router).mount(`#app`);
