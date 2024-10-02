import {
    addToGameList,
    getProfile, getUserGameList,
    loginUser,
    logoutUser,
    registerUser,
    removeFromGameList
} from "@/scripts/util/apiWrapper.js";

export default class UserService {
    async  removeFromGameList(userId, gameId){
        return await removeFromGameList(userId, gameId);
    }

    async addToGameList(userId, gameId){
        return await addToGameList(userId, gameId);
    }

    async getProfile(){
        return await getProfile();
    }

    async logoutUser(){
        return await logoutUser();
    }

    async loginUser(user){
        return await loginUser(user);
    }

    async registerUser(user){
        return await registerUser(user);
    }

    async getUserGameList(userId){
        return await getUserGameList(userId);
    }
}
