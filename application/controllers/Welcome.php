<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_tienda');
	}

	public function index()
	{	
		$this->load->view('assets/header');
		$this->load->view('assets/nav_bar');
		$this->load->view('inicio');
		$this->load->view('assets/footer');
	}

	function vista(){
		$this->load->view('assets/header');
		$this->load->view('assets/nav_bar');
		$this->load->view('contacto');
		$this->load->view('assets/footer');
	}


	function logueo(){   // Despliega la vista login:  Formulario de logueo
		$this->load->view('assets/header');
		$this->load->view('assets/nav_bar');
		$this->load->view('login');
		$this->load->view('assets/footer');
		
	}

	function cancelar(){
		$this->load->view('assets/header');
		$this->load->view('assets/nav_bar');
		$this->load->view('login');
		$this->load->view('assets/footer');
	}

	function valida(){   // Valida la cuenta de usuario, si es usuario valido, agrega el nombre de usuario
		                 // a una variable de sesion (usuario), y crea otra variable de sesion con un array
		                 // (carrito) para almacenar los articulo a comprar 

		$this->form_validation->set_rules('correo', 'Correo', 'valid_email|required');	
		$this->form_validation->set_rules('clave', 'Clave', 'trim|required');	

        if ($this->form_validation->run($this) == FALSE) {
            $this->load->view('login');
        }else{
			$correo = $this->input->post('correo');
			$clave = $this->input->post('clave');
			$res = $this->m_tienda->getCliente($correo,$clave);

			if (!isset($res)){
				$this->load->view('login');
			}
}        	
        }
	

	function logout(){
		$this->session->sess_destroy();
		redirect('welcome');
	}

	function getArticulos($categoria){
		$this->session->set_userdata('categoria',$categoria);   // Almacenamos la categoria seleccionada en 
                                                                // la variable de sesion: categoria

		$articulos = $this->m_tienda->getArticulos($categoria); // Obtenemos todos los articulo de la categoria
        $data['articulos']=$articulos;

		$this->load->view('assets/header');
		$this->load->view('assets/nav_bar');
		$this->load->view('galeria',$data); // Pasamos los articulo encontrados a la vista: galeria
		$this->load->view('assets/footer');
	}

function nvoUsuario(){
		$this->load->view('assets/header');
		$this->load->view('assets/nav_bar');
		$this->load->view('registro');
		$this->load->view('assets/footer');
	}


	function newUsuario(){

		$this->form_validation->set_rules('nom', 'Nombre completo', 'required');
		$this->form_validation->set_rules('correo', 'Correo', 'valid_email|required|is_unique[clientes.Correo]');	
		$this->form_validation->set_rules('clave', 'Clave', 'trim|required|matches[confclave]');
		$this->form_validation->set_rules('confclave', 'Confirmar clave', 'required');		

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('registro');
        } else {
          
			$mail = $this->input->post('correo');
			$nomb = $this->input->post('nom');
			$cve = $this->input->post('clave');

	        $datos['Nombre']   = $nomb;
	        $datos['Correo']   = $mail;

	        // Generamos un salt aleatoreo, de 22 caracteres para Bcrypt
	        $salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);

	        // A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
			$salt = strtr($salt, array('+' => '.')); 

			// Generamos el password hash
			$datos['Password'] = crypt($cve, '$2y$10$' . $salt);
	        $this->mlogin->altaUsuario($datos);
	        $this->load->view('login',array("mensaje"=>"Usuario agregado correctamente"));
        } // fin else
	}

	function vcon(){
		$this->load->view('assets/header');
		$this->load->view('assets/nav_bar');
		$this->load->view('contacto');
		$this->load->view('assets/footer');
	}
}
