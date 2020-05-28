import axios from 'axios';
import {CREATED, OK, UNPROCESSABLE_ENTITY} from '../util'

const state = {
  user: null,
  apiStatus: null,
  loginErrorMessages: null,
  registerErrorMessages: null

}

const getters = {
  // ログイン状態の真偽値を返すゲッター
  check: state => !! state.user,

  // ユーザーIDを返すゲッター
  userid: state => state.user ? state.user.id : '',
  
  // ユーザー名を返すゲッター
  username: state => state.user ? state.user.name : ''


}

const mutations = {
  setUser(state, user){
    state.user = user
  },

  setApiStatus(state, status) {
    state.apiStatus = status
  },

  setLoginErrorMessages (state, messages) {
    state.loginErrorMessages = messages
  },

  setRegisterErrorMessages (state, messages) {
    state.registerErrorMessages = messages
  }
}

const actions = {
  // ユーザー登録
  async register(context, data){
    context.commit('setApiStatus', null)
    const response = await axios.post('/api/register', data)
    // エラーレスポンスが帰ってきた場合の処理を resources/js/bootstrap.js に記述している

    if (response.status === CREATED) {
      context.commit('setApiStatus', true)
      context.commit('setUser', response.data)
      return false
    }

    context.commit('setApiStatus', false)
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit('setRegisterErrorMessages', response.data.errors)
    } else {
      context.commit('error/setCode', response.status, { root: true })
    }
  },

  // サインイン
  async signin(context, data){
    context.commit('setApiStatus', null)
    console.log(data)
    const response = await axios.post('/api/signin', data)
    // エラーレスポンスが帰ってきた場合の処理を resources/js/bootstrap.js に記述している

    if (response.status === OK) {
      context.commit('setApiStatus', true)
      console.log(response)
      context.commit('setUser', response.data)
      return false
    }

    context.commit('setApiStatus', false)
    if (response.status === UNPROCESSABLE_ENTITY) {
      context.commit('setLoginErrorMessages', response.data.errors)
    } else {
      context.commit('error/setCode', response.status, { root: true })
    }
  },

  // ログアウト
  async signout (context) {
    context.commit('setApiStatus', null)
    const response = await axios.post('/api/signout')

    if (response.status === OK) {
      context.commit('setApiStatus', true)
      context.commit('setUser', null)
      return false
    }

    context.commit('setApiStatus', false)
    context.commit('error/setCode', response.status, { root: true })
  },

  // ログインユーザーチェック
  async currentUser (context) {
    context.commit('setApiStatus', null)
    const response = await axios.get('/api/user')
    const user = response.data || null

    if (response.status === OK) {
      context.commit('setApiStatus', true)
      context.commit('setUser', user)
      return false
    }

    context.commit('setApiStatus', false)
    context.commit('error/setCode', response.status, { root: true })
  },

  async withdraw (context) {
    console.log(context)
    context.commit('setApiStatus', null);
    const response = await axios.post('/api/withdraw',this.state.userid);

    if (response.status === OK) {
      context.commit('setApiStatus', true)
      context.commit('setUser', null)
      return false
    }
    context.commit('setApiStatus', false)
    context.commit('error/setCode', response.status, { root: true })

  }

}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
