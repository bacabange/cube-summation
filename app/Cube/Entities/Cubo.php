<?php 

namespace Cube\Entities;

class Cubo extends \Eloquent{

	protected $size;
	protected $cant;
	protected $matriz;

	public function __construct($size, $cant)
	{
		$this->size = $size;
		$this->cant = $cant;

		$this->initialize($size);
	}

	public function getSize()
	{
		return $this->size;
	}

	public function getCant()
	{
		return $this->cant;
	}

	public function getMatriz()
	{
		return $this->matriz;
	}

	public function setMatriz($matriz)
	{
		$this->matriz = $matriz;
	}

	/*
		Inicializar la matriz (cubo)
	*/
	public function initialize($size)
	{
		for ($x = 0; $x <= $size; $x++) {
            for ($y = 0; $y <= $size; $y++) {
                for ($z = 0; $z <= $size; $z++) {
                    $this->matriz[$x][$y][$z] = 0;
                }
            }
        }
	}

}