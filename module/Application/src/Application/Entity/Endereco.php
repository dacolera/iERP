<?php

namespace Application\Entity;

class Endereco
{
	protected $endId;
	protected $logradouro;
	protected $numero;
	protected $complemento;
	protected $bairro;
	protected $municipio;
	protected $cep;
	protected $estado;

	public function getId()
	{
		return (int) $this->endId;
	}

	public function setId($id)
	{
		$this->endId = $id;
		return $this;
	}

	public function getLogradouro()
	{
		return $this->logradouro;
	}

	public function setLogradouro($logradouro)
	{
		$this->logradouro = $logradouro;
		return $this;
	}

	public function getNumero()
	{
		return $this->numero;
	}

	public function setNumero($numero)
	{
		$this->numero = $numero;
		return $this;
	}

	public function getComplemento()
	{
		return $this->complemento;
	}

	public function setComplemento($complemento)
	{
		$this->complemento = $complemento;
		return $this;
	}

	public function getBairro()
	{
		return $this->bairro;
	}

	public function setBairro($bairro)
	{
		$this->bairro = $bairro;
		return $this;
	}

	public function getMunicipio()
	{
		return $this->municipio;
	}

	public function setMunicipio($municipio)
	{
		$this->municipio = $municipio;
		return $this;
	}

	public function getCep()
	{
		return $this->cep;
	}

	public function setCep($cep)
	{
		$this->cep = $cep;
		return $this;
	}

	public function getEstado()
	{
		return $this->estado;
	}

	public function setEstado($estado)
	{
		$this->estado = $estado;
		return $this;
	}


}