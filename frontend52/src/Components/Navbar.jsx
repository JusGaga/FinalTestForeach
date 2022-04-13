import React, {useContext, useState, useEffect} from "react";
import {Link} from "react-router-dom";
import {useNavigate} from "react-router";
import AuthContext from "../Contexts/AuthContext";
import AuthApi from "../Services/AuthApi";
import {toast} from "react-toastify";
import jwtDecode from "jwt-decode";


import coins from "../assets/Piece.png"


const Navbar = () => {
  const history = useNavigate();

  const { isAuthenticated, setIsAuthenticated } = useContext(AuthContext);



  const handleLogout = () => {
    AuthApi.logout();
    setIsAuthenticated(false);
    toast.info("Vous êtes désormais déconnecté 😁");
    history("/");
  };

  let bourse = 0

  if(isAuthenticated) {
    let token = window.localStorage.getItem("authToken");
    const {id: id, bourse: bourse} = jwtDecode(token)
  }


  return (
    <>
      <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
        <div className="w-100 d-flex justify-content-between ">
          <Link className="navbar-brand mx-2" to="/">Navbar</Link>
          <div  id="navbarNav">
            <ul className="navbar-nav">
              <li className="nav-item">
                <Link className="nav-link active" aria-current="page" to="/">Jeux du cirque</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/ludis">Mes Ludis</Link>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="/gladiateurs">Mes Gladiateurs</Link>
              </li>
            </ul>
          </div>
          <div>
            <ul className="navbar-nav">
                {!isAuthenticated &&
                    <Link to={"/login"} className={"btn btn-success mx-2"}>Se Connecter</Link>}
                {isAuthenticated && <>
                  <div className={"d-flex "}>
                    <div className="d-flex ">
                      <img src={coins} alt={"Coins"} style={{width:"10%"}}/>
                      <span className={"text-light d-flex align-items-center mx-3"}>{bourse}</span>
                    </div>
                    <button className={"btn btn-danger mx-2"} onClick={handleLogout}>Deconnexion</button>
                  </div>

                </>}
            </ul>
          </div>
        </div>
      </nav>
    </>
  );
};

export default Navbar;
