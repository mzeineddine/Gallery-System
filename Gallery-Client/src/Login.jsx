import React, { useState } from 'react';
import axios from 'axios';
import {check_missing, check_email} from './js/utils'
const Login = () => {
    const base = "http://localhost/Projects/Gallery-System/";
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const login = async (e) => {
        e.preventDefault();
        if(check_missing([email,password],["email", "password"]) && check_email(email)){
            const response = await axios.post(base+'Gallery-Server/apis/v1/login.php', {
                email: email,
                pass : password
            });
            console.log('message:', response.data.message);
            sessionStorage.setItem('user_id', response.data.result);
            setEmail("");
            setPassword("");
        }
    };
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

                    <p>Don't have an account? <a href="./signup">register</a></p>
                </div>
            </div>
        </div>
    );
}
export default Login