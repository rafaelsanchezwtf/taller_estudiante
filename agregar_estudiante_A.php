<?php

require('configs/include.php');

class c_agregar_estudiante_A extends super_controller {
	
	public function display()
	{
		$this->engine->assign('title',$this->gvar['n_index']);
		
		$this->engine->display('header.tpl');
		$this->engine->display($this->temp_aux);
		$this->engine->display('agregar_estudiante_A.tpl');
		$this->engine->display('footer.tpl');
	}
	
	public function run()
	{
		
		try
		{
			if(isset($this->get->option))
			{
				if($this->get->option == 'insert')
				{
					$this->{$this->get->option}();
				}else
				{
					throw_exception("Opcion " . $this->get->option . " no disponible");
				}	
				
			}
		}catch(Exception $e){
			$this->error = 1;
			$this->msg_warning=$e->getMessage();
			$this->temp_aux = 'message.tpl';
			$this->engine->assign('type_warning',$this->type_warning);
			$this->engine->assign('msg_warning',$this->msg_warning);
		}
		
		$this->display();
		
		
	}
	
	public function insert()
	{
		$estudiante = new estudiante($this->post);
		if(is_empty($estudiante->get('id')))
        {throw_exception("Error: Llenar el ID");}
		
		$this->orm->connect();
        $this->orm->insert_data("normal",$estudiante);
        $this->orm->close();
		
		$this->type_warning = "success";
        $this->msg_warning = "Estudiante insertado correctamente";
        
        $this->temp_aux = 'message.tpl';
        $this->engine->assign('type_warning',$this->type_warning);
        $this->engine->assign('msg_warning',$this->msg_warning);
	}
}

$call = new c_agregar_estudiante_A();
$call->run();

?>