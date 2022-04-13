import axios from "axios";
import {USERS_API} from "./Config";

async function findAll(){
    return axios.get(USERS_API).then(response =>response.data["hydra:member"]);
}

async function find(id){
    return axios.get(USERS_API + "/" + id).then(response => response.data);
}

function deleteUser(id) {
    return axios.delete(USERS_API + "/" + id).then(async response => {
        return response;
    });
}

function updateUser(id, user) {
    return axios.put(USERS_API + "/" + id, user).then(async response => {
        return response;
    });
}

function createUser(user) {
    return axios.post(USERS_API, user).then(async response => {
        return response;
    });
}

export default {
    findAll,
    find,
    createUser,
    updateUser,
    delete: deleteUser
};

