import "./App.css";
import AuthApi from "./Services/AuthApi";
import AuthContext from "./Contexts/AuthContext";
import {BrowserRouter} from "react-router-dom";
import {useState} from "react";
import {Route, Routes} from "react-router";
import Navbar from "./Components/Navbar";
import Login from "./Pages/Login";
import Home from "./Pages/Home";
import Ludis from "./Pages/Ludis";
import Gladiator from "./Pages/Gladiator";
import Buy from "./Pages/Buy";

const App = () => {
  const [isAuthenticated,setIsAuthenticated] = useState(
    AuthApi.isAuthenticated()
  );
  return (
    <>
    <AuthContext.Provider value={{
      isAuthenticated,setIsAuthenticated
    }}>
      <BrowserRouter>
        <Navbar/>
        <div>
          <Routes>
            {!isAuthenticated && <Route exact path="/login" element={<Login/>}/>}
            <Route exact path="/" element={<Home/>}/>
            <Route exact path="/ludis" element={<Ludis/>}/>
            <Route exact path="/ludis/:id/gladiateurs" element={<Gladiator/>}/>
            <Route exact path="/ludis/buy" element={<Buy/>}/>

          </Routes>
        </div>

      </BrowserRouter>
    </AuthContext.Provider>
    </>
  );
}

export default App;
