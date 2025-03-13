import { useState } from "react";
import { useNavigate } from 'react-router-dom'
import axios from "axios";
import Image from './Image.jsx'
import addIcon from './assets/add.svg';

const Gallery = () =>{
    // sessionStorage.clear();
    const navigate = useNavigate();
    const base = "http://localhost/Projects/Gallery-System/";
    const [images, setImages] = useState([]);
    console.log(images);
    const handleImageLoad = async () =>{
        if(sessionStorage.hasOwnProperty("user_id")){
            const response = await axios.post(base+'Gallery-Server/apis/v1/get_images_metadata.php', {
                user_id: sessionStorage.hasOwnProperty("user_id")
            });
            if(response.data.result != false){
                setImages(response.data.result);
            }
            console.log('message:', response.data.message);
            sessionStorage.setItem('user_id', response.data.result);

        }else{
            navigate("/");
        }
    }

    const navigate_to_add_image = () => {
        navigate("/add");
    }
    return(
        <>
            <div className="search_add flex row center width100" onLoad={handleImageLoad}>
                <input className='search' type="search" />
                <div className="icon" onClick={navigate_to_add_image}><img src={addIcon} alt="add icon" /></div>
            </div>
            <div className="tag_filter">
            </div>
            <div className="images flex row item-start center wrap">
                {images.map((image) => (
                    <Image key={image.id} proper={image} />
                ))}
            </div>
        </>
    );
}; export default Gallery