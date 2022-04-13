import React, {useState} from 'react';
import Field from "../Components/Field";
import {toast} from "react-toastify";
import {useNavigate} from "react-router";

import coins from "../assets/Piece.png";
import Ludi_API from "../Services/Ludi_API";

const Buy = () => {

    const navigate = useNavigate();

    const [credentials,setCredentials] = useState({
        "Nom":"",
        "Spe":""
    });

    const [error,setError] = useState("");

    const handleChange = ({currentTarget}) =>{
        const {value,name} = currentTarget;
        setCredentials({...credentials,[name]: value});
    }

    const handleSubmit = async (event) => {
        event.preventDefault();
        try{
            await Ludi_API.createLudi(credentials);
            await
            setError("");
            navigate("/Ludis");
        }catch (error){
            setError("Les informations ne sont pas correctes");
            toast.error("Une Erreur est survenue");
        }
    }

    return (
        <>
            <div className={"ContainerLogin"}>
                <div className={"BackgroundContainer"}>
            <form onSubmit={handleSubmit} className=" d-flex flex-column justify-content-center ">

                <Field
                    label="Nom du ludi"
                    name="Nom"
                    value={credentials.Nom}
                    onChange={handleChange}
                    placeholder="Entrez ici le nom du ludi"
                    error={error}


                />
                <label>Choisir la spécialité du ludi</label>
                <select onChange={handleChange} value={credentials.Spe} className={"form-control"}>
                    <option value="1">Course de char</option>
                    <option value="2">Lutte</option>
                    <option value="3">Atlhétisme</option>
                </select>


                <div className="form-group d-flex justify-content-end mt-4">
                    <button type="submit" className="btn btn-outline-success col-2">
                        <img src={coins} alt={"Coins"} style={{width:"25%"}}/>
                        <span style={{color:"red",marginLeft:"1em"}}>-60</span>
                    </button>
                </div>
            </form>
                </div>
            </div>
        </>
    );
};

export default Buy;