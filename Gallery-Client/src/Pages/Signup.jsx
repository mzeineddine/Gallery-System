import { useState } from "react";
import { check_email, check_missing } from "../js/utils";
import { useNavigate } from 'react-router-dom'
import axios from "axios";

const Signup = ()=>{
    sessionStorage.clear();
    // const base = "http://localhost/Projects/Gallery-System/";
    const base = "http://13.38.107.39/";

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [full_name, setFull_name] = useState('');
    const navigate = useNavigate();
    const signup = async (e) => {
        e.preventDefault();
        if(check_missing([email,password],["email", "password"]) && check_email(email)){
            const response = await axios.post(base+'Gallery-Server/signup', {
                user_name: full_name,
                email: email,
                pass : password
            });
            if(response.data.result != false){
                navigate("/")
            }
            sessionStorage.setItem('user_id', response.data.result);
            setEmail("");
            setPassword("");
            setFull_name("");
        }
    };

    const navigate_to_login = ()=>{
        navigate("/");
    };
    return(
        <div className="flex row center height100vh">
            <div className="main flex column center">
                <div className="width100 flex center wrap">
                    <p className="name">Gallery System</p>
                </div>
                <div className="action flex column center item-start height50">
                    <h2 className="form-title">Sign up</h2>
                    <label htmlFor="full_name">Full Name</label>
                    <input 
                        type="text" 
                        name="full_name" 
                        id="full_name" 
                        placeholder="Full Name"
                        value={full_name}
                        onChange={(e) => setFull_name(e.target.value)}
                    />

                    <label htmlFor="email">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                    />

                    <label htmlFor="pass">Password</label>
                    <input 
                        type="password" 
                        name="pass"  
                        id="pass" 
                        placeholder="Password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                    />

                    <button 
                        id='login' 
                        onClick={signup}
                    >
                        Signup
                    </button>

                    <p>Have an account? <a onClick={navigate_to_login}>login</a></p>
                </div>
            </div>
        </div>
    );
};
export default Signup