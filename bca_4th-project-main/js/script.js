function accountNumberValidate(accNo){
    var accountNumberPattern = /^[0-9]{11}$/;
    if(!accNo.match(accountNumberPattern)){
        alert("Invalid account number. Account number should be 11 digits");
        return false;
        }
        return true;
}

function passwordValidate(password){
    if(password.length < 8 || password.length >15){
        alert("Password should be between 8-15 characters long.");
        return false;
    }
    return true;
}


function pinValidate(pin){
    var patt=/^[0-9]{4}$/;
    if(!pin.match(patt)){
        alert("Enter 4 digit pin code!!");
        return false;
    }return true;
}


function matchPassword(oldPass,newPass){
    if(oldPass == newPass){
        return true;
    }else{
        alert("please match passwords");
        return false;
    }
            

}

function userIdValidate(userId){
    var patt=/^[0-9]{10}$/;
    if(!userId.match(patt)){
        alert("please enter valid user id");
        return false;
    }return true;
 }


 function addMonths(months) {
    let newDate = new Date();
    newDate.setMonth(newDate.getMonth() + parseInt(months));
    return newDate.toISOString().split('T')[0];  // Format as YYYY-MM-DD
}
