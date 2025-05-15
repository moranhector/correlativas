<?php namespace App\Controllers;

Use App\Models\PersonasModel;
Use App\Models\Gestion_UsuariosModel;
Use App\Models\InstitutosModel;

class home extends BaseController
{
	protected $session, $personas, $institutos, $gestion_usuarios;
	
	public function __construct()
	{
		$this->session = session();
		$this->personas = new PersonasModel();
		$this->gestion_usuarios = new Gestion_UsuariosModel();
		$this->institutos = new InstitutosModel();
	}

    // Home Gestion General
	public function index()
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		$persona=$this->personas->where('user_email', $this->session->user_email)->first();
		
		// Revisamos si es ADMIN en algun IES
		$ies=$this->gestion_usuarios
		->join('institutos', 'institutos.id = gestion_usuarios.id_instituto')
		->where('id_persona',$this->session->user_id)
		->orderBy('id_instituto','asc')
		->findAll();

        $data=['vDATOS' => $persona, 'vIES' => $ies];

		echo view('header');
		echo view('home',$data);
		echo view('footer');
	}

	// Ayuda
	public function ayuda()
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

		echo view('header');
		echo view('ayuda');
		echo view('footer');
	}
}
