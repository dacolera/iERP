<?php

namespace Application\Service;

use Application\Entity\Departamento as DepartamentoEntity;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class Departamento implements ServiceManagerAwareInterface
{
    protected $serviceManager;

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getService()
    {
        return $this->serviceManager;
    }

    public function saveDepartamento($dados)
    {
        $id = $dados['id_departamento'] ? $dados['id_departamento'] : null;

        $DepartamentoEntity = new DepartamentoEntity;
        $DepartamentoEntity
            ->setId($id)
            ->setNome($dados['nome'])
            //->setSupervisor($dados['supervisor'])
            ->setDataCadastro(date('Y-m-d H:i:s'))
            ->setStatus('A');

        try {
            $mapperDepartamento = $this->getService()->get('Application\Mapper\Departamento');
            $id = $mapperDepartamento->save($DepartamentoEntity);
        } catch (\Exception $e) {
           throw $e;
        }
        return $id;
    }

    public function pegarDepartamentos($field = null, $busca = null)
    {
        $mapperDepartamento = $this->getService()->get('Application\Mapper\Departamento');

        $departamentos = $mapperDepartamento->loadAllDepartamentos($field, $busca);
        return $departamentos;
    }

    public function pegarDepartamentoPorId($id)
    {
        $mapperDepartamento = $this->getService()->get('Application\Mapper\Departamento');

        return $mapperDepartamento->loadDepartamentoById($id);
    }

    public function deletarDepartamento($id)
    {
        $mapperDepartamento = $this->getService()->get('Application\Mapper\Departamento');
        return  $mapperDepartamento->deletarEmpresa($id);
    }

    public function suspenderAtivarToogleDepartamento($id, $status)
    {
        $mapperDepartamento = $this->getService()->get('Application\Mapper\Departamento');
        $novoStatus = $status == 'Ativa' ? 'A' : 'S';
        return  $mapperDepartamento->suspenderAtivarToogleDepartamento($id, $novoStatus);
    }
    
}
