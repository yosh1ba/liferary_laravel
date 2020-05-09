import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import ContentList from './pages/ContentList.vue'
import Signin from './pages/Signin.vue'
import Signup from "./pages/Signup.vue"

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
      path: '/signup',
      component: Signup
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
