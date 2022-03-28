console.log(document.getElementById('passwordconf'));

/*
document.getElementById('passwordconf').addEventListener
('onblur',() => {
console.log('ok');
    let pass1=document.form.password.value;
    let pass2=document.form.passwordconf.value;

    if(pass1==pass2) {
        window.alert("Les deux mots de passe sont identiques");
        return true;

       }
      
     else {

        window.alert("Vous n'avez pas saisi le meme mot de passe !");
        return false;
     }
     
    });
    */

function verif() {
    //console.log("verif");
    let pass1=document.form.password.value;
    let pass2=document.form.passwordconf.value;

    if(pass1==pass2) {
        window.alert("Les deux mots de passe sont identiques");
        return true;

       }
      
     else {

        window.alert("Vous n'avez pas saisi le meme mot de passe !");
        return false;
     }
     
}

function valid(value) {
var caractere=  /^[<,>]+$/i;
if(caractere.test(value)) {
alert('Entrez uniquement des lettres'); 
return false;
}

}

 

    

        
           
        

    



