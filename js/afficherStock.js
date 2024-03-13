function StockAffich() {

    var stocks = document.getElementsByClassName('stock');
    for(i = 0 ; i < stocks.length ; i++) {
        console.log(stocks[i].style.visibility);
        stocks[i].style.visibility = stocks[i].style.visibility == 'hidden' ? 'visible' : 'hidden';
    }
}


/* Fonction à terminer */

function addStockCommande(i){
    var element = document.getElementsByClassName('commande');
    var stocks = document.getElementsByClassName('stock');
    var moins = document.getElementsByClassName('moins');
    var plus = document.getElementsByClassName('plus');
    if (element[i].value < stocks[i].innerHTML)
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
    var element = document.getElementsByClassName('commande');
    var stocks = document.getElementsByClassName('stock');
    var moins = document.getElementsByClassName('moins');
    var plus = document.getElementsByClassName('plus');
    if (element[i].value > 0)
    {
        element[i].value -= 1;
        if(element[i].value == 0)
            moins[i-1].style.visibility = 'hidden';
        if(element[i].value < stocks[i].innerHTML)
            plus[i-1].style.visibility = 'visible';
    }

}
