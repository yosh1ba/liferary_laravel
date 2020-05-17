import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import ContentList from './pages/ContentList.vue'
import Signin from './pages/Signin.vue'
import Signup from './pages/Signup.vue'
import SystemError from "./pages/errors/System.vue";
import PostDetail from './components/PostDetail.vue'

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
    path: '/posts/:id',
    component: PostDetail,
    props: true
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
  },
  {
    path: '/500',
    component: SystemError
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',  // 追記
    scrollBehavior () {
      return { x: 0, y: 0 }
    },
    routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router
