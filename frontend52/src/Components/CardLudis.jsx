import React from 'react';
import {Link} from "react-router-dom";

const CardLudis = ({titles, images, nombreglad, spe, id}) => {
    return (
        <>
            <div className="card" style={{width: "18rem",margin:"2em"}}>
                <img className="card-img-top" src={images} alt="Card image cap"/>
                    <div className="card-body">
                        <h5 className="card-title">{titles}</h5>
                        <p className="card-text">{nombreglad}</p>
                        <p className="card-text">{spe}</p>
                        <Link to={id +'/gladiateurs'}  className="btn btn-primary">Voir les gladiateurs</Link>
                    </div>
            </div>
        </>
    );
};

export default CardLudis;