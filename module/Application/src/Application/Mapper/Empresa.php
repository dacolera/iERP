<?php

namespace Application\Mapper;

use Application\Entity\Empresa as EmpresaEntity;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate\Like;

class Empresa extends AbstractMapper
{

    protected $tableName = 'emp';

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
    public function save(EmpresaEntity $empresa)
    {
        $return = parent::insert($empresa);
        $empresa->setId(
            $return->getGeneratedValue()
        );
        return $return;
    }
}
