import axios from 'axios';

const state = {
  user: null
}

const getters = {
  // ログイン状態の真偽値を返すゲッター
  check: state => !! state.user,

  // ユーザー名を返すゲッター
  username: state => state.user ? state.user : ''
}

const mutations = {
  setUser(state, user){
    state.user = user
  }
}

const actions = {
  async register(context, data){
    const response = await axios.post('/api/register', data)
    context.commit('setUser', response.data)
  },

  async signin(context, data){
    const response = await axios.post('/api/signin', data)
    context.commit('setUser', response.data)
  },

  async signout(context){
    const response = await axios.post('/api/signout')
    context.commit('setUser',null)
  },

  async currentUser(context){
    const response = await axios.get('/api/user')
    const user = response.data ? response.data : null;
    context.commit('setUser', user)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
