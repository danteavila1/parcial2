<?php
include_once 'Partido.php';

Class PartidoFutbol extends Partido {
    private $coef_menores;
    private $coef_juveniles;
    private $coef_mayores;

	public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $coefBase, $coef_menores, $coef_juveniles, $coef_mayores) {
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $coefBase);
		$this->coef_menores = $coef_menores ?? 0.13;
		$this->coef_juveniles = $coef_juveniles ?? 0.19;
		$this->coef_mayores = $coef_mayores ?? 0.27;
	}

	public function getCoef_menores() {
		return $this->coef_menores;
	}

	public function setCoef_menores($value) {
		$this->coef_menores = $value;
	}

	public function getCoef_juveniles() {
		return $this->coef_juveniles;
	}

	public function setCoef_juveniles($value) {
		$this->coef_juveniles = $value;
	}

	public function getCoef_mayores() {
		return $this->coef_mayores;
	}

	public function setCoef_mayores($value) {
		$this->coef_mayores = $value;
	}

    public function gestionarCoefBase(){
        $coef = 0;
        $cantGoles = $this->getCantGolesE1() + $this->getCantGolesE2();
        $cantJugadores = $this->getObjEquipo1()->getCantJugadores() + $this->getObjEquipo2()->getCantJugadores();
        $categoriaE1 = $this->getObjEquipo1()->getObjCategoria();
        $categoriaE2 = $this->getObjEquipo2()->getObjCategoria();
        if($categoriaE1=='menores' && $categoriaE2=='menores'){
           $coef = $this->getCoef_menores() * $cantGoles * $cantJugadores;
        }
        if($categoriaE1=='jueveniles' && $categoriaE2=='jueveniles'){
            $coef = $this->getCoef_juveniles() * $cantGoles * $cantJugadores;
        }
        if($categoriaE1=='mayores' && $categoriaE2=='mayores'){
            $coef = $this->getCoef_mayores() * $cantGoles * $cantJugadores;
        }
        return $coef;
    }

    public function __toString(){
        return "\n".
        parent::__toString()."\n". $this->getCoef_menores() ."\n".
        $this->getCoef_juveniles() ."\n". $this->getCoef_mayores()."\n";
    }
}