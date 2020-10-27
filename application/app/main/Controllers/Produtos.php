<?php

namespace App\Controllers {
	
	use \App\Models\ProdutoModel;
	use \App\Models\ContatoModel;
	use \App\Models\LeadModel;

	class Produtos extends AppController
	{

		public function __construct() {

			$this -> produto_model = new ProdutoModel();
			$this -> lead_model = new LeadModel();
			$this -> contato_model = new ContatoModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			$dados['produtos'] = $this -> produto_model -> getAll() -> result();
			$dados['categorias'] = $this -> produto_model -> getCategorias();

			return $this -> view('produtos/produtos', $dados);

		}
		
		public function categorias($categoria, $subcategoria) {

			$dados['row'] = $this -> produto_model -> getAll($categoria) -> get() -> getRow();
			return $this -> view('produtos/details', $dados);

		}
		
		//--------------------------------------------------------------------
		
		public function insert() {

			$type   = null;
			$status = null;
			$msg	= null;
			$fields = null;

			if ( $this -> lead_model -> create_lead() ) {

				$template = $this -> template('produtos/template_email.html', $_POST);

				if ( $this -> contato_model -> sendMail($template) )
				{
				}

				$msg = 'Sua mensagem foi enviada com sucesso!';
				$status = 'success';
				$type = 'back';

			} else {
				$status = 'error';
				$fields = $this -> lead_model -> errors();
			}

			echo json_encode(['status'=> $status, 'message' => $msg, 'fields' => $fields, 'type' => $type]);

		}

		//--------------------------------------------------------------------

	}
	
}