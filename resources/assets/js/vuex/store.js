import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    // When the app starts, count is set to 0
    count: 0,
    message: 'hi',
    recordState: 'init'
}
const mutations = {
    // A mutation receives the current state as the first argument
 // You can make any modifications you want inside this function
 INCREMENT (state, amount) {
   state.count = state.count + amount
 },
 UPDATE_MESSAGE (state, message) {
    state.message = message
},
RECORD_STATE (state, value) {
     state.recordState = value
}
}
export default new Vuex.Store({
  state,
  mutations
})
