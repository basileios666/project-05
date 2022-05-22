<?php
//set page title 
function getTitle(){
    global $pageTitle;
    if (isset($pageTitle)) {
        return $pageTitle;
    }
    else{
        return 'no title';
    }
}


//filter the categories (unique categories name)
function uniqueCategory($array){
    $filtered =[];
        for ($i=0; $i < count($array) - 1  ; $i++) { 
            if (!($array[$i]['category_name'] == $array[$i+1]['category_name'])) {
                array_push($filtered,$array[$i]);
            }
        };
        array_push($filtered,$array[count($array) -1]);
    return $filtered;
    }
    