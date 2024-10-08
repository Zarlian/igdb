export const API_URL = "https://igdb.test/api";
export const GET_GAMES = "/games";
export const GET_GAME = "/games/{gameId}";
export const GET_ADMIN_GAME = "/admin/games/{gameId}";
export const GET_USERS = "/admin/users";
export const REGISTRATE_USER = "/register";
export const LOGIN_USER = "/login";
export const GET_PROFILE = "/profile";
export const GET_FEATURED_GAMES = "/games/featured";
export const GET_FAVORITE_GAMES = "/games/favorites";
export const GET_TOP_RATED_GAMES = "/games/top-rated";
export const GET_POPULAR_GAMES = "/games/popular"
export const LOGOUT_USER = "/logout";
export const GET_USERS_GAMELIST = "/users/{userId}/games";
export const RATE_GAME = "/users/{userId}/rate/{gameId}";
export const DELETE_GAME = "/admin/games/{gameId}";
export const UPDATE_GAME = "/admin/games/{gameId}";
export const CREATE_GAME = "/admin/games"
export const GET_GENRES = "/admin/genres";
export const GET_PLATFORMS = "/admin/platforms";
export const GET_DEVELOPERS = "/admin/developers";
export const TOGGLE_FEATURED = "/admin/games/{gameId}/toggle"
export const ADD_TO_GAMELIST = "/users/{userId}/games/{gameId}"
export const EDIT_CONTENT = "/admin/{name}/{itemId}"
export const DELETE_CONTENT = "/admin/{name}/{itemId}"
export const GET_ADMIN_CONTENT = "/admin/{name}"