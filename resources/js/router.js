import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import ContentList from './pages/ContentList.vue'
import Signin from './pages/Signin.vue'
import Signup from './pages/Signup.vue'

// auth ストアを使用するため追加
import store from './store'

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
    component: Signin,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
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

console.log(router);

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
