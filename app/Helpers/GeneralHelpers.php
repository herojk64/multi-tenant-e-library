<?php


function hasAbility($ability):bool{
    if(!auth()){
        return false;
    }

    if(!in_array($ability,auth()->user()->abilities)){
        return false;
    }
    return true;
}
