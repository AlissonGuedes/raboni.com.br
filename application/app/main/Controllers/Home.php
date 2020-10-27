<?php

namespace App\Controllers {

	use \App\Models\BannerModel;
	use \App\Models\ProdutoModel;

	class Home extends AppController
	{


		//--------------------------------------------------------------------

		public function __construct() {

			$this -> banner_model = new BannerModel();
			$this -> produto_model = new ProdutoModel();

		}

		//--------------------------------------------------------------------

		public function index() {

			$dados = [];

			$dados['banners'] = $this -> banner_model -> getAll() -> result();
			$dados['produtos'] = $this -> produto_model -> getAll(['limit' => '6']) -> result();

			return $this -> view('index', $dados);

		}

		//--------------------------------------------------------------------

	}
	
}