import {
    getFavoriteGames,
    getFeaturedGames,
    getGame,
    getPopularGames,
    getTopRatedGames
} from "@/scripts/util/apiWrapper.js";

export default class GameService {
    async getGame(gameId, lang){
        return await getGame(gameId, lang);
    }

    async getFeaturedGames(){
        return await getFeaturedGames();
    }

    async getFavoriteGames(){
        return await getFavoriteGames();
    }

    async getTopRatedGames(){
        return await getTopRatedGames();
    }

    async getPopularGames(){
        return await getPopularGames();
    }
}