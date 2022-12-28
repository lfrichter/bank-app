import Vuex from 'vuex'

const store = new Vuex.Store({

    state: {
        authenticated: false,
        user: null,
        token: null,
        admin: false,
    },

    mutations: {

        initialiseStore(state) {
			if(localStorage.getItem('store')) {
				store.replaceState(
					Object.assign(state, JSON.parse(localStorage.getItem('store') as string))
				);
			}
		},

        setLogin(state, payload){
            state.authenticated = true
            state.token = payload.token
            state.user = payload.user
            state.admin = payload.admin || null
        },

        setLogoff(state, payload) {
            state.authenticated = false
            state.user = null
            state.token = null
            state.admin = false
        },
    },

    actions: {

        setLogin(context, payload): void {
            context.commit('setLogin', payload);
        },

        setLogoff(context, payload): void {
            context.commit('setLogoff', payload);
        },

    }

})

store.subscribe((mutation, state) => {
	localStorage.setItem('store', JSON.stringify(state));
});

export { store }
