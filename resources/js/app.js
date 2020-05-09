import Vue from 'vue'
// ルーティングの定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'
// Vuetifyをインポートする
import vuetify from './plugins/vuetify'
import 'vuetify/dist/vuetify.min.css' // 無くても動く？

new Vue({
    vuetify,  // Vuetifyを読み込む
    el: '#app',
    router, // ルーティングの定義を読み込む
    components: { App }, // ルートコンポーネントの使用を宣言する
    template: '<App />' // ルートコンポーネントを描画する
})
