import { useState, useEffect } from "react";
import { useNavigate } from 'react-router-dom'
import axios from "axios";
import Image from './Image.jsx'
import addIcon from '../assets/add.svg';
const Gallery = () =>{
    // sessionStorage.clear();
    const navigate = useNavigate();
    const base = "http://localhost/Projects/Gallery-System/";
    const [images, setImages] = useState([]);
    const handleImageLoad = async () =>{
        if(sessionStorage.hasOwnProperty("user_id")){
            const response = await axios.post(base+'Gallery-Server/get_images_metadata', {
                user_id: sessionStorage.getItem("user_id")
            });
            if(response.data.result != false){
                setImages(response.data.result);
            }
            // console.log('message:', response.data.message);

        }else{
            navigate("/");
        }
    }

    const navigate_to_add_image = () => {
        if(sessionStorage.hasOwnProperty("user_id")){
            navigate("/Add");
        }else{
            navigate("/")
        }
    }

    const [search, setSearch] = useState("");
    
    useEffect(() => {
        handleImageLoad();
    }, []);
    return(
        <>
            <div className="search_add flex row center width100">
                <input className='search' type="search" onChange={(e)=>{setSearch(e.target.value)}}/>
                <div className="icon" onClick={navigate_to_add_image}><img src={addIcon} alt="add icon" /></div>
            </div>
            <div className="tag_filter">
            </div>
            <div className="images flex row item-start center wrap">
                {images.map((image) => {
                    let str = search.trim();
                    let match_str = new RegExp(str, "i");
                    if(match_str.test(image.title)||match_str.test(image.tag)||match_str.test(image.description)){
                        return <Image key={image.id} proper={image} />
                    }
                })}
            </div>
        </>
    );
}; export default Gallery