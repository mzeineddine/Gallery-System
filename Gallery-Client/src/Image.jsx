import { useNavigate } from 'react-router-dom'
const Image = ({proper}) => {
    const navigate = useNavigate();
    const navigate_to_edit = () => {
        navigate("/Edit", { state: proper });
    }
    return(
        <> 
            <div className="image" onClick={navigate_to_edit}>
                <img src={proper.img} alt="" />
            </div>
        </>
    );
}; export default Image;