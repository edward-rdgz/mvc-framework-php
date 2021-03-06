<?php

/**
 * @access public
 * @author Edward Rodríguez
 * @category Bootstrap
 * @copyright Software Libre
 * @example aplication/Bootstrap.php Clase para la carga y especificacion de contenido
 * @global Clase
 * @package AppModel
 * @since 13/10/2015
 * @version v.1.0
 */
class Bootstrap
{
	/**
	 * Arranca la funcion operativa del sistema
	 * @param Request $peticion 
	 * @return none No devuelve nada
	 */
	public static function run(Request $peticion)
	{
	
		$controller = $peticion->getControlador()."Controller";
		
		$rutaControlador = ROOT."controllers".DS.$controller.".php";
		
		$metodo = $peticion->getMetodo();
		
		$args = $peticion->getArgs();
		
		/*echo "<br>".$rutaControlador;
		exit;*/
		
		if (is_readable($rutaControlador))
		{
			
			require_once $rutaControlador;
			
			$controller = new $controller;
		
			if (is_callable(array($controller, $metodo))) 
			{
			
				$metodo = $peticion->getMetodo();
			
			} 
			else 
			{
			
				$metodo = "index";
			
			}
			
			if ($metodo == "login")
			{
				
			}
			else
			{
				Authorization::logged();
			}
		
			if (isset($args))
			{
			
				call_user_func_array(array($controller, $metodo), $peticion->getArgs());
			
			}
			else
			{
			
				call_user_func(array($controller, $metodo));
			
			}
		
		} 
		else 
		{
		
			throw new Exception("Controlador no encontrado");
		
		}
	
	}

}