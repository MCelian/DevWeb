/* Fonction à terminer*/
function StockAffich() {
    /* Nombre d'objets restants */
    let stocks = document.querySelectorAll(".stock");
    for(let i = 0; i < stocks.length; i++)
        stocks[i].classList.toggle("afficherStock");
}


function addStockCommande(i){
    /* Nombre produit voulue*/
    var element = document.getElementsByClassName("commande");
    /* Nombre d'objets restants */
    var stocks = document.getElementsByClassName('stock');
    /* Décrémente le stock */
    var moins = document.getElementsByClassName('moins');
    /* Incrémente le stock */
    var plus = document.getElementsByClassName('plus');
    if (parseInt(element[i].value) < stocks[i].innerHTML)
    {
        element[i].value ++;

        if(element[i].value == stocks[i].innerHTML)
            plus[i-1].style.visibility= 'hidden';

        if(element[i].value > 0)
            moins[i-1].style.visibility = 'visible';
    }    
}

function removeStockCommande(i){
    /* Nombre produit voulue*/
    var element = document.getElementsByClassName('commande');
    /* Nombre d'objets restants */
    var stocks = document.getElementsByClassName('stock');
    /* Décrémente le stock */
    var moins = document.getElementsByClassName('moins');
    /* Incrémente le stock */
    var plus = document.getElementsByClassName('plus');
    if (element[i].value > 0)
    {
        element[i].value -= 1;
        if(element[i].value == 0)
            moins[i-1].style.visibility = 'hidden';
        if(parseInt(element[i].value) < stocks[i].innerHTML)
            plus[i-1].style.visibility = 'visible';
    }

}
