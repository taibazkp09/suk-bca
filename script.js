/*const signup=document.getElementById('signup btn');
const signin=document.getElementById('signin btn');
const signinform=document.getElementById('sigin');
const signupform=document.getElementById('sigup');

signup.addEventListener('click',function(){
    signinform.style.display="none";
    signupform.style.display="block";
})
signin.addEventListener('click',function(){
    signinform.style.display="block";
    signupform.style.display="none";
})*/
const sigup =document.getElementById('signup btn');
signup.addEventListener("click",Redirect);
function Redirect(){
   window. location.href="r.html";
}