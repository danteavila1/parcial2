<?php

Class Torneo {
    private $colPartidos;
    private $entregaPremios;

	public function __construct($colPartidos, $entregaPremios) {

		$this->colPartidos = $colPartidos ?? [];
		$this->entregaPremios = $entregaPremios;
	}

	public function getColPartidos() {
		return $this->colPartidos;
	}

	public function setColPartidos($value) {
		$this->colPartidos = $value;
	}

	public function getEntregaPremios() {
		return $this->entregaPremios;
	}

	public function setEntregaPremios($value) {
		$this->entregaPremios = $value;
	}

    public function retornarCadena($cadena){
        $nuevaCadena = "";
        foreach ($cadena as $valor){
            $nuevaCadena .= $valor . "\n";
        }
        return $nuevaCadena;
    }
    public function __toString(){
        return "\n". $this->retornarCadena($this->getColPartidos()) ."\n". $this->getEntregaPremios()."\n";
    }

    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipoPartido){
        $nuevoPartido = [];
        $colPartidosCopia = $this->getColPartidos();
        $categoriaE1 = $objEquipo1->getObjCategoria();
        $categoriaE2 = $objEquipo2->getObjCategoria();
        $cantJugadoresE1 = $objEquipo1->getCantJugadores();
        $cantJugadoresE2 = $objEquipo2->getCantJugadores();
        if($categoriaE1->getDescripcion()==$categoriaE2->getDescripcion() && $cantJugadoresE1 == $cantJugadoresE2){
            $idPartido = count($this->getColPartidos()) + 1;
            if($tipoPartido=='futbol'){
                $nuevoPartido = new PartidoFutbol($idPartido, $fecha, $objEquipo1, 0, $objEquipo2, 0, 0.5, 0.13, 0.19, 0.27);
                $colPartidosCopia[] = $nuevoPartido;
                $this->setColPartidos($colPartidosCopia);
            }
            if($tipoPartido=='basquetbol'){
                $nuevoPartido = new PartidoBasquet($idPartido, $fecha, $objEquipo1, 0, $objEquipo2, 0, 0.5, 0, 0.75);
                $colPartidosCopia[] = $nuevoPartido;
                $this->setColPartidos($colPartidosCopia);
            }
        }

    }

    public function darGanadores($deporte){
        $colGanadores = [];
        $colPartidosCopia = $this->getColPartidos();
        if($deporte == 'futbol'){
            for($i=0; $i<count($colPartidosCopia);$i++){
                if($colPartidosCopia[$i] instanceof PartidoFutbol) {
                    $colGanadores[] = $colPartidosCopia[$i]->darEquipoGanador();
                }
            }
        }
        if($deporte == 'basquetbol'){
            for($i=0; $i<count($colPartidosCopia);$i++){
                if($colPartidosCopia[$i] instanceof PartidoBasquet) {
                    $colGanadores[] = $colPartidosCopia[$i]->darEquipoGanador();
                }
            }
        }
        return $colGanadores;
    }

    public function calcularPremioPartido($objPartido){
        $arregloAsociativo = [];
        if($objPartido instanceof PartidoFutbol){
            $equipoGanador = $objPartido->darEquipoGanador();
            $premioPartido = $objPartido->gestionarCoefBase() * $this->getEntregaPremios();
        }
        if($objPartido instanceof PartidoBasquet){
            $equipoGanador = $objPartido->darEquipoGanador();
            $premioPartido = $objPartido->gestionarCoefBase() * $this->getEntregaPremios();
        }

        $arregloAsociativo = [
            'equipoGanador' => $equipoGanador,
            'premioPartido' => $premioPartido
        ];
        return $arregloAsociativo;
    }


}