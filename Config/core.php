<?php
//initializes all components (configurations) you need


// On inclut la classe correspondante au paramètre passé.
function chargerClasse($classe)
{
  require $classe . '.php'; 
}


// On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
spl_autoload_register('chargerClasse'); 

 