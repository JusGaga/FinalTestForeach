import React, {useEffect, useState} from "react";

import jwtDecode from "jwt-decode";

import {toast} from "react-toastify";
import GladiatorAPI from "../Services/GladiatorAPI";
import {useParams} from "react-router";
import CardGlad from "../Components/CardGlad";

import image from "../assets/glad.png"

const Gladiator = () => {
  const [glad, setGlad] = useState([]);
  const [loading, setLoading] = useState(true);
  const {id} = useParams()

  const fetchGlad = async () => {
    let token = window.localStorage.getItem("authToken");
    try {
      const {id:user_id} = jwtDecode(token)
      console.log(user_id)
      const data = await GladiatorAPI.findAllGlad(user_id,id);
      console.log(data);
      setGlad(data);
      setLoading(false);
    } catch (error) {
      toast.error("Impossible de charger les clients");
    }
  }

  useEffect(() => {
    fetchGlad().then(r=>'r');
  }, []);

  console.log(id)
  return (
    <>
      <div className={"d-flex flex-wrap justify-content-center"}>
      {glad.map(a =>
      <CardGlad key={a.id} Nom={a.Nom} adresse={a.adresse} equilibre={a.equilibre} strat={a.Strat} force={a.Strenght} vitesse={a.vitesse} entrainer={a.entrainer} id={a.id} image={image}/>
      )}
      </div>
    </>
  );
};

export default Gladiator;
