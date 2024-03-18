/* Fonction à terminer*/
function StockAffich() {
    /* Nombre d'objets restants */
    var stocks = document.getElementsByClassName('stock');
    for(i = 0 ; i < stocks.length ; i++) {
        console.log("before [" + stocks[i].style.visibility + "]");
        stocks[i].style.visibility = stocks[i].style.visibility == 'hidden' ? 'visible' : 'hidden';
        console.log("after " + stocks[i].style.visibility);
    }
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
    console.log('debut : ' + element[i].value);
    if (parseInt(element[i].value) < stocks[i].innerHTML)
    {
        element[i].value ++;

        if(element[i].value == stocks[i].innerHTML)
            plus[i-1].style.visibility= 'hidden';

        if(element[i].value > 0)
            moins[i-1].style.visibility = 'visible';
        console.log('if ' + stocks[i].innerHTML);
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
