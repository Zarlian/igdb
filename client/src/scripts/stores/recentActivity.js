import { defineStore } from 'pinia'

export const useRecentActivityStore = defineStore({
    id: 'recentActivity',
    state: () =>({
        games: []
    }),
    getters: {
        getRecentActivity() {
            return this.games;
        }
    },
    actions:{
        addActivity(game) {
            this.games.push(game);
        },
        clearActivity() {
            this.games = [];
        }
    }
});