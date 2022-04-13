import axios from "axios";
import {LUDI_API,USERS_API} from "./Config";

async function findAll(){
    return axios.get(LUDI_API).then(response =>response.data["hydra:member"]);
}

async function findAllLudis(id){
    return axios.get(USERS_API + "/" + id + "/ludis" ).then(response =>response.data["hydra:member"]);
}

async function find(id){
    return axios.get(LUDI_API + "/" + id).then(response => response.data);
}

function deleteLudi(id) {
    return axios.delete(LUDI_API + "/" + id).then(async response => {
        return response;
    });
}

function updateLudi(id, ludi) {
    return axios.put(LUDI_API + "/" + id, ludi).then(async response => {
        return response;
    });
}

function createLudi(ludi) {
    return axios.post(LUDI_API, ludi).then(async response => {
        return response;
    });
}

export default {
    findAll,
    findAllLudis,
    find,
    createLudi,
    updateLudi,
    delete: deleteLudi
};

