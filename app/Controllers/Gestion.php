<?php namespace App\Controllers;

Use App\Models\PersonasModel;
Use App\Models\Roles_DetalleModel;
Use App\Models\Gestion_UsuariosModel;
Use App\Models\InstitutosModel;
Use App\Models\Gestion_CarrerasModel;

class gestion extends BaseController
{
	protected $session, $personas, $gestion_usuarios, $institutos, $gestion_carreras, $detalle;
	
	public function __construct()
	{
		$this->session = session();
		$this->personas = new PersonasModel();
		$this->gestion_usuarios = new Gestion_UsuariosModel();
		$this->institutos = new InstitutosModel();
		$this->gestion_carreras = new Gestion_CarrerasModel();
		$this->detalle = new Roles_DetalleModel();
	}

    // TABLERO INSTITUTOS
	public function index($id)
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

		$vID=openssl_decrypt(base64_decode($id),'AES-128-ECB',$this->session->user_id);
		$ies=$this->institutos->where('id', $vID)->first();
		$permiso=$this->gestion_usuarios
		->where('id_persona', $this->session->user_id)
		->where('id_instituto', $vID)
		->first();

		// Verificamos que el ID del instituto exista
		if (!empty($ies)) {
				// Verificamos que el usuario tenga permiso para acceder al IES
				if (!empty($permiso)) {
					$this->session->set('user_ies', $vID);
					$this->session->set('user_rol', $permiso['user_rol']);
					$data=['vDATOS' => $ies];
					echo view('header');
					echo view('home_gestion',$data);
					echo view('footer');
				} else {
					$this->session->set('user_ies', 0);
					echo view('header');
					echo view('acceso');
					echo view('footer');     
				}				
		} else {
			$this->session->set('user_ies', 0);
			$data=['vTITULO' => 'Instituto no encontrado <br> Comuníquese con el Administrador'];
			echo view('header');
			echo view('/error', $data);
			echo view('footer');     
		}		
	}

    // Autocompletado de Nombre de Persona
    public function buscar_persona_json()
    {
        $returnData=array();
        $valor=$this->request->getGet('term');
        $persona=$this->personas
        ->like('user_apellido', $valor)
        ->orlike('user_nombres', $valor)
        ->orlike('user_dni', $valor)
        ->findAll();
        if(!empty($persona)){
            foreach($persona as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['user_apellido'] . ' ' . $row['user_nombres'] . ' - ' . $row['user_dni'] . ' - ' . $row['user_email'];
                array_push($returnData, $data);
            }
        }
        echo json_encode($returnData);
    }   

	// Listado de Carreras en el IES
    public function carreras_ies()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

		$ies=$this->institutos->find($this->session->user_ies);
        $carreras=$this->gestion_carreras
		->where('id_instituto',$this->session->user_ies)
		->join('carreras', 'carreras.id = gestion_carreras.id_carrera')
		->findAll();
        $data=['vTITULO' => 'Lista General de Carreras', 'vDATOS' => $carreras, 'vIES' => $ies];

		echo view('header');
		echo view('carreras/carreras_ies',$data);
		echo view('footer');
    }

}
