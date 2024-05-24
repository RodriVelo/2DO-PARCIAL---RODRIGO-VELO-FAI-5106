<?php

class PartidoFutbol extends Partido {
    private $coefMenores;
    private $coefJuveniles;
    private $coefMayores;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);

        $this->coefMenores=0.13;
        $this->coefJuveniles=0.19;
        $this->coefMayores=0.27;        
    }

    
    public function getCoefMenores(){
        return $this->coefMenores;
    }

    public function setCoefMenores($coefMenores){
        $this->coefMenores = $coefMenores;

    }

    public function getCoefJuveniles(){
        return $this->coefJuveniles;
    }

    public function setCoefJuveniles($coefJuveniles){
        $this->coefJuveniles = $coefJuveniles;

    }

    
    public function getCoefMayores(){
        return $this->coefMayores;
    }

    
    public function setCoefMayores($coefMayores){
        $this->coefMayores = $coefMayores;

    }

    public function coeficientePartido(){
    $coeficienteTotal = parent::coeficientePartido();

    $coeficienteMenores = $this->getCoefMenores();
    $coeficienteJuveniles = $this->getCoefJuveniles();
    $coeficienteMayores = $this->getCoefMayores();

    $categoriaEquipo1 = $this->getObjEquipo1()->getObjCategoria()->getDescripcion();
    $categoriaEquipo2 = $this->getObjEquipo2()->getObjCategoria()->getDescripcion();

    if ($categoriaEquipo1 == "Menores" && $categoriaEquipo2 == "Menores") {
        $coeficienteTotal =$coeficienteTotal*$coeficienteMenores;
    }

    if (($categoriaEquipo1 == "Juveniles" && $categoriaEquipo2 == "Juveniles")) {
        $coeficienteTotal = $coeficienteTotal*$coeficienteJuveniles;
    }

    if ($categoriaEquipo1 == "Mayores" && $categoriaEquipo2 == "Mayores") {
        $coeficienteTotal = $coeficienteTotal*$coeficienteMayores;
    }

    return $coeficienteTotal;
}



    public function __toString(){
        $cadena="\n".parent::__toString()."\n";
        $cadena.="COEFICIENTE MENORES: ".$this->getCoefMenores()."\n";
        $cadena.="COEFICIENTE jUVENILES: ".$this->getCoefJuveniles()."\n";
        $cadena.="COEFICIENTE MAYORES: ".$this->getCoefMayores()."\n";
        
    }
}