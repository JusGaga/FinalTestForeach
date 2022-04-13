import React, {useEffect, useState} from "react";
import jwtDecode from "jwt-decode";
import {toast} from "react-toastify";
import Ludi_API from "../Services/Ludi_API";
import CardLudis from "../Components/CardLudis";
import imagesludis from "../assets/Voxel-Home-in-Ancient-Greece.jpg"
import coins from "../assets/Piece.png"
import {Link} from "react-router-dom";

const Ludis = () => {
  const [ludis, setLudis] = useState([]);
  const [loading, setLoading] = useState(true);

  const fetchLudis = async () => {
    let token = window.localStorage.getItem("authToken");
    try {
      const {id:id} = jwtDecode(token)
      console.log(id)
      const data = await Ludi_API.findAllLudis(id);
      console.log(data);
      setLudis(data);
      setLoading(false);
    } catch (error) {
      toast.error("Impossible de charger les clients");
    }
  }

  useEffect(() => {
    fetchLudis().then(r=>'r');
  }, []);




  return (
    <>



      <div className={"container d-flex flex-wrap"}>
        {ludis.map(ludi=>
        <CardLudis key={ludi.id} titles={ludi.Nom} images={imagesludis} nombreglad={0} spe={ludi.Spe} id={ludi.id}/>
        )}
      </div>
      <div className={"d-flex justify-content-center"}>
        <Link to={"/ludis/buy"} className={"btn btn-outline-success d-flex align-items-center justify-content-center"}>
          <img src={coins} style={{width:"10%"}} alt="coins"/>
          <span style={{color:"red",marginLeft:"1em"}}>-60</span>
          <span className={"mx-2"}>Construire un ludi</span>
        </Link>
      </div>
    </>
  );
};

export default Ludis;
