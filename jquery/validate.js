function validate()                                    
{ 
    var name = document.forms["RegForm"]["name"];               
    var email = document.forms["RegForm"]["email"];    
    var phone = document.forms["RegForm"]["phone"];  
    var address = document.forms["RegForm"]["address"];  
    var city = document.forms["RegForm"]["city"];  
    var district = document.forms["RegForm"]["district"];  
    var division = document.forms["RegForm"]["division"];  
   
    if (!name.value./^[a-zA-Z ]+$/.test(name))                                  
    { 
        window.alert("Please enter your name."); 
        name.focus(); 
        return false; 
    } 
   
    if (!address.value.match("/^[a-zA-Z ]+$/"))                               
    { 
        window.alert("Please enter your address."); 
        name.focus(); 
        return false; 
    } 
       
    if (!email.value.match("/^[w-.+]+@[a-zA-Z0-9.-]+.[a-zA-z0-9]{2,4}$/"))                                   
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
        return false; 
    } 
   
   
    if (phone.value <= 11)                           
    { 
        window.alert("Please enter your phone number."); 
        phone.focus(); 
        return false; 
    } 
   

    return true; 
}