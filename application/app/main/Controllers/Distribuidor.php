<?php

namespace App\Controllers {
	
	use \App\Models\DistribuidorModel;

	class Distribuidor extends AppController
	{

		public function __construct(){

			$this -> distribuidor_model = new DistribuidorModel();
		}

		//--------------------------------------------------------------------

		public function index() {

			$dados[] = null;

			return $this -> view('distribuidor/distribuidor', $dados);

		}
		
		//--------------------------------------------------------------------

		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> distribuidor_model -> create() ) {

				$template = $this -> template('distribuidor/template_email.html', $_POST);

				if ( $msg = $this -> distribuidor_model -> sendMail($template) )
				{
					$msg = 'Mensagem enviada com sucesso!';
					$status = 'success';
					$type = 'back';
				}

			} else {
				$status = 'error';
				$fields = $this -> distribuidor_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		//--------------------------------------------------------------------
		
	}
	
}
