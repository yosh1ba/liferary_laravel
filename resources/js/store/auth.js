import axios from 'axios';

const state = {
  user: null
}

const getters = {}

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

  async signout(context, data){
    const response = await axios.post('/api/signout', data)
    context.commit('setUser',null)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
