<?php

namespace App\Entities
{

	class Cliente extends AppEntity {

		/*
		 * Colunas
		 */
		protected $id = null;
		protected $nome;
		protected $email;
		protected $telefone;
		protected $status = '0';

		protected $datamap = array();

		private $datacadastro;
		private $agendamento;

		public function setId($id = null)
		{
			$this -> id = $id;
			return $this;
		}

		public function getId()
		{
			return $this -> id;
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

		public function setEmail($str) {
			$this -> email = $str;
			return $this;
		}

		public function getEmail() {
			return $this -> email;
		}

		public function setTelefone($str)
		{
			$this -> telefone = $str;
			return $this;
		}

		public function getTelefone()
		{
			return $this -> telefone;
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
