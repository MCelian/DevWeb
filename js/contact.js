/*************
* Fonction qui vérifie les données du formulaire de contact * 
***************/

function checkContact(){

    var Name=['date','nom','premon','email','genre','naissance','fonction','sujet','contenu'];

    for(var i =0; i< Name.length; i++ ){
        var Data=document.getElementsByName(Name[i]);
        console.log(Data);
        

    }
}

