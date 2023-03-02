<?php

namespace App\Model;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Appareil;

class FiltreObjet{

    public $nom;

    public Appareil $appareil;

    public Marque $marque;
    
    public Modele $modele;


}