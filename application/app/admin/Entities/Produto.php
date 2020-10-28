<?php

namespace App\Entities
{

	class Produto extends AppEntity {

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $id_categoria;
		protected $nome;
		protected $descricao;
		protected $modo_uso;
		protected $imagem;
		protected $status = '0';

		protected $datamap = array(
			'categoria' => 'id_categoria',
        );
		private $datacadastro;
		private $agendamento;

		public function __construct(){
            parent::__construct();
            $this -> config = new \App\Entities\Configuracao();
		}

		public function setId($id = null)
		{
			$this -> id = $id;
			return $this;
		}

		public function getId()
		{
			return $this -> id;
		}

		public function setIdCategoria($id = null) {
			$this -> id_categoria = ! is_null($id) ? $id : $_SESSION[USERDATA]['id'];
			return $this;
		}

		public function getIdCategoria(){
			return $this -> id_categoria;
		}

		public function setNome($str)
		{
			$this -> nome = $str;
			return $this;
		}
		
		public function getNome()
		{
			return $this -> nome;
		}

		public function setDescricao($str)
		{
			$this -> descricao = $str;
			return $this;
		}

		public function getDescricao()
		{
			return $this -> descricao;
		}

		public function setModoUso($str)
		{
			$this -> modo_uso = $str;
			return $this;
		}

		public function getModoUso()
		{
			return $this -> modo_uso;
		}

		public function setDataAdd(string $str = null)
		{

			if ( ! is_null($str) )
				$this -> data_add = $str;
			else
				return $this -> data_add = null;

			$this -> datacadastro = new \DateTime($this -> data_add);

			return $this;

		}

		public function getDataAdd(string $format = 'Y-m-d H:i:s')
		{
			if ( ! empty($this -> data_add) )
			{
				return $this -> datacadastro -> format($format);
			}
		}

		/**
		 * Set Imagem do produto
		 *
		 * @param
		 *        	String
		 * @return String
		 */
		public function setImagem($str = null)
		{

			if ( ! isset($_SESSION[USERDATA]) )
				return FALSE;

			if ( empty($str) )
				return false;

			if ( ! is_null($str) && is_string($str) )
			{
				$this -> imagem = $str;
				return $this;
			}
			else
			{

				$request = \Config\Services::request();

				$path =  $_SERVER['DOCUMENT_ROOT'] . $this -> config -> getBasePath() . 'img/produtos/';

				$file = $request -> getFile('imagem');

				if ( ! $file -> isValid() )
					return false;

				if ( ! is_dir($path) && is_writable($path) )
					mkdir($path, 0755, TRUE);

				$newName = $file -> getRandomName();
				$file -> move($path, $newName);

				$this -> imagem = $file -> getName();

				return $this;

			}

		}

		public function setOriginalName($img) {
			print_r($img);
			$this -> original_name = $img;
			return $this;
		}

		public function getOriginalName() {
			return $this -> original_name;
		}

		/**
		 * Get Imagem do produto
		 *
		 * @return String
		 */
		public function getImagem(bool $realpath = false)
		{

			if ( $realpath )
				return $this -> imagem;

			return $this -> config -> getBasePath() . 'img/produtos/' . $this -> imagem;

		}

		public function setStatus(string $str)
		{
			$this -> status = $str;
			return $this;
		}

		public function getStatus()
		{
			return $this -> status;
		}

	}

}
