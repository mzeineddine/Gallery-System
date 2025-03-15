import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom'
import {check_missing, check_email} from '../js/utils'
const Login = () => {
    const base = "http://localhost/Projects/Gallery-System/";
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();
    // sessionStorage.clear();
    const login = async (e) => {
        e.preventDefault();
        if(check_missing([email,password],["email", "password"]) && check_email(email)){
            const response = await axios.post(base+'Gallery-Server/login', {
                email: email,
                pass : password
            });
            if(response.data.result){
                sessionStorage.setItem('user_id',response.data.result);
                console.log(sessionStorage.getItem("user_id"))
                navigate("/Gallery");
            }
            console.log('message:', response.data.message);
            setEmail("");
            setPassword("");
        }
    };

    const navigate_to_signup = ()=>{
        navigate("/signup");
    }

    onload=()=>{
        if(sessionStorage.hasOwnProperty("user_id")){
            navigate("/Gallery");
        }
    }
    return(
        <div className="flex row center height100vh">
            <div className="main flex column center">
                <div className="width100 flex center wrap">
                    <p className="name">Gallery System</p>
                </div>
                <div className="action flex column center item-start height50">
                    <h2 className="form-title">Log in</h2>
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
                        onClick={login}
                    >
                        Login
                    </button>

                    <p>Don't have an account? <a onClick={navigate_to_signup}>signup</a></p>
                </div>
            </div>
        </div>
    );
}
export default Login