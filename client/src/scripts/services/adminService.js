import {
    createContent,
    createGame, deleteContent,
    deleteGame, editContent,
    getAdminGame, getContent,
    getDevelopers, getGames, getGenres,
    getPlatforms,
    goToPage, searchContent, searchGames, toggleGameFeatured,
    updateGame
} from "@/scripts/util/apiWrapper.js";

export default class AdminGameService {

    async getGame(id) {
        return await getAdminGame(id);
    }

    async getGames() {
        return await getGames();
    }

    async deleteGame(id) {
        return await deleteGame(id);
    }

    async updateGame(id) {
        return await updateGame(id)
    }

    async createGame(game) {
        return await createGame(game)
    }

    async getGenres() {
        return await getGenres();
    }

    async getPlatforms() {
        return await getPlatforms();
    }

    async getDevelopers() {
        return await getDevelopers();
    }

    async getContent(name) {
        return await getContent(name);
    }

    async toggleFeatured(id) {
        return await toggleGameFeatured(id);
    }

    async deleteContent(name, id) {
        return await deleteContent(name, id);
    }

    async goToPage(url){
        return await goToPage(url);
    }

    async searchGames(searchParam){
        return await searchGames(searchParam);
    }

    async editContent(name, itemId, content){
        return await editContent(name, itemId, content);
    }

    async createContent(name, content){
        return await createContent(name, content);
    }

    async searchContent(name, searchParam) {
        return await searchContent(name, searchParam);
    }
}