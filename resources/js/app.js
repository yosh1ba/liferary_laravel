import './bootstrap'

import Vue from 'vue'
// ルーティングの定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'
// Vuetifyをインポートする
import vuetify from './plugins/vuetify'
// Vuex用ストアをインポートする
import store from './store'
// Veutify用cssをインポートする
import 'vuetify/dist/vuetify.min.css'
// ページネーション時にスクロールをトップに戻すためのプラグイン
import vuescrollto from './plugins/vue-scrollto'
// Vuexでルート情報を格納するためのプラグイン
import { sync } from 'vuex-router-sync'

// Vueインスタンス生成前に currentUser メソッドを呼び出す
// すでに store を import 済みのため、Vueインスタンス生成前でもアクションを dispatchメソッドで呼び出すことが可能
const createApp = async () => {
  await store.dispatch('auth/currentUser');

  new Vue({
    el: '#app',
    router, // ルーティングの定義を読み込む
    store,  // Vuexのストアを読み込む
    vuetify,  // Vuetifyを読み込む
    vuescrollto,
    components: { App }, // ルートコンポーネントの使用を宣言する
    template: '<App />' // ルートコンポーネントを描画する
  })
}

sync(store, router);

createApp();


