<?php

namespace Application\Service;

use Application\Entity\Funcionario as FuncionarioEntity;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Application\Utils\DateConversion;
use Application\Utils\Money;

class Funcionario implements ServiceManagerAwareInterface
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

    public function saveFuncionario($dados)
    {
        $id = $dados['id_funcionario'] ? $dados['id_funcionario'] : null;

        $funcionarioEntity = new FuncionarioEntity;
        $funcionarioEntity
            ->setId($id)
            ->setNome($dados['nome'])
            ->setDataNascimento(DateConversion::conversion($dados['dataNascimento'], false))
            ->setEmail($dados['email'])
            ->setUsuario($dados['usuario'])
            ->setSenha($dados['senha'])
            ->setCargo($dados['cargo'])
            ->setSalario(Money::toFloat($dados['salario']))
            ->setCusto(Money::toFloat($dados['custoTotal']))
            ->setDepartamento($dados['departamento'])
            ->setSexo($dados['sexo'])
            ->setCep($dados['cep'])
            ->setEndereco($dados['end'])
            ->setBairro($dados['bairro'])
            ->setCidade($dados['cidade'])
            ->setEstado($dados['uf'])
            ->setDataCadastro(date('Y-m-d H:i:s'))
            ->setStatus('A');

        try {
            $mapperFuncionario = $this->getService()->get('Application\Mapper\Funcionario');
            $id = $mapperFuncionario->save($funcionarioEntity);
        } catch (\Exception $e) {
           throw $e;
        }
        return $id;
    }

    public function pegarFuncionarios($field = null, $busca = null)
    {
        $mapperFuncionario = $this->getService()->get('Application\Mapper\Funcionario');

        $funcionarios = $mapperFuncionario->loadAllFuncionarios($field, $busca);
        return $funcionarios;
    }

    public function pegarFuncionarioPorId($id)
    {
        $mapperFuncionario = $this->getService()->get('Application\Mapper\Funcionario');

        return $mapperFuncionario->loadFuncionarioById($id);
    }

    public function deletarFuncionario($id)
    {
        $mapperFuncionario = $this->getService()->get('Application\Mapper\Funcionario');
        return  $mapperFuncionario->deletarFuncionario(['id_funcionario' => $id]);
    }

    public function suspenderAtivarToogleFuncionario($id, $status)
    {
        $mapperFuncionario = $this->getService()->get('Application\Mapper\Funcionario');
        $novoStatus = $status == 'Ativa' ? 'A' : 'S';
        return  $mapperFuncionario->suspenderAtivarToogleFuncionario($id, $novoStatus);
    }
}
