import {
    ADD_TO_GAMELIST,
    API_URL,
    CREATE_GAME,
    DELETE_CONTENT,
    DELETE_GAME, EDIT_CONTENT,
    GET_ADMIN_CONTENT,
    GET_ADMIN_GAME,
    GET_DEVELOPERS,
    GET_FAVORITE_GAMES,
    GET_FEATURED_GAMES,
    GET_GAME,
    GET_GAMES,
    GET_GENRES,
    GET_PLATFORMS,
    GET_POPULAR_GAMES,
    GET_PROFILE,
    GET_TOP_RATED_GAMES,
    GET_USERS,
    GET_USERS_GAMELIST,
    LOGIN_USER,
    LOGOUT_USER,
    RATE_GAME,
    REGISTRATE_USER,
    TOGGLE_FEATURED,
    UPDATE_GAME
} from "@/scripts/config/config.js";


export async function getGames(){
    const url = `${GET_GAMES}`;
    return await getFetch(url, {
        method: "GET"
    });
}

export async function searchGames(searchParam){
    const url = `${GET_GAMES}?search=${searchParam}`;
    return await getFetch(url, {
        method: "GET"
    });
}

export async function searchContent(name,searchParam){
    const url = `/admin/${name}?search=${searchParam}`;
    console.log(url)
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}
export async function getGame(gameId, lang = "en") {
    const url = `${GET_GAME}?lang=${lang}`.replace('{gameId}', gameId);
    return await getFetch(url, {
        method: "GET"
    });
}

export async function getAdminGame(gameId) {
    const url = `${GET_ADMIN_GAME}`.replace('{gameId}', gameId);
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function getFeaturedGames() {
    const url = `${GET_FEATURED_GAMES}`;
    return await getFetch(url, {
        method: "GET"
    });
}

export async function getFavoriteGames() {
    const url = `${GET_FAVORITE_GAMES}`;
    return await getFetch(url, {
        method: "GET"
    });
}

export async function getTopRatedGames() {
    const url = `${GET_TOP_RATED_GAMES}`;
    return await getFetch(url, {
        method: "GET"
    });
}

export async function getPopularGames(){
    const url = `${GET_POPULAR_GAMES}`;
    return await getFetch(url, {
        method: "GET"
    });
}

export async function getUsers() {
    const url = `${GET_USERS}`;
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function getUserGameList(userId) {
    const url = `${GET_USERS_GAMELIST}`.replace('{userId}', userId);
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function rateGame(userId, gameId, rating) {
    const url = `${RATE_GAME}`.replace('{userId}', userId).replace('{gameId}', gameId);
    const body = JSON.stringify({ rating: rating,review: ""});
    return await getFetch(url, {
        method: "POST",
        body: body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function deleteGame(gameId) {
    const url = `${DELETE_GAME}`.replace('{gameId}', gameId);
    return await getFetch(url, {
        method: "DELETE",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function updateGame(game) {
    const url = `${UPDATE_GAME}`.replace('{gameId}', game.id);
    const body = JSON.stringify(game);
    return await getFetch(url, {
        method: "PUT",
        body: body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function createGame(game){
    const url = `${CREATE_GAME}`;
    const body = JSON.stringify(game)
    return await getFetch(url, {
        method: "POST",
        body: body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function toggleGameFeatured(game) {
    const url = `${TOGGLE_FEATURED}`.replace('{gameId}', game.id);
    const body = JSON.stringify(game);
    return await getFetch(url, {
        method: "PUT",
        body: body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function registerUser(user) {
    const url = `${REGISTRATE_USER}`;
    const body = JSON.stringify(user);
    return await getFetch(url, {
        method: "POST",
        body: body,
    });
}

export async function loginUser(user) {
    const url = `${LOGIN_USER}`;
    const body = JSON.stringify(user);
    return await getFetch(url, {
        method: "POST",
        body: body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function logoutUser() {
    const url = `${LOGOUT_USER}`;
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function getProfile() {
    const url = `${GET_PROFILE}`;
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function getGenres() {
    const url = `${GET_GENRES}`;
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function getPlatforms() {
    const url = `${GET_PLATFORMS}`;
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function getDevelopers() {
    const url = `${GET_DEVELOPERS}`;
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function getContent(name){
    const url = `${GET_ADMIN_CONTENT}`.replace('{name}', name);
    return await getFetch(url, {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function editContent(name, itemId, content){
    const url = `${EDIT_CONTENT}`.replace('{name}', name).replace('{itemId}', itemId);
    const body = JSON.stringify(content);
    return await getFetch(url, {
        method: "POST",
        body : body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function createContent(name, content){
    const url = `${DELETE_CONTENT}`.replace('{name}', name);
    const body = JSON.stringify(content);
    return await getFetch(url, {
        method: "POST",
        body : body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function deleteContent(name, itemId){
    const url = `${DELETE_CONTENT}`.replace('{name}', name).replace('{itemId}', itemId);
    return await getFetch(url, {
        method: "DELETE",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}
export async function addToGameList(userId, gameId) {
    const url = `${ADD_TO_GAMELIST}`.replace('{userId}', userId).replace('{gameId}', gameId);
    const body = {}
    return await getFetch(url, {
        method: "POST",
        body : body,
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function removeFromGameList(userId, gameId){
    const url = `${ADD_TO_GAMELIST}`.replace('{userId}', userId).replace('{gameId}', gameId);
    return await getFetch(url, {
        method: "DELETE",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    });
}

export async function goToPage(url){

    //todo refactor
    const defaultHeaders = {
        'Content-Type': 'application/json',
        Accept: 'application/json',

    };

    const options = {
        method: "GET",
        credentials: "include",
        headers: {
            'credentials': 'include',
        }
    }

    const mergedOptions = {
        ...options,
        headers: {
            ...defaultHeaders,
            ...options.headers,
        },
    };

    const res = await fetch(`${url}`, mergedOptions);

    if (!res.ok) {
        throw new Error(`API request failed with status ${res.status}`);
    }

    return await res.json();
}

async function getFetch(url, options = {}) {
    const defaultHeaders = {
        'Content-Type': 'application/json',
        Accept: 'application/json',

    };

    const mergedOptions = {
        ...options,
        headers: {
            ...defaultHeaders,
            ...options.headers,
        },
    };

    const res = await fetch(`${API_URL}${url}`, mergedOptions);

    if (!res.ok) {
        throw new Error(`API request failed with status ${res.status}`);
    }

    return await res.json();
}