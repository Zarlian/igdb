import { defineStore } from 'pinia'

export const useLoggedInUserStore = defineStore({
    id: 'loggedInUser',
    state: () => ({
        user: null
    }),
    getters: {
        getUser() {
            return this.user;
        },
        isAdmin() {
            return this.user && this.user.role === 'admin';
        }
    },
    actions: {
        setUser(userData) {
            this.user = userData;
        },
        clearUser() {
            this.user = null;
        }
    }
});