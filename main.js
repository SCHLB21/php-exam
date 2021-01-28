function radio(id){
    let element = document.getElementById('theme'+id);
    console.log(element)
    if(element.value=='radio'){
        element.innerHTML=element+'<input type="number">';
    }
}
