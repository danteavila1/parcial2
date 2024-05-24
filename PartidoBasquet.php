<?php
include_once 'Partido.php';

Class PartidoBasquet extends Partido {
    private $cantInfracciones;
    private $coefPenalizacion;

	public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $coefBase, $cantInfracciones, $coefPenalizacion) {
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $coefBase);
		$this->cantInfracciones = $cantInfracciones;
		$this->coefPenalizacion = $coefPenalizacion ?? 0.75;
	}

	public function getCantInfracciones() {
		return $this->cantInfracciones;
	}

	public function setCantInfracciones($value) {
		$this->cantInfracciones = $value;
	}

	public function getCoefPenalizacion() {
		return $this->coefPenalizacion;
	}

	public function setCoefPenalizacion($value) {
		$this->coefPenalizacion = $value;
	}

    public function gestionarCoefBase(){
        $coef = parent::gestionarCoefBase();
        $coefBase = $coef - ($this->getCoefPenalizacion() * $this->getCantInfracciones());
        return $coefBase; 
    }

    public function __toString(){
        return "\n".
        parent::__toString()."\n". $this->getCantInfracciones()."\n".
        $this->getCoefPenalizacion() ."\n";
    }
}