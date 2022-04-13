import React from 'react';
import {Link} from "react-router-dom";

const CardGlad = ({Nom,adresse,equilibre,strat,force,vitesse,entrainer,id,image}) => {
    return (
        <>
            <div className="card" style={{width: "18rem",margin:"2em"}}>
                <img className="card-img-top" src={image} alt="Card image cap"/>
                <div className="card-body">
                    <h5 className="card-title">{Nom}</h5>
                    <p className="card-text">{adresse}</p>
                    <p className="card-text">{equilibre}</p>
                    <p className="card-text">{strat}</p>
                    <p className="card-text">{force}</p>
                    <p className="card-text">{vitesse}</p>

                    <Link to={id +'/entrainement'}  className={`btn btn-primary ${entrainer ? "disabled" : ""}`}>Acceder au entrainement</Link>
                </div>
            </div>
        </>
    );
};

export default CardGlad;