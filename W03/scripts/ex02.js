function showList() {
    const item1 = document.querySelector("#item1");
    const item2 = document.querySelector("#item2");
    const item3 = document.querySelector("#item3");
    const item4 = document.querySelector("#item4");
    const item5 = document.querySelector("#item5");

    item1.innerText = product[productNum]["itemName"];
    item2.innerText = product[productNum]["cost"];
    item3.innerText = product[productNum]["healthy"];
    item4.innerText = product[productNum]["category"];
    item5.innerText = product[productNum]["location"];
}

document.getElementById("showNext").onclick = function (){
    productNum++;
    showList();
}

document.getElementById("showPrior").onclick = function (){
    productNum--;
    showList();
}

function addItemToList(event){
    const prodList = document.querySelector("#prodList");
    const shoppingItem = document.createElement("li");
    shoppingItem.textContent = product[productNum]["itemName"];
    prodList.append(shoppingItem);
}

function init(){
    document.querySelector("#addItem").addEventListener("click",addItemToList);
    
    showList();
}

let productNum = 0;
init();