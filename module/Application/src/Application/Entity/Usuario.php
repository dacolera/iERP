<?php

namespace Application\Entity;

class Usuario
{
	protected $usrId;
	protected $dataCadastro;
	protected $email;
	protected $login;
	protected $senha;
	protected $origem;
	protected $status;

	public function getId()
	{
		return (int) $this->usrId;
	}

	public function setId($id)
	{
		$this->usrId = $id;
		return $this;
	}

	public function getDataCadastro()
	{
		return $this->dataCadastro;
	}

	public function setDataCadastro($dataCadastro)
	{
		$this->dataCadastro = $dataCadastro;
		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function setLogin($login)
	{
		$this->login = $login;
		return $this;
	}

	public function getSenha()
	{
		return $this->senha;
	}

	public function setSenha($senha)
	{
		$this->senha = md5($senha);
		return $this;
	}

	public function getOrigem()
	{
		return $this->origem;
	}

	public function setOrigem($origem)
	{
		$this->origem = $origem;
		return $this;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($status)
	{
		$this->status = $status;
		return $this;
	}


}