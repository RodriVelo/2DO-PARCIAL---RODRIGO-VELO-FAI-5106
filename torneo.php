<?php

/* Implementar la clase Torneo que contiene la colección de partidos y un importe que será parte del
premio. Cuando un Torneo es creado la colección de partidos debe ser creada como una colección vacía */

class Torneo { 
    private $colPartidos;
    private $importePremio;

    public function __construct($importePremio){
        $this->colPartidos=[];
        $this->importePremio=$importePremio;   
    }

    
    public function getColPartidos(){
        return $this->colPartidos;
    }

    public function setColPartidos($colPartidos){
        $this->colPartidos = $colPartidos;
    }

    public function getImportePremio(){
        return $this->importePremio;
    }

 
    public function setImportePremio($importePremio){
        $this->importePremio = $importePremio;

    }


    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido){

        $jugadoresEquipo1=$OBJEquipo1->getCantJugadores();
        $jugadoresEquipo2=$OBJEquipo2->getCantJugadores();
        $categoriaEquipo1=$OBJEquipo1->getObjCategoria();
        $categoriaEquipo2=$OBJEquipo2->getObjCategoria();
        $partidos=$this->getColPartidos();

        $partido=null;

            if($categoriaEquipo1->getDescripcion() == $categoriaEquipo2->getDescripcion()){
                if($jugadoresEquipo1==$jugadoresEquipo2){
                    if ($tipoPartido=="Futbol" || $tipoPartido=="FUTBOL"){
                        $partido=new PartidoFutbol(count($partidos+1),$fecha,$OBJEquipo1,0,$OBJEquipo2,0);
                    }
                    if ($tipoPartido=="Basquetbol" || $tipoPartido=="BASQUETBOL"){
                        $partido=new PartidoBasquet(count($partidos+1),$fecha,$OBJEquipo1,0,$OBJEquipo2,0,0);
                    }
                }
            }
        
            return $partido;
    }

    public function darGanadores($deporte){

        $ganadores = [];
        $colPartidos=$this->getColPartidos();

        foreach ($colPartidos as $partido) {
                $ganador=$partido->darEquipoGanador();

            if (count($ganador)==1){

                if ($deporte == "Futbol" && $partido instanceof PartidoFutbol) {
                    $ganadores[]= $partido->darEquipoGanador();
                
                } elseif ($deporte == 'Basquetbol' && $partido instanceof PartidoBasquet) {
                    $ganadores[]=$partido->darEquipoGanador();
                }
            }

        }

    return $ganadores;
}

    public function calcularPremioPartido($objPartido){

        $coeficientePartido= $objPartido->coeficientePartido();
        $importePremio=$this->getImportePremio();
        $equipoGanador= $objPartido->darEquipoGanador();

        $premio= $coeficientePartido * $importePremio;

        $total=["equipoGanador" => $equipoGanador,
                "premioPartido" => $premio];

        return $total;
    }

    public function mostrarColeccion($coleccion){
        $cadena="";
        foreach ($coleccion as $objeto){
            $cadena.=$objeto."\n";
        }
        return $cadena;
    }

    public function __toString(){
        $cadena="\n----TORNEO-----\n";
        $cadena.="PARTIDOS: \n".$this->mostrarColeccion($this->getColPartidos())."\n";
        $cadena.="IMPORTE PREMIO: ".$this->getImportePremio();

        return $cadena;
    }
}