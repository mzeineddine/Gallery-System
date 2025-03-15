const Tag = ({value, method, tag}) =>{
    
    return (<button className="tag" onClick={(e)=>{
        if(tag == value){
            method("");
            e.target.classList.remove('tag-selected')
            console.log(e.target.classList);
        }
        else {
            let bt_tags = document.querySelectorAll(".tag");
            for(let i = 0; i<bt_tags.length;i++){
                console.log(i + bt_tags[i]);
                bt_tags[i].classList.remove('tag-selected');    
            }
            e.target.classList.add('tag-selected')
            console.log(e.target.classList);
            method(e.target.textContent)
        }
    }}>{value}</button>);
}; export default Tag