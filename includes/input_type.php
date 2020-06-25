<?php
function get_type($a){
    if($a=='number'){
        return 'type="number"';
    }elseif ($a=='positive_number'){
        return 'type="number" min="0"';
    }elseif ($a=='small_text'){
        return 'type="text" pattern="^[0-9a-zA-ZА-Яа-яЁё\s]{,30}"';
    }elseif ($a=='big_text'){
        return 'type="text" pattern="^[0-9a-zA-ZА-Яа-яЁё\s]{,30}"';
    }elseif ($a=='checkbox'){
        return 'type="checkbox"';
    }elseif ($a=='radio'){
        return 'type="radio"';
    }
}