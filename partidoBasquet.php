<?php

class PartidoBasquet extends Partido {
    private $cantidadInfracciones;
    private $coeficientePenalizacion; 

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$cantidadInfracciones){
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantidadInfracciones=$cantidadInfracciones;
        $this->coeficientePenalizacion=0.75;
    }

    public function getCantidadInfracciones(){
        return $this->cantidadInfracciones;
    }


    public function setCantidadInfracciones($cantidadInfracciones){
        $this->cantidadInfracciones = $cantidadInfracciones;

    }


    public function getCoeficientePenalizacion(){
        return $this->coeficientePenalizacion;
    }


    public function setCoeficientePenalizacion($coeficientePenalizacion){
        $this->coeficientePenalizacion = $coeficientePenalizacion;

    }

    public function coeficientePartido(){

    $coefBase = parent::coeficientePartido();

    $coefPenalizacion = $this->getCoeficientePenalizacion();
    $cantInfracciones = $this->getCantidadInfracciones();
    $penalizacion = $coefPenalizacion * $cantInfracciones;

    $coefTotal = $coefBase - $penalizacion;

    return $coefTotal;
}

    public function __toString()
    {
        $cadena="\n".parent::__toString()."\n";
        $cadena.="CANTIDAD INFRACCIONES: ".$this->getCantidadInfracciones()."\n";
        $cadena.="COEFICIENTE PENALIZACION: ".$this->getCoeficientePenalizacion();
    }
}