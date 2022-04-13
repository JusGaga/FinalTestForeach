import React, {useContext, useState} from "react";
import {useNavigate} from "react-router";
import AuthContext from "../Contexts/AuthContext";
import AuthApi from "../Services/AuthApi";
import {toast} from "react-toastify";
import Field from "../Components/Field";
import "../Scss/Login.scss"

const Login = () => {

  const navigate = useNavigate();

  const {setIsAuthenticated} = useContext(AuthContext);

  const [credentials,setCredentials] = useState({
    "username":"",
    "password":""
  });

  const [error,setError] = useState("");

  const handleChange = ({currentTarget}) =>{
    const {value,name} = currentTarget;
    setCredentials({...credentials,[name]: value});
  }

  const handleSubmit = async (event) => {
    event.preventDefault();
    try{
      await AuthApi.authenticate(credentials);
      setError("");
      setIsAuthenticated(true);
      navigate("/");
    }catch (error){
      setError("Les informations ne sont pas correctes");
      toast.error("Une Erreur est survenue");
    }
  }

  return (
    <>
      <div className={"ContainerLogin"}>
        <div className={"BackgroundContainer"}>
      <h1>Connexion</h1>

      <form onSubmit={handleSubmit} className=" d-flex flex-column justify-content-center ">
        <Field
          label="Adresse email"
          name="username"
          value={credentials.username}
          onChange={handleChange}
          placeholder="Adresse email de connexion"
          error={error}

        />

        <Field
          name="password"
          label="Mot de passe"
          value={credentials.password}
          onChange={handleChange}
          type="password"
          error=""
        />

        <div className="form-group d-flex justify-content-end mt-4">
          <button type="submit" className="btn btn-success">
            Je me connecte
          </button>
        </div>
      </form>
        </div>
      </div>
    </>
  );
};

export default Login;
