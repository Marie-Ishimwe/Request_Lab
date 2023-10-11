function password_validate(){
    var pass = document.getElementById('password');
    var upper = document.getElementById('upper');
    var lower = document.getElementById('lower');
    var num = document.getElementById('number');
    var len= document.getElementById('length');

    // checking if the password contains any number
    if(pass.value.match(/[0-9]/))
    {
        num.style.color = 'green'
    }
    else{
        num.style.color = 'red' 
    }

    // Checking for any upper case
    if(upper.value.match(/[A-Z]/))
    {
        upper.style.color = 'green'
    }
    else{
        upper.style.color = 'red' 
    } 
    // Checking for any lower char
    if(lower.value.match(/[a-z]/))
    {
        lower.style.color = 'green'
    }
    else{
        lower.style.color = 'red' 
    } 
    // Checking the length of the password
    if(pass.value.length < 8)
    {
        len.style.color = 'red'
    }
    else{
        len.style.color = 'green' 
    } 
}