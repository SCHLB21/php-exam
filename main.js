function radio(id){
    let element = document.getElementById('theme'+id);
    console.log(element.value)
    if(element.value=='radio'){
        element.insertAdjacentHTML("afterEnd", "<input type='number'>");
    }
}
