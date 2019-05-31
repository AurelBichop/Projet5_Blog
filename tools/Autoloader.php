<?php


class Autoloader
{

    /**
     * Autoloader
     * @param $class_name
     */

    private function autoLoad($class_name){

        if(strstr($class_name,'Controleur')){
            require_once 'CONTROLLER/'.$class_name.'.php';

        }elseif (strstr($class_name,'Vue')){
            require_once 'VIEW/'.$class_name.'.php';
        }
        else{
            require_once 'MODELE/'.$class_name.'.php';
        }
    }

    public function register(){

        spl_autoload_register(['Autoloader','autoLoad']);
    }



}