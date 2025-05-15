<?php namespace App\Controllers;

ini_set('memory_limit', '1024M'); // Aumentamos la memoria para el json

use App\Controllers\BaseController;
use App\Models\InstitutosModel;
use App\Models\Gestion_ExamenesModel;
use App\Models\PersonasModel;
use App\Models\DepartamentosModel;
use App\Models\Gestion_CondicionModel;
use App\Models\Gestion_Condicion_EstadosModel;
use App\Models\CarrerasModel;
use App\Models\Gestion_MesasModel;
use App\Models\Gestion_CarrerasModel;

Use App\Models\Gestion_InscripcionesModel;
use App\Models\Gestion_Inscripciones_LectivoModel;
use App\Models\Gestion_MateriasModel;
Use App\Models\Roles_DetalleModel;
use PDF;

class alumnos extends BaseController
{
    protected $session, $detalle, $usuarios, 
    $carreras, $mesas, $institutos, $personas, $departamentos,
    $gestion_inscripciones, $gestion_inscripciones_lectivo, $gestion_examenes, $gestion_materias, $gestion_condicion, $gestion_condicion_estados, 
    $gestion_carreras;

    public function __construct()
    {
        $this->session = session();
        $this->detalle = new Roles_DetalleModel();        

        $this->institutos= new InstitutosModel();
        $this->personas= new PersonasModel();
        $this->departamentos= new DepartamentosModel();
        $this->carreras= new CarrerasModel();

        $this->gestion_condicion= new Gestion_CondicionModel();
        $this->gestion_condicion_estados= new Gestion_Condicion_EstadosModel();
        $this->gestion_inscripciones = new Gestion_InscripcionesModel();
        $this->gestion_inscripciones_lectivo = new Gestion_Inscripciones_LectivoModel();
        $this->gestion_materias= new Gestion_MateriasModel();
        $this->gestion_examenes= new Gestion_ExamenesModel();
        $this->gestion_carreras= new Gestion_CarrerasModel();
    }

    // Listado de Alumnos de IES de Tabla Condicion
    public function index()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ListaAlumnos');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer'); 
            exit;
        }

        $ies=$this->institutos->find($this->session->user_ies);
        $alumnos=$this->gestion_condicion
        ->distinct()
        ->select('gestion_condicion.id_persona, user_apellido, user_nombres, user_dni, user_email, user_telefono')
        ->where('id_instituto', $this->session->user_ies)
        ->join('personas', 'personas.id = gestion_condicion.id_persona')
        ->findAll();

        $data=['vTITULO' => 'Lista General de Alumnos', 'vDATOS' => $alumnos, 'vIES' => $ies];

        echo view('header');
        echo view('alumnos/listado',$data);
        echo view('footer');
    }

    // Listado de Inscripciones Pendientes en IES
    public function inscripciones_pendientes()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_InscripcionesPendientes');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $ies=$this->institutos->find($this->session->user_ies);
        $alumnos=$this->gestion_inscripciones
        ->select('gestion_inscripciones.id, gestion_inscripciones.estado, personas.user_apellido, personas.user_nombres, personas.user_dni, carreras.nombre, carreras.resolucion, gestion_materias.nombre AS vMATERIA')
        ->where('id_instituto', $this->session->user_ies)
        //->where('gestion_inscripciones.estado <>', 'ACEPTADO')
        ->where('gestion_inscripciones.estado', 'PENDIENTE')
        ->join('personas', 'personas.id = gestion_inscripciones.id_persona')
        ->join('carreras', 'carreras.id = gestion_inscripciones.id_carrera')
        ->join('gestion_materias', 'gestion_materias.id = gestion_inscripciones.id_materia')
        ->limit(15000)
        //->findAll();
        ->get()
        //->getResult();
        ->getResultArray();

        $data=['vTITULO' => 'Lista de Inscripciones Pendientes', 'vDATOS' => $alumnos, 'vIES' => $ies];

        echo view('header');
        echo view('alumnos/inscripciones_pendientes',$data);
        echo view('footer');
    }

    // Listado de Inscripciones Rechazadas en IES
    public function inscripciones_rechazadas()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_InscripcionesRechazadas');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $ies=$this->institutos->find($this->session->user_ies);
        $alumnos=$this->gestion_inscripciones
        ->select('gestion_inscripciones.*, 
        user_apellido, user_nombres, user_dni, user_email, user_telefono, 
        carreras.nombre, carreras.resolucion, 
        gestion_materias.nombre AS vMATERIA')
        ->where('id_instituto', $this->session->user_ies)
        //->where('gestion_inscripciones.estado <>', 'ACEPTADO')
        ->where('gestion_inscripciones.estado', 'RECHAZADO')
        ->join('personas', 'personas.id = gestion_inscripciones.id_persona')
        ->join('carreras', 'carreras.id = gestion_inscripciones.id_carrera')
        ->join('gestion_materias', 'gestion_materias.id = gestion_inscripciones.id_materia')
        ->findAll();

        $data=['vTITULO' => 'Lista de Inscripciones Rechazadas', 'vDATOS' => $alumnos, 'vIES' => $ies];

        echo view('header');
        echo view('alumnos/inscripciones_rechazadas',$data);
        echo view('footer');
    }

    // ACEPTAR Inscripciones Pendientes
    public function procesarSeleccion_Aceptar() 
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $seleccionados = $this->request->getPost('seleccionados'); // Recibir array
    
        if (!empty($seleccionados)) {

            foreach ($seleccionados as $id) {
                
                $inscripcion = $this->gestion_inscripciones->find($id);

                $condicion = $this->gestion_condicion
                ->where('id_persona',$inscripcion['id_persona'])
                ->where('id_instituto',$inscripcion['id_instituto'])
                ->where('id_materia',$inscripcion['id_materia'])
                ->first();
                
                if (empty($condicion)) {
                    $this->gestion_condicion->save([
                        'id_persona' => $inscripcion['id_persona'],
                        'id_instituto' => $inscripcion['id_instituto'],
                        'id_materia' => $inscripcion['id_materia'],
                        'id_carrera' => $inscripcion['id_carrera'],
                        'estado' => 6
                    ]);
                } else {
                    $this->gestion_condicion->update($condicion['id'], [
                        'estado' => 6
                    ]);
                }

                $this->gestion_inscripciones->update($id, [
                    'estado' => 'ACEPTADO'
                ]);

            }
            
            $response = ['status' => 'success', 'mensaje' => 'Registros procesados correctamente'];
        } else {
            $response = ['status' => 'error', 'mensaje' => 'No se enviaron registros'];
        }
    
        echo json_encode($response);
    }

    // RECHAZAR Inscripciones Pendientes
    public function procesarSeleccion_Rechazar()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}

        $seleccionados = $this->request->getPost('seleccionados'); // Recibir array
    
        if (!empty($seleccionados)) {
            foreach ($seleccionados as $id) {
                $this->gestion_inscripciones->update($id, [
                    'estado' => 'RECHAZADO'
                ]);
            }
            $response = ['status' => 'success', 'mensaje' => 'Registros procesados correctamente'];
        } else {
            $response = ['status' => 'error', 'mensaje' => 'No se enviaron registros'];
        }
    
        echo json_encode($response);
    }

    // Ver Alumno - Perfil
    public function ver($vID)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_VerAlumno');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $id=openssl_decrypt(base64_decode($vID),'AES-128-ECB',$this->session->user_id);

        $persona=$this ->personas->find($id);
        $deptos=$this->departamentos->findAll();

        $data=['vTITULO' => 'Ver Alumno', 'vPERSONA' => $persona, 'vDEPARTAMENTOS' => $deptos];

            echo view('header');
            echo view('alumnos/ver',$data);
            echo view('footer');
    }

    // Estado Academico de Todas las Condiciones
	public function estado_academico($id)
	{
		if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
		if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_EstadoAcademico');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $persona=$this ->personas->find($id);

        // Estado Académico dividido por Carreras
/* 		$academico=$this->gestion_condicion
        ->select('gestion_condicion.*, carreras.nombre, carreras.resolucion')
		->where('id_persona', $id)
		->where('id_instituto', $this->session->user_ies)
		->join('carreras', 'carreras.id = gestion_condicion.id_carrera')
        ->groupBy(['gestion_condicion.id_carrera', 'gestion_condicion.id_instituto'])
		->findAll(); */

        $academico=$this->gestion_inscripciones_lectivo
        ->where('id_persona', $id)
        ->where('id_instituto', $this->session->user_ies)
        ->where('estado', 'ACTIVO')
        ->join('carreras', 'carreras.id = gestion_inscripciones_lectivo.id_carrera')
        ->findAll();

		$data =['vTITULO' => 'Estado Académico', 'vDATOS' => $academico, 'vPERSONA' => $persona];

		echo view('header');
		echo view('alumnos/estado_academico', $data);
		echo view('footer');	
	}

    // Editar Condicion
    public function editar_condicion($vID)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_EditarCondicion');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $institutos=$this->institutos->findAll();
        $estado=$this->gestion_condicion_estados->findAll();
        $condicion=$this->gestion_condicion
        ->select('gestion_condicion.*, carreras.nombre, carreras.resolucion, gestion_materias.nombre AS vMATERIA, personas.user_nombres, personas.user_apellido, personas.user_dni')
        ->where('gestion_condicion.id',$vID)
        ->join('carreras', 'gestion_condicion.id_carrera = carreras.id')
        ->join('gestion_materias', 'gestion_materias.id = gestion_condicion.id_materia')
        ->join('personas', 'gestion_condicion.id_persona = personas.id')
        ->first();

        $data=['vTITULO' => 'Editar Condición', 'vDATOS' => $condicion, 'vESTADO' => $estado, 'vINSTITUTOS' => $institutos];

        echo view('header');
        echo view('alumnos/editar_condicion',$data);
        echo view('footer');
    }

    // Actualizar cambios en Condicion
    public function actualizar_condicion()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ActualizarCondicion');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $existe=$this->gestion_condicion->find($this->request->getPost('id'));

        if (!empty($existe)){
            $this->gestion_condicion->update($existe['id'], [
            'nota' => $this->request->getPost('nota'),
            'estado' => $this->request->getPost('estado'),
            'equivalencia' => $this->request->getPost('equivalencia'),
            'fecha_aprobado' => ($this->request->getPost('fecha') == '') ? null : $this->request->getPost('fecha'),
            'libro' => $this->request->getPost('libro'),
            'folio' => $this->request->getPost('folio'),
            'observaciones' => $this->request->getPost('observaciones'),
            ]);
        }
        
        return redirect()->to(base_url().'/alumnos/condicion_carrera/' . $existe['id_carrera'] . '/' . $existe['id_persona']);
    }

    // Editar Condicion Masivo de Materias de carrera en Estado Academico de un Alumno
    public function condicion_carrera_masivo($id_carrera, $id_persona)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_EditarCondicionMasivo');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $carrera=$this->carreras->find($id_carrera);
        $persona=$this ->personas->find($id_persona);
        $estado=$this->gestion_condicion_estados->findAll();

        $datos=$this->gestion_condicion
        ->select('gestion_condicion.*, gestion_materias.nombre, gestion_materias.ano, gestion_condicion_estados.nombre AS vESTADO')
        ->where('id_carrera',$id_carrera)
        ->where('id_instituto',$this->session->user_ies)
        ->where('id_persona',$id_persona)
        ->join('gestion_condicion_estados', 'gestion_condicion_estados.id = gestion_condicion.estado')
		->join('gestion_materias', 'gestion_materias.id = gestion_condicion.id_materia')
        ->orderBy('gestion_materias.nombre', 'ASC')
        ->findAll();

        $data=['vTITULO' => 'Editar Condición de Materias de la Carrera', 'vDATOS' => $datos, 'vCARRERA' => $carrera, 'vPERSONA' => $persona, 'vESTADO' => $estado];

        echo view('header');
        echo view('alumnos/condicion_carrera_masivo',$data);
        echo view('footer');
    }

    // Actualizar Condiciones Masivo de Materias de carrera en Estado Academico de un Alumno
    public function actualizar_condiciones_masiva()
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ActualizarCondicion_Masiva');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }
        
        $ids = $this->request->getPost('espacios_id_condicion');
        //dd($notas); exit;
        if (is_array($ids)) {
            foreach ($ids as $index => $id) {
                //echo "Posición: $index, Valor: $id <br>";
                $existe=$this->gestion_condicion->find($id);
                if  (!empty($existe)) {
                    $this->gestion_condicion->update($id, [
                        'nota' => $this->request->getPost('espacios_nota')[$index],
                        'estado' => $this->request->getPost('espacios_estado')[$index],
                        'fecha_aprobado' => ($this->request->getPost('espacios_fecha_aprobado')[$index] == '') ? null : $this->request->getPost('espacios_fecha_aprobado')[$index],
                        'libro' => $this->request->getPost('espacios_libro')[$index],
                        'folio' => $this->request->getPost('espacios_folio')[$index],
                    ]);
                }
            }
        }

        return redirect()->to(base_url().'/alumnos/index');
    }

    // Listado de Condicion de Materias de carrera en Estado Academico de un Alumno
    public function condicion_carrera($id_carrera, $id_persona)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ListadoCondicion');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $carrera=$this->carreras->find($id_carrera);
        $persona=$this ->personas->find($id_persona);

        $datos=$this->gestion_condicion
        ->select('gestion_condicion.*, gestion_materias.nombre, gestion_materias.ano, gestion_condicion_estados.nombre AS vESTADO')
        ->where('id_carrera',$id_carrera)
        ->where('id_instituto',$this->session->user_ies)
        ->where('id_persona',$id_persona)
        ->join('gestion_condicion_estados', 'gestion_condicion_estados.id = gestion_condicion.estado')
		->join('gestion_materias', 'gestion_materias.id = gestion_condicion.id_materia')
        ->findAll();

        $data=['vTITULO' => 'Condición de Materias de la Carrera', 'vDATOS' => $datos, 'vCARRERA' => $carrera, 'vPERSONA' => $persona];

        echo view('header');
        echo view('alumnos/condicion_carrera',$data);
        echo view('footer');
    }

    // Listado General de Examenes del Alumno en el IES
    public function examenes($id)
    {
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_ExamenesAlumnoIES');
        if(!$acceso){
            echo view('header');
            echo view('acceso');
            echo view('footer');
            exit;
        }

        $persona=$this->personas->where('id',$id)->first();
        $datos=$this->gestion_examenes->select('gestion_examenes.*, gestion_mesas.*, gestion_materias.nombre, carreras.nombre AS vCARRERA')
        ->where('id_persona',$id)
        ->join('gestion_mesas', 'gestion_mesas.id = gestion_examenes.id_mesa')
        ->join('gestion_materias', 'gestion_materias.id = gestion_mesas.id_materia')
        ->join('carreras', 'carreras.id = gestion_mesas.id_carrera')
        ->findAll();

        $data=['vTITULO' => 'Exámenes del Alumno', 'vDATOS' => $datos, 'vPERSONA' => $persona];

        echo view('header');
        echo view('alumnos/examenes',$data);
        echo view('footer');
    }

    function analiticoPDF($id_carrera, $id_persona){

        $persona=$this->personas->where('id',$id_persona)->first();
        $carrera=$this->carreras->where('id',$id_carrera)->first();
        $datos=$this->gestion_condicion
        //->select('gestion_condicion.*, gestion_materias.id, gestion_materias.nombre AS vMATERIA, carreras.nombre AS vCARRERA, carreras.resolucion, personas.id, personas.user_apellido, personas.user_nombres, personas.user_dni')
        ->select('gestion_condicion.*, gestion_materias.*, gestion_condicion_estados.nombre AS vESTADO')
        ->where('gestion_condicion.id_carrera',$id_carrera)
        ->where('gestion_condicion.id_persona',$id_persona)
        ->join('gestion_materias', 'gestion_materias.id = gestion_condicion.id_materia')
        ->join('gestion_condicion_estados', 'gestion_condicion_estados.id = gestion_condicion.estado')
        ->orderBy('gestion_materias.nombre', 'ASC')
        ->findAll();

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle(utf8_decode("SITUACIÓN ACADÉMICA"));

        $pdf->Line(20, 45, 210-20, 45);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->image('https://dti.mendoza.edu.ar/superior/sitio/img/DES.png', 10, 10, 65, 20, 'PNG');
        $pdf->Ln(25);
        $pdf->Cell(195, 5, utf8_decode("SITUACIÓN ACADÉMICA"), 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50,5,"FECHA: ". date('d/m/Y'), 0, 1, 'L');
        $pdf->Cell(100,5,"APELLIDO Y NOMBRE: " . $persona['user_apellido'] .', '. $persona['user_nombres'], 0, 1, 'L');
        $pdf->Cell(50,5,"DNI: ". $persona['user_dni'], 0, 1, 'L');
        $pdf->Cell(50,5,utf8_decode("CARRERA: " . $carrera['nombre']), 0, 1, 'L');
        $pdf->Cell(50,5,utf8_decode("RESOLUCIÓN: " . $carrera['resolucion']), 0, 1, 'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0,0,0);
        $pdf->Settextcolor(255,255,255);
        $pdf->Cell(196, 5,  utf8_decode('Detalle Académico'),1, 1, 'C',1);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(129, 5, 'Espacio Curricular', 1, 0, 'C');
        $pdf->Cell(11, 5, utf8_decode('Año'), 1, 0, 'C');
        $pdf->Cell(20, 5, 'Fecha', 1, 0, 'C');
        $pdf->Cell(11, 5, 'Nota', 1, 0, 'C');
        $pdf->Cell(25, 5, utf8_decode('Estado'), 1, 1, 'C');

        //dd($datos);

        $fila = 1;
        foreach ($datos as $row) {
            $pdf->Cell(10, 5, $row['id_materia'], 1, 0, 'L');
            $pdf->Cell(119, 5, utf8_decode($row['nombre']), 1, 0, 'L');
            
             if ($row['estado']==5 || $row['estado']==8 || $row['estado']==9) {
                //$pdf->Cell(11, 5, $row['id_materia'], 1, 0, 'C');
                $pdf->Cell(11, 5, $row['ano'], 1, 0, 'C');
                $pdf->Cell(20, 5, $row['fecha_aprobado'], 1, 0, 'C');
                $pdf->Cell(11, 5, $row['nota'], 1, 0, 'C');
                $pdf->Cell(25, 5, $row['vESTADO'], 1, 1, 'C');
            } else {
                //$pdf->Cell(11, 5, $row['id_materia'], 1, 0, 'C');
                $pdf->Cell(11, 5, $row['ano'], 1, 0, 'C');
                $pdf->Cell(20, 5, '------------', 1, 0, 'C');
                $pdf->Cell(11, 5, '------', 1, 0, 'C');
                $pdf->Cell(25, 5, '------------------', 1, 1, 'C');
            }
            
            $fila++;
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("analitico.pdf", "I");
    }

    // Cambiar Instituto de un Estado Academico
    public function cambio_instituto($id_carrera, $id_persona, $id_instituto_anterior) {

        $ies = $this->gestion_carreras
            ->select('gestion_carreras.id_instituto, institutos.numero, institutos.nombre, institutos.direccion')
            ->join('institutos','gestion_carreras.id_instituto = institutos.id')
            ->where('gestion_carreras.id_carrera', $id_carrera)
            //->where('gestion_carreras.estado', 'ACTIVO')
            ->findAll();

        $vPERSONA = $this->personas->where('id',$id_persona)->first();
        $vINSTITUTO = $this->institutos->where('id',$id_instituto_anterior)->first();
        $vCARRERA = $this->carreras->where('id',$id_carrera)->first();

        $data = ['vTITULO' => 'Cambiar de Instituto o Sede el Estado Académico', 'vDATOS' => $ies, 'vPERSONA' => $vPERSONA, 'vINSTITUTO' => $vINSTITUTO, 'vCARRERA' => $vCARRERA];

        echo view('header');
        echo view('alumnos/cambio_instituto',$data);
        echo view('footer');
    }







///////////////////////////////////////////
    

    // Materias de la inscripcion del Alumno
    public function materias($id)
    {
        // Verificamos si hay session iniciada de usuario
        if(!isset($this->session->user_id)) {return redirect()->to(base_url());}
        // Verificamos si tiene session iniciada en IES
		if(($this->session->user_ies == 0)) {echo view('header');echo view('/acceso');echo view('footer');}
        //Verificamos si tiene permisos
        $acceso = $this->detalle->verificaPermisos($this->session->user_rol, 'GestionIES_MateriasInscripcion');
        if(!$acceso){
            echo view('header');echo view('acceso');echo view('footer');
            exit;
        }

        $inscripcion=$this ->gestion_alumnos->where('gestion_alumnos.id',$id)->first();
        $alumno=$this->personas->where('id',$inscripcion['id_persona'])->first();
        $datos=$this->gestion_condicion
        ->select('gestion_condicion.*, gestion_materias.nombre, gestion_materias.ano')
        ->where('id_gestion_alumnos',$id)
        ->join('gestion_materias', 'gestion_materias.id = gestion_condicion.id_materia')
        ->findAll();

        $data=['vTITULO' => 'Materias del Alumno', 'vDATOS' => $datos, 'vALUMNO' => $alumno, 'vINSCRIPCION' => $id];

        echo view('header');
        echo view('alumnos/materias_alumno',$data);
        echo view('footer');
    }



/// ----------------------------------------------
/// ----------------------------------------------    
/// ----------------------------------------------



    // Agregar nuevo alumno al IES
    public function nuevo()
    {
        if(!isset($this->session->user_rol)) {return redirect()->to(base_url());}
        if(($this->session->user_ies === 0)) {echo view('header');echo view('/acceso');echo view('footer');}

        $ies=$this->institutos->find($this->session->user_ies);
        $data=['vTITULO' => 'Agregar Alumno al Instituto | ', 'vIES' => $ies];

        if ($this->session->user_rol == '1' || $this->session->user_rol == '2'){
            echo view('header');
            echo view('alumnos/nuevo',$data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    // Autocompletado de Buscar Persona
    public function autocompleteData()
    {
        if(!isset($this->session->user_rol)) {return redirect()->to(base_url());}

        $matriz=array();
        $buscar = $this->request->getGet('term');

        $personas=$this->personas
        ->like('user_apellido', $buscar)
        ->orlike('user_dni', $buscar)
        ->findAll();

        if(!empty($personas)){
            foreach($personas as $row){
                $data['id'] = $row['id'];
                $data['value'] = $row['user_apellido'] . ', ' . $row['user_nombres'] . ' - DNI: ' . $row['user_dni'];
                array_push($matriz, $data);
            }
        }
        echo json_encode($matriz);
    }    

    // Guardar Nuevo Alumno al IES
    public function guardar_nuevo()
    {
        if(!isset($this->session->user_rol)) {return redirect()->to(base_url());}
        $repetido=$this->alumnos->where('id_personas', trim($this->request->getPost('id_persona')))->first();

        if ($this->session->rol == '1' || $this->session->rol == '2'){
            if ($repetido == null) {
                $this->alumnos->save([
                    'id_personas' => $this->request->getPost('id_personas'),
                    'id_institutos' => $this->request->getPost('id_ies'),
                    'id_carrera' => 0,
                    'anolectivo' => 0,
                    'curso' => 0,
                    'estado' => 'ACTIVO',
                ]);
            }
            return redirect()->to(base_url().'/alumnos/nuevo');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }

    public function examenesXXX($id_alumno)
    {
        if(!isset($this->session->id_usuario)) {return redirect()->to(base_url());}
        $alumno=$this ->alumnos->where('id',$id_alumno)->first();
        $datos=$this->examenes -> select('examenes.*, mesas.materia AS A, mesas.carrera AS B, mesas.fecha AS C, carreras.nombre AS D, materias.nombre AS E, mesas.libro AS F, mesas.folio AS G')->where('alumno',$id_alumno)->join('mesas', 'examenes.mesa = mesas.id')->join('carreras', 'mesas.carrera = carreras.id')->join('materias', 'mesas.materia = materias.id')->findAll();
        $data=['titulo' => 'Historial - Exámenes del Alumno', 'datos' => $datos, 'alumno' => $alumno];

        if ($this->session->rol == '1' || $this->session->rol == '2'){
            echo view('header');
            echo view('alumnos/examenes_alumno',$data);
            echo view('footer');
        } else {
            echo view('header');
            echo view('/acceso');
            echo view('footer');
        }
    }


}