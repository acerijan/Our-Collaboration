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




//****************************************************************************** */


function confirmTransaction(confirmTransaction){
    return confirm("Do you want to proceed?");
    
 
 }

 function emailValidate(email){
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if(email == null){
        alert("Email required");
        return false;
        }
        if(!email.match(emailPattern)){
            alert("Invalid email address");
            return false;
            }
            return true;
}
function nameValidate(name){
    if(name==null ){
        alert("Name is required");
        return false;
    }return true;
    
}





function phoneValidate(phone){
    var phonePattern = /^[0-9]{10}$/;
    if(phone == null){
        alert("Phone number required");
        return false;
        }
    if(!phone.match(phonePattern)){
        alert("Phone number invalid. Please try again.");
        return false;
    }
    return true;
}



function transactionAmountValidate(amount){
    if(amount == null){
        alert("Cannot transfer 0 amount!!! Transaction amount required");
        return false;
        }
    if(amount<=0){
        alert("Amount should be greater than 0");
        return false;
    }
    return true;
}






function dateValidate(){
    var date = prompt("Enter date in YYYY-MM-DD format");
    
    var datePattern = /^\d{4}-\d{2}-\d{2}$/;
    if(date == null){
        alert("Date required");
        return false;
        }

    if(!datePattern.test(date)){
        alert("Invalid date format. Please enter date in YYYY-MM-DD format");
        return false;
        }
        return true;
        
    var today = new Date();
    var date1 = new Date(date);
    if(date1 > today){
        alert("Date cannot be in future");
        return false;
    }return true;
}