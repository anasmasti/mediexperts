
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import { store } from './store';
import VueToastr from 'vue-toastr';

require('./bootstrap');

const Vue = require('vue');

Vue.use(require('vue-moment'));
Vue.use(VueToastr);
// import Model1 from './components/Model1.vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('print-button', require('../js/components/PrintButton.vue').default);
Vue.component('model-1', require('../js/components/Model1.vue').default);
Vue.component('model-3', require('../js/components/Model3.vue').default);
Vue.component('plan-formation', require('../js/components/PlanFormation.vue').default);
Vue.component('avis-affichage', require('../js/components/AvisAffichage.vue').default);
Vue.component('att-reference-plan', require('../js/components/AttReferencePlan.vue').default);
Vue.component('att-ref-formation', require('../js/components/AttRefFormation.vue').default);
Vue.component('avis-modification', require('../js/components/AvisModification.vue').default);
Vue.component('print-g6', require('../js/components/G6.vue').default);
Vue.component('List', require('../js/components/DRB_OFPPT/List.vue').default);
Vue.component('Edit', require('../js/components/DRB_OFPPT/Edit.vue').default);
Vue.component('Détail', require('../js/components/DRB_OFPPT/Détail.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.onload = () => {
const app = new Vue({
  el: '#app',
  store,
  });
}
