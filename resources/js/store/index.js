import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from "./error"
import page from './page'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    page
  }
})

export default store
