import UIkit from 'uikit'
import Icons from 'uikit/dist/js/uikit-icons'
import Vue from 'vue'
import VueResource from 'vue-resource'
import '../../components/components'
import './../less/danelli.less'
import VeeValidate from 'vee-validate'
import StarRating from 'vue-star-rating'

Vue.use(VueResource)

Vue.use(VeeValidate);

Vue.component('star-rating', StarRating);

Vue.prototype.$bus = new Vue();
Vue.http.options.emulateJSON = true
new Vue().$mount('#danelli')
UIkit.use(Icons)
