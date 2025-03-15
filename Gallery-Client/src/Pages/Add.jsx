import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom'
import {check_missing} from '../js/utils'
const Add = () => {
    const base = "http://localhost/Projects/Gallery-System/";

    const [title, setTitle] = useState("");
    const [desc, setDesc] = useState("");
    const [tag, setTag] = useState("");
    const [img, setImg] = useState(null);
    const [img_base64, setImg_base64] = useState();
    const [file_name, setFile_name] = useState(null);
    const navigate = useNavigate();
    const add_img =async (e) => {
            e.preventDefault();
            if(check_missing([title,tag,desc,img_base64],["title","tag","desc","image"]) ){
                const response = await axios.post(base+'Gallery-Server/add_image_metadata', {
                    user_id: sessionStorage.getItem("user_id"),
                    img:img_base64,
                    title: title,
                    description:desc,
                    tag: tag,
                    file_name: file_name,

                });
                if(response.data.result){
                    navigate("/Gallery");
                }
                console.log(img_base64);
                console.log('result:',response.data.result);
                console.log('message:', response.data.message);
            }
        };
    const upload_file = (event) => {
        const file = event.target.files[0];
        console.log(file);
        if (file) {
            const imageURL = URL.createObjectURL(file);
            const reader = new FileReader();
            reader.onload = () =>{
                console.log(reader.result);
                setImg_base64(reader.result);
                setFile_name(file.name)
                setImg(imageURL)
            }
            reader.readAsDataURL(file);
        }
    } 
    
    console.log(sessionStorage.getItem("user_id"))
    return(
        <>
            <div className="flex row wrap center gap">
                <div className="selected-image settings flex column center">
                    <img src={img}/>
                </div>
                <div className="settings flex column center">
                    <input type="file" name="img"
                    onChange={upload_file}/>
                </div>
                <div className="settings flex column">
                    <label htmlFor="tag">Tag</label>
                    <input type="text" name="tag" placeholder="Tag" 
                        value={tag} onChange={(e) => setTag(e.target.value)}/>
                </div>
                <div className="settings flex column">
                    <label htmlFor="title">Title</label>
                    <input type="text" name="title" placeholder="Title" 
                        value={title} onChange={(e) => setTitle(e.target.value)}/>
                </div>
                <div className="settings flex column">
                    <label htmlFor="description">Description</label>
                    <input type="text" name="description" placeholder="Description" 
                        value={desc} onChange={(e) => setDesc(e.target.value)}/>
                </div>
                <div className="settings flex column">
                    <button className="settings-btn" onClick={add_img}>Save</button>
                </div>
            </div>
        </>
    );
};export default Add;