const API_URL = "https://localhost:8000/api/";

//Login

export const LOGIN_API = API_URL+"login_check";
    // Refresh token
export const REFRESH_TOKEN_API = API_URL+"token/refresh";

//Users

export const USERS_API = API_URL+"users";

//Gladiateurs

export const GLAD_API = API_URL+"gladiateurs";

//Training
    //Physical
export const PHYSICAL_TRAIN_API = API_URL+"training/physical/";
    //Tactique
export const TACTIQUE_TRAIN_API = API_URL+"training/tactique/";
    //Combine
export const COMBINE_TRAIN_API = API_URL+"training/combine/";

//Ludi

export const LUDI_API = API_URL+"ludis"