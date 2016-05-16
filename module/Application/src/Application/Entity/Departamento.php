<?php

namespace Application\Entity;

class Departamento
{
    protected $id;
    protected $nome;
    protected $dataCadastro;
    protected $status;
    protected $supervisor;
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setNome($nome)
    {
        $this->nome = $id;
        return $this;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
        return $this;
    }
    
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setSupervisor($supervisor)
    {
        $this->supervisor = $supervisor;
        return $this;
    }
    
    public function getSupervisor()
    {
        return $this->supervisor;
    }
}