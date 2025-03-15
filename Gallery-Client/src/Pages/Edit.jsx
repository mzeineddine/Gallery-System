// description:"aabbcc"
// id:18
// img:"http://localhost/uploads/1741825927d.jpg"
// tag:"a"
// title: "abc"
// user_id:1
import { useLocation } from 'react-router-dom';
import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom'
import {check_missing} from '../js/utils'
const Edit = () => {
    
    const location = useLocation();
    const proper = location.state;
    const base = "http://localhost/Projects/Gallery-System/";

    const [title, setTitle] = useState(proper.title);
    const [desc, setDesc] = useState(proper.description);
    const [tag, setTag] = useState(proper.tag);
    const [img, setImg] = useState(base+proper.img);
    const [img_base64, setImg_base64] = useState("");
    const [file_name, setFile_name] = useState('');
    const navigate = useNavigate();
    const delete_img =async (e)=>{
        e.preventDefault();
        if(check_missing([title,tag,desc],["title","tag","desc"]) ){
            const response = await axios.post(base+'Gallery-Server/delete_image_metadata', {
                user_id: proper.user_id,
                id: proper.id,
            });
            if(response.data.result){
                navigate("/Gallery");
            }
            console.log(img_base64);
            console.log('result:',response.data.result);
            console.log('message:', response.data.message);
        }
    };
    const update_img =async (e) => {
            e.preventDefault();
            if(check_missing([title,tag,desc],["title","tag","desc"]) ){
                const response = await axios.post(base+'Gallery-Server/update_image_metadata', {
                    user_id: proper.user_id,
                    img:img_base64,
                    title: title,
                    description:desc,
                    tag: tag,
                    id: proper.id,
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
    return(
        <>
            <div className="flex row wrap center gap">
                <div className="image settings flex column center">
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
                    <button className="settings-btn" onClick={update_img}>Save</button>
                    <button className="settings-delete-btn" onClick={delete_img}>Delete</button>
                </div>
            </div>
        </>
    );
};export default Edit;