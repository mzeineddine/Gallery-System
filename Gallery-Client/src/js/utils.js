export function alert_message(message){
    alert(message);
    return false;
}

export function check_missing(data, args){
    let is_checkable = true;
    for(let i=0; i<args.length;i++){
        if(data[i]==''){
            return alert_message(args[i]+" is missing");
        }
    }
    return is_checkable;
}
export function reset_fields_by_id(args){
    for(let i = 0; i<args.length;i++){
        document.getElementById(args[i]).value = "";
    }
}
export function check_email(email){
    const email_regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(!email.match(email_regex)){
        return alert_message("Invalid email address");
    }return true;
}
