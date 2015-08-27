<?php

namespace Application\Mapper;

use Application\Entity\Empresa as EmpresaEntity;
use Zend\Db\Sql\Select;
use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate\Like;

class Empresa extends AbstractDbMapper
{

    protected $tableName = 'emp';

    public function loadByListId(array $ids)
    {
        $sql = $this->getSelect($this->tableName)
                ->where(array('id' => $ids));

        return $this->select($sql);
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

    public function loadById($id)
    {
        $sql = $this->getSelect(array('e' => $this->tableName))
                ->join(
                    array(
                        'el' => 'emp_logo'
                    ),
                    'e.emp_id = el.emp_id',
                    array(
                        'data_logo_cadastrado' => 'data'
                    ),
                    'left'
                )
                ->where(array('e.emp_id' => $id));

        return $this->select($sql)->current();
    }

    public function loadByVagaId($id)
    {
        $sql = $this->getSelect(array('e' => $this->tableName))
                ->join(array('v' => 'vag'), 'e.emp_id = v.emp_id')
                ->where(array('v.vag_id' => $id));

        return $this->select($sql)->current();
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
