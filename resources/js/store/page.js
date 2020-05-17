const state = {
    page: 1
}

const getters = {

    currentPage: state => state.page
}

const mutations = {

    // ページをセットする
    setPage(state,page) {
        state.page = page
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
}

