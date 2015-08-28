<?php

namespace Application\Mapper;

use Application\Entity\Empresa as EmpresaEntity;
use Application\Entity\Usuario as UsuarioEntity;
use Application\Entity\Endereco as EnderecoEntity;



class Empresa extends AbstractMapper
{

    protected $tableName = 'emp';

    protected $usuarioMapper;

    protected $enderecoMapper;

    public function __construct(Usuario $usuario, Endereco $endereco)
    {
        $this->usuarioMapper  = $usuario;

        $this->enderecoMapper = $endereco;
    }

    /**
     * carrega empresa pelo nome fantasia
     * @param  string $nomeFantasia
     * @return \Zend\Db\ResultSet\HydratingResultSet;
     */
    public function loadByNomeFantasia($nomeFantasia)
    {
        $sql = $this->getSelect()
                ->where(array('nomefantasia' => $nomeFantasia));

        return $this->select($sql);
    }

    /**
     * @param  string $status
     * @param  string $cnpj   o cnpj do jeito que esta salvo no banco
     * @return \Zend\Db\ResultSet\HydratingResultSet
     */
    public function loadByStatusAndCnpj($status, $cnpj)
    {
        $sql = $this->getSelect($this->tableName)
                ->where(array('status' => $status, 'cnpj'=>$cnpj));

        return $this->select($sql);
    }

    /**
     * @param \Empresa\Entity\Empresa
     * @return ResultInterface
     */
    public function save(EmpresaEntity $empresa, UsuarioEntity $usuario, EnderecoEntity $endereco)
    {
        try {
            $usrId = (int)$this->usuarioMapper->insert($usuario)->getGeneratedValue();
        } catch (\Exception $e) {
            print $e->getMessage();
            exit;
        }

        try {
            $endId = (int)$this->enderecoMapper->insert($endereco)->getGeneratedValue();
        } catch (\Exception $e) {
            print $e->getMessage();
            exit;
        }

        $empresa
            ->setUsrId($usrId)
            ->setEnderecoId($endId);

        return parent::insert($empresa);
    }
}
