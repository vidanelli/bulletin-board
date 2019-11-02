import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
import Vue from 'vue';
import VueResource from 'vue-resource';
import '../../components/components';
import './../less/danelli.less';
import VeeValidate from 'vee-validate';
import StarRating from 'vue-star-rating';

const page = window.page;

Vue.use(VueResource);
Vue.use(VeeValidate);

Vue.component('star-rating', StarRating);

if (page.csrf) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = page.csrf.token;
    Vue.http.headers.common['X-CSRF-TOKEN-KEY'] = page.csrf.tokenKey;
} else {
    console.error('CSRF token not found.');
}

Vue.prototype.$bus = new Vue();
Vue.http.options.emulateJSON = true;

new Vue().$mount('#danelli');

UIkit.use(Icons);
