import Vue from 'vue'
// ルーティングの定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'
// Vuetifyをインポートする
import vuetify from './plugins/vuetify'
// Vuex用ストアをインポートする
import store from './store'

import 'vuetify/dist/vuetify.min.css'

new Vue({
  vuetify,  // Vuetifyを読み込む
  el: '#app',
  router, // ルーティングの定義を読み込む
  store,  // Vuexのストアを読み込む
  components: { App }, // ルートコンポーネントの使用を宣言する
  template: '<App />' // ルートコンポーネントを描画する
})
