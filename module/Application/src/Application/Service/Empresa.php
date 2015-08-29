<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use \Application\Entity\Empresa as EmpresaEntity;
use \Application\Entity\Usuario as UsuarioEntity;
use \Application\Entity\Endereco as EnderecoEntity;

class Empresa
{
    protected $serviceLocator;
    protected $empresaEntity;
    protected $usuarioEntity;
    protected $enderecoEntity;

    public function __construct(EmpresaEntity $empresa, UsuarioEntity $usuario, EnderecoEntity $endereco)
    {
        $this->empresaEntity  = $empresa;
        $this->usuarioEntity  = $usuario;
        $this->enderecoEntity = $endereco;
    }

    public function setService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getService()
    {
        return $this->serviceLocator;
    }

    public function salvarEmpresa()
    {

    }
}