import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
	state: {
		user:null
	},
	getters: {
		USER: state => {
			return state.user;
		},
	},
	mutations: {
		SET_USER: (state, payload) => {
			state.user = payload;
		},
		DROP_USER: (state) => {
			state.user = null;
		},
	},
	actions: {
		SET_USER: (context, payload) => {
			context.commit('SET_USER', payload);
		},
		DROP_USER: (context) => {
			context.commit('DROP_USER');
		},
	},
});
