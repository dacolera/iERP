<?php

namespace Application\Entity;

class Empresa
{
    protected $id;
    protected $usrId;
    protected $usuario;
    protected $razaoSocial;
    protected $nomeFantasia;
    protected $cnpj;
    protected $enderecoId;
    protected $endereco;
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

    public function getUsrId()
    {
        return $this->usrId;
    }

    public function setUsrId($usrId)
    {
        $this->usrId = $usrId;
        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
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

    public function getEnderecoId()
    {
        return $this->enderecoId;
    }

    public function setEnderecoId($enderecoId)
    {
        $this->enderecoId = $enderecoId;
        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco(Endereco $endereco)
    {
        $this->endereco = $endereco;
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

    public function getCNAEPrincipal()
    {
        return $this->CNAEPrincipal;
    }

    public function setCNAEPrincipal($CNAEPrincipal)
    {
        $this->CNAEPrincipal = $CNAEPrincipal;
        return $this;
    }

    public function getCNAESecundario()
    {
        return $this->CNAESecundario;
    }

    public function setCNAESecundario($CNAESecundario)
    {
        $this->CNAESecundario = $CNAESecundario;
        return $this;
    }

    public function getRegimeTributacao()
    {
        return $this->regimeTributacao;
    }

    public function setRegimeTributacao($regimeTributacao)
    {
        $this->regimeTributacao = $regimeTributacao;
        return $this;
    }

    public function getValorHonorarios()
    {
        return $this->valorHonorarios;
    }

    public function setValorHonorarios($valorHonorarios)
    {
        $this->valorHonorarios = $valorHonorarios;
        return $this;
    }

    public function getVencimentoHonorarios()
    {
        return $this->vencimentoHonorarios;
    }

    public function setVencimentoHonorarios($vencimentoHonorarios)
    {
        $this->vencimentoHonorarios = $vencimentoHonorarios;
        return $this;
    }

    public function getVencimentoProcuracaoCaixa()
    {
        return $this->vencimentoProcuracaoCaixa;
    }

    public function setVencimentoProcuracaoCaixa($vencimentoProcuracaoCaixa)
    {
        $this->vencimentoProcuracaoCaixa = $vencimentoProcuracaoCaixa;
        return $this;
    }

    public function getVencimentoProcuracaoRFB()
    {
        return $this->vencimentoProcuracaoRFB;
    }

    public function setVencimentoProcuracaoRFB($vencimentoProcuracaoRFB)
    {
        $this->vencimentoProcuracaoRFB = $vencimentoProcuracaoRFB;
        return $this;
    }

    public function getCertificadoDigital()
    {
        return $this->certificadoDigital;
    }

    public function setCertificadoDigital($certificadoDigital)
    {
        $this->certificadoDigital = $certificadoDigital;
        return $this;
    }

    public function getSenhaWeb()
    {
        return $this->senhaWeb;
    }

    public function setSenhaWeb($senhaWeb)
    {
        $this->senhaWeb = $senhaWeb;
        return $this;
    }

    public function getSenhaFazenda()
    {
        return $this->senhaFazenda;
    }

    public function setSenhaFazenda($senhaFazenda)
    {
        $this->senhaFazenda = $senhaFazenda;
        return $this;
    }

    public function getTipoEmpresa()
    {
        return $this->tipoEmpresa;
    }

    public function setTipoEmpresa($tipoEmpresa)
    {
        $this->tipoEmpresa = $tipoEmpresa;
        return $this;
    }

    public function getContrato()
    {
        return $this->contrato;
    }

    public function setContrato($contrato)
    {
        $this->contrato = $contrato;
        return $this;
    }

    public function getVencimentoContrato()
    {
        return $this->vencimentoContrato;
    }

    public function setVencimentoContrato($vencimentoContrato)
    {
        $this->vencimentoContrato = $vencimentoContrato;
        return $this;
    }


}
