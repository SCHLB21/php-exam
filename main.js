function radio(id){
    let element = document.getElementById('theme'+id);
    console.log(element.value)
    if(element.value=='checkbox'){
        element.insertAdjacentHTML("afterEnd", "<label for='checkbox"+id+"'> Количество вариантов ответа: </label></label><input type='number' id='checkbox"+id+"'>");
    }
    if(element.value=='radio'){
        element.insertAdjacentHTML("afterEnd", "<label for='radio"+id+"'> Количество вариантов ответа: </label></label><input type='number' id='radio"+id+"'>");
    }
}
