<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PersonasModel;
use App\Models\DepartamentosModel;
use PasswordHash;

class personas extends BaseController
{
    protected $personas, $session, $categorias, $reglaslogin, $departamentos;

    public function __construct()
    {
        $this->session = session();
        $this->reglaslogin=['user'=>'required', 'pass'=>'required'];
        $this->personas= new PersonasModel();
        $this->departamentos = new DepartamentosModel();
    }

    public function index()
    {

    }

    // Editar datos personales por parte del usuario
	public function perfil()
	{
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $persona=$this->personas->find($this->session->user_id);
        $deptos=$this->departamentos->findAll();

		$data =['vTITULO' => 'Editar datos Personales', 'vPERSONA' => $persona, 'vDEPARTAMENTOS' => $deptos];

        echo view('header');
        echo view('personas/perfil', $data);
        echo view('footer');
	}

    // Actualizar datos personales por parte del usuario
    public function actualizar_perfil()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        
        $persona=$this->personas->where('id',$this->session->user_id)->first();

        if (!empty($persona)) {
            $this->personas->update($persona['id'], [
                'user_apellido' => $this->request->getPost('user_apellido'),
                'user_nombres' => $this->request->getPost('user_nombres'),
                'user_cuil' => $this->request->getPost('user_cuil'),
                'user_telefono' => $this->request->getPost('user_telefono'),
                'user_civil' => $this->request->getPost('user_civil'),
                'user_domicilio' => $this->request->getPost('user_domicilio'),
                'user_domiciliolegal' => $this->request->getPost('user_domiciliolegal'),
                'user_nacimiento' => $this->request->getPost('user_nacimiento') ?: null,
                'user_departamento_id' => $this->request->getPost('user_departamento_id'),
            ]);

            session()->setFlashdata('success', 'Datos actualizados correctamente.');
        }

        return redirect()->to(base_url().'/home');
    }

    // Login del Sistema
    public function login(){
        echo view('login');
    }

    // Validacion de Login
    public function valida(){

        if ($this->request->getMethod() == "post" && $this->validate($this->reglaslogin)){
            $user=$this->request->getPost('user');
            $pass=$this->request->getPost('pass');
            $persona=$this->personas->where('user_email', $user)->first();

            $passwordHash = new PasswordHash(8, false);

            if($persona != null){
                if ($passwordHash->CheckPassword($pass, $persona['user_pass'])) {
                    $datossesion=[
                        'user_id'=>$persona['id'],
                        'user_email'=>$persona['user_email'],
                        'user_dni'=>$persona['user_dni'],
                        'user_ies'=>0,
                        'user_rol'=>0
                    ];
                    $session= session();
                    $session->set($datossesion);
                    return redirect()->to(base_url() . '/home');
                } else {
                    $data['error']="Datos Incorrectos";
                    echo view('/login', $data);
                }
            } else {
                $data['error']="Datos Incorrectos";
                echo view('/login', $data);
            }

        } else {
            $data=['validation' => $this->validator];
            echo view('/login', $data);
        }
    }

    // Salir del Sistema
    public function logout(){
        $session=session();
        $session->destroy();
        return redirect()->to(base_url().'/personas/login');
    }

    // Cambiar Contraseña
	public function password()
	{
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $persona=$this->personas->find($this->session->user_id);
		$data =['vTITULO' => 'Cambiar Contraseña', 'vPERSONA' => $persona];

		echo view('header');
		echo view('personas/password', $data);
		echo view('footer');
	}

    // Actualizar Contraseña en DB
    public function actualizar_password()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        
        $password = new PasswordHash(8, true);
        $persona=$this->personas->find($this->session->user_id);
        if ($persona) {
            $this->personas->update($this->session->user_id, [
                'user_pass' => $password->HashPassword(trim($this->request->getPost('pass')))
            ]);
            session()->setFlashdata('success', 'Contraseña actualizada correctamente.');            
        }

        return redirect()->to(base_url().'/home');
    }

}

