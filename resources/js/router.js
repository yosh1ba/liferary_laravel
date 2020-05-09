import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import ContentList from './pages/ContentList.vue'
import Signin from './pages/Signin.vue'
import Register from "./pages/Register.vue"

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
    {
        path: '/',
        component: ContentList
    },
    {
        path: '/signin',
        component: Signin
    },
    {
      path: '/register',
      component: Register
    }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',  // 追記
    routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
