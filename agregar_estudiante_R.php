<?php

require('configs/include.php');

class c_agregar_estudiante_R extends super_controller {
	
	public function agregar(){
		
		$estudiante = new estudiante($this->post);

		if(is_empty($estudiante->get('id'))){
			throw_exception("Debe ingresar un id");
		}elseif (!is_numeric($estudiante->get('id')) or $estudiante->get('id') < 0){
			throw_exception("id invalido");
		}

		if(is_empty($estudiante->get('nombre'))){
			throw_exception("Debe ingresar un nombre");
		}

		if(is_empty($estudiante->get('edad'))){
			throw_exception("Debe ingresar una edad");
		}elseif (!is_numeric($estudiante->get('edad')) or $estudiante->get('edad') < 0){
			throw_exception("id invalido");
		}

		$this->orm->connect();
        $this->orm->insert_data("normal",$estudiante);
        $this->orm->close();

        $this->type_warning = "Exito";
        $this->msg_warning = "Estudiante agregado correctamente";
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning',$this->type_warning);
        $this->engine->assign('msg_warning',$this->msg_warning);
	}

	public function display()
	{
		$this->engine->assign('title','Agregar Estudiante');
		
		$this->engine->display('header.tpl');
		$this->engine->display($this->temp_aux);
		$this->engine->display('agregar_estudiante_R.tpl');
		$this->engine->display('footer.tpl');
	}
	
	public function run() {
		try {
			if (isset($this->get->option)) {
				if ($this->get->option == "agregar")
					$this->{$this->get->option}();
				else
					throw_exception("Opción ". $this->get->option ." no disponible");
			}
		} catch (Exception $e) {
			$this->error=1;
			$this->msg_warning=$e->getMessage();
			$this->temp_aux = 'message.tpl';
			$this->engine->assign('type_warning',$this->type_warning);
			$this->engine->assign('msg_warning',$this->msg_warning);
		}
		$this->display();
	}
}

$call = new c_agregar_estudiante_R();
$call->run();

?>