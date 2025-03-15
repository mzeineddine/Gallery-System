import { useNavigate } from 'react-router-dom'
const Image = ({proper}) => {
    const navigate = useNavigate();
    const navigate_to_edit = () => {
        navigate("/Edit", { state: proper });
    }
    // const base = "http://localhost/Projects/Gallery-System";
    const base = "http://13.38.107.39";


    return(
        <> 
            <div className="image" onClick={navigate_to_edit}>
                <img src={base+proper.img} alt="" />
            </div>
        </>
    );
}; export default Image;