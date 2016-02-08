<?php 
// Base de los repositorios, donde se colocan funciones comunes para la consulta con bd
namespace Cube\Repositories;

use Cube\Entities\Cubo;

class CuboRepo
{
	// El modelo
	protected $cubo;

	public function __construct($size, $cant)
	{
		$this->cubo = new Cubo($size, $cant);
	}

	public function setCantidad()
	{
		session()->put('cantidad', session()->get('cantidad') + 1);
	}

	public function getCantidad()
	{
		return session()->get('cantidad');
	}

	public function getModel()
	{
		return $this->cubo;
	}

	public function save()
	{
		session()->put('matriz', $this);
		return $this;
	}

	public function update($x, $y, $z, $value)
	{
		$matriz = $this->cubo->getMatriz();
		$matriz[$x][$y][$z] = $value;
		$this->cubo->setMatriz($matriz);
		$this->setCantidad();
		$this->save();
	}

	public function query($x1, $y1, $z1, $x2, $y2, $z2)
	{
		$sum = 0;
		$matriz = $this->cubo->getMatriz();
		for ($x = $x1; $x <= $x2; $x++) {
			for ($y = $y1; $y <= $y2; $y++) {
				for ($z = $z1; $z <= $z2; $z++) {
					$sum += $matriz[$x][$y][$z];
				}
			}
		}
		$this->setCantidad();
		return $sum;
	}

	public static function getCubo()
	{
		if (session()->has('matriz')) {
			return session()->get('matriz');
		}

		return [];
	}

	public static function setCubo()
	{
		if (session()->has('matriz')) {
			return session()->get('matriz');
		}

		return [];
	}
}