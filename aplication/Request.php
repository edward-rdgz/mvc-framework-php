<?php

/**
 * @access public
 * @author Edward Rodríguez
 * @category Request
 * @copyright Software Libre
 * @example aplication/Request.php Administra las respuestas del sistema
 * @global Clase administradora de respuestas
 * @package Request
 * @since 13/10/2015
 * @version v.1.0
 */
class Request 
{

	/**
	 * @access private
	 * @var string Inicializa el controlador
	 */
	private $_controlador;
	
	/**
	 * @access private
	 * @var string Inicializa el metodo
	 */
	private $_metodo;
	
	/**
	 * @access private
	 * @var string Inicializa los argumentos
	 */
	private $_argumentos;
	
	/**
	 * Constructor de la clase Request
	 * @access public
	 * @return string Devuelve el valor contenido
	 */
	public function __construct()
	{
	
		if (isset($_GET['url'])) 
		{
		
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			
			$url = explode("/", $url);
			
			$url = array_filter($url);
			
			$this->_controlador = strtolower(array_shift($url));
			
			$this->_metodo = strtolower(array_shift($url));
			
			$this->_argumentos = $url;
		
		}
	
		if (!$this->_controlador) 
		{
		
			$this->_controlador = DEFAULT_CONTROLLER;
		
		}
	
		if (!$this->_metodo) 
		{
		
			$this->_metodo = "index";
		
		}
	
		if (!isset($this->_argumentos))
		{
		
			$this->_argumentos = array();
		
		}
	
	}
	
	/**
	 * @access public
	 * @return string Devuelve el valor contenido
	 */
	public function getControlador()
	{
	
		return $this->_controlador;
	
	}
	
	/**
	 * @access public
	 * @return string Devuelve el valor contenido
	 */
	public function getMetodo()
	{
	
		return $this->_metodo;
	
	}
	
	/**
	 * @access public
	 * @return string Devuelve el valor contenido
	 */
	public function getArgs()
	{
	
		return $this->_argumentos;
	
	}

}