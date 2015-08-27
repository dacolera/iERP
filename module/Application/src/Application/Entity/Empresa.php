<?php

namespace Application\Entity;

class Empresa
{
    protected $id;
    protected $usrId;
    protected $razaoSocial;
    protected $nomeFantasia;
    protected $cnpj;
    protected $enderecoId;
    protected $inscricaoMunicipal;
    protected $inscricaoEstadual;
    protected $CNAEPrincipal;
    protected $CNAESecundario;
    protected $regimeTributacao;
    protected $valorHonorarios;
    protected $vencimentoHonorarios;
    protected $vencimentoProcuracaoCaixa;
    protected $vencimentoProcuracaoRFB;
    protected $certificadoDigital;
    protected $senhaWeb;
    protected $senhaFazenda;
    protected $tipoEmpresa;
    protected $contrato;
    protected $vencimentoContrato;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
        return $this;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getInscricaoMunicipal()
    {
        return $this->inscricaoMunicipal;
    }

    public function setInscricaoMunicipal($inscricaoMunicipal)
    {
        $this->inscricaoMunicipal = $inscricaoMunicipal;
        return $this;
    }

    public function getInscricaoEstadual()
    {
        return $this->inscricaoEstadual;
    }

    public function setInscricaoEstadual($inscricaoEstadual)
    {
        $this->inscricaoEstadual = $inscricaoEstadual;
        return $this;
    }

    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;
        return $this;
    }

    public function getEnderecoId()
    {
        return $this->enderecoId;
    }

    public function setEnderecoId($enderecoId)
    {
        $this->enderecoId = $enderecoId;
        return $this;
    }

    public function getOrigemId()
    {
        return $this->origemId;
    }

    public function setOrigemId($origemId)
    {
        $this->origemId = $origemId;
        return $this;
    } 

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    

    public function getRamo()
    {
        return $this->ramo;
    }

    public function setRamo($ramo)
    {
        $this->ramoId = $ramo;
        return $this;
    }
}
