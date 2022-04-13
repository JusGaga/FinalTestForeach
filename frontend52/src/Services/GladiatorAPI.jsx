import axios from "axios";
import {GLAD_API, PHYSICAL_TRAIN_API, TACTIQUE_TRAIN_API, COMBINE_TRAIN_API, USERS_API} from "./Config";

async function findAll(){
    return axios.get(GLAD_API).then(response =>response.data["hydra:member"]);
}

async function find(id){
    return axios.get(GLAD_API + "/" + id).then(response => response.data);
}

function deleteGladiator(id) {
    return axios.delete(GLAD_API + "/" + id).then(async response => {
        return response;
    });
}

function updateGladiator(id, glad) {
    return axios.put(GLAD_API + "/" + id, glad).then(async response => {
        return response;
    });
}

function createGladiator(glad) {
    return axios.post(GLAD_API, glad).then(async response => {
        return response;
    });
}

function PhysicalTrain(id){
    return axios.post(PHYSICAL_TRAIN_API+"/"+id).then(async response => {
        return response;
    })
}
function TactiqueTrain(id){
    return axios.post(TACTIQUE_TRAIN_API+"/"+id).then(async response => {
        return response;
    })
}
function CombineTrain(id){
    return axios.post(COMBINE_TRAIN_API+"/"+id).then(async response => {
        return response;
    })
}


async function findAllGlad(user_id,ludi_id){
    return axios.get(USERS_API + "/" + user_id +"/ludis/"+ludi_id+"/gladiateurs").then(response =>response.data["hydra:member"]);
}

export default {
    findAll,
    find,
    createGladiator,
    updateGladiator,
    delete: deleteGladiator,
    CombineTrain,
    TactiqueTrain,
    PhysicalTrain,
    findAllGlad
};

