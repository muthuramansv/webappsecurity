
function formValidation()
{
    var firstname = document.registration.firstname;
    var lastname = document.registration.lastname;
    var username = document.registration.username;
    var address = document.registration.address; //Never used?
    var passsword_1 = document.registration.password_1;
    var password_2 = document.registration.password_2;
    var email = document.registration.email;
    if(allLetter(firstname)){
        if(allLetter(lastname)) {
            if(alphanumeric(username)){
                if(userid_validation(username,5,12)){
                    if(alphanumeric(passsword_1)){
                            if(passid_validation(passsword_1,7, 12)){
                                if (ValidateEmail(email)){
                                    if (password_equal(passsword_1, password_2)) {
                                           var data = $("#formsignup").serialize();
                                           $.post("/Web_Shop/webappsecurity/Integration/Signup_handler.php",data,function (data) {
                                               alert(data);
                                           })
                                    }
                                }
                            }
                    }
                }
            }
        }

    }
 //$data == new Signup_handler();
    //$data1 = $data->data_addition(username,firstname,lastname,passsword_1,address);
   return false;
}

$("#formsignup").submit(function (e) {
    e.preventDefault();
    formValidation();
})
function userid_validation(username,mx,my)
{
    var uid_len = username.value.length;
    if (uid_len == 0 || uid_len >= my || uid_len < mx)
    {
        alert("User Id should not be empty / length be between "+mx+" to "+my);
        username.focus();
        return false;
    }
    return true;
}
function passid_validation(password_1,mx,my)
{
    var passid_len = password_1.value.length;
    if (passid_len == 0 ||passid_len >= my || passid_len < mx)
    {
        alert("Password should not be empty / length be between "+mx+" to "+my);
        password_1.focus();
        return false;
    }
    return true;
}
function allLetter(firstname)
{
    var letters = /^[A-Za-z]+$/;
    if(firstname.value.match(letters))
    {
        return true;
    }
    else
    {
        alert('Username must have alphabet characters only');
        firstname.focus();
        return false;
    }
}
function allLetter(lastname)
{
    var letters = /^[A-Za-z]+$/;
    if(lastname.value.match(letters))
    {
        return true;
    }
    else
    {
        alert('Username must have alphabet characters only');
        lastname.focus();
        return false;
    }
}
function alphanumeric(username)
{
    var letters = /^[0-9a-zA-Z]+$/;
    if(username.value.match(letters))
    {
        return true;
    }
    else
    {
        alert('User address must have alphanumeric characters only');
        username.focus();
        return true;
    }
}

function ValidateEmail(email)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.value.match(mailformat))
    {
        return true;
    }
    else
    {
        alert("You have entered an invalid email address!");
        email.focus();
        return false;
    }
}
function password_equal(password_1,password_2)
{
    if (password_1 != password_1) //Mistake??? password_1 != password_2
    {
        alert("Passwords do not match");
        password_1.focus();
        return false;
    }
    return true;
}
