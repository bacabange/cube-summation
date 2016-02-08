<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ConfigRequest;
use Cube\Repositories\CuboRepo;

class CubeController extends Controller
{

	public function index()
	{
		session()->pull('matriz');
		session()->put('cantidad', 0);

		return view('aplication.index');
	}

	public function postConfig(ConfigRequest $request)
	{
        // inicializar el cubo
		$cubo = new CuboRepo($request->get('size'), $request->get('cant'));
		return response()->json($cubo->save());
	}

	public function postCommand(Request $request)
	{
		$command = explode(' ', strtoupper($request->get('command')));
		$repo = CuboRepo::getCubo();

		// si el cubo no ha sido configurado
		if (count($repo) < 1) {
			return response()->json(['error' => 'El cubo no ha sido configurado'], 500);
		}

		// actualizar cubo
		if ($command[0] == 'UPDATE') {
			// si el comando de actualizacion esta mal escrito
			if (count($command) != 5) {
				return response()->json(['error' => 'Error en la sintaxis del comando UPDATE [UPDATE x y z value]'], 500);
			}

			// si alguna de las coordenadas es 0 o menor
			if ($command[1] < 1 || $command[2] < 1 || $command[3] < 1) {
				return response()->json(['error' => 'x, y y z deben ser valores mayores a 0'], 500);
			}

			// validar que las coordenadas no sean mayores al tamaño de la matriz
			if ($command[1] > $repo->getModel()->getSize() || $command[2] > $repo->getModel()->getSize() || $command[3] > $repo->getModel()->getSize()) {
				return response()->json(['error' => 'Los valores de las coordenadas son mayores al tamaño de la matriz'], 500);
			}

			// Actualizar matriz
			$repo->update($command[1] - 1, $command[2] - 1, $command[3] - 1, $command[4]);

			return response()->json([
				'error' => false, 
				'type' => 'update', 
				'data' => $request->get('command'), 
				'cantidad' => $repo->getCantidad(), 
				'cant_permitida' => $repo->getModel()->getCant()
			]);

		}elseif ($command[0] == 'QUERY') {
			// si el comando de actualizacion esta mal escrito
			if (count($command) != 7) {
				return response()->json(['error' => 'Error en la sintaxis del comando QUERY [QUERY x1 y1 z1 x2 y2 z2 ]'], 500);
			}
			$x1 = $command[1];
			$y1 = $command[2];
			$z1 = $command[3];

			$x2 = $command[4];
			$y2 = $command[5];
			$z2 = $command[6];

			// verificar si el rango es valido
			if ($x1-1 > $x2-1 || $y1-1 > $y2-1 || $z1-1 > $z2-1) {
				return response()->json(['error' => 'El rango de la consulta no es valido'], 500);
			}

			return response()->json([
				'error' => false, 
				'type' => 'query', 
				'data' => [
					'total' => $repo->query($x1-1, $y1-1, $z1-1, $x2-1, $y2-1, $z2-1),
					'command' => $request->get('command')
					], 
				'cantidad' => $repo->getCantidad(), 
				'cant_permitida' => $repo->getModel()->getCant()
			]);

		}else{
			return response()->json(['error' => 'Comando no válido'], 500);
		}
	}
}
