import Vue from 'vue'
import VueRouter from 'vue-router'


// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes: [
        //今は空にしておく
    ]
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
