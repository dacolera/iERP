<?php

namespace Application\Mapper;

use Application\Entity\Departamento as DepartamentoEntity;
use Zend\Db\Sql\Select;

class Departamento extends AbstractMapper
{

    protected $tableName = 'departamento';

    public function loadById($id)
    {
        $sql = $this->getSelect($this->tableName)
                ->where('id_departamento' , $id);

        return $this->select($sql);
    }
    
    /**
     * carrega todas os departamentos
     * @return \Zend\Db\ResultSet\HydratingResultSet;
     */
    public function loadAllDepartamentos($field = null, $busca = null)
    {
        $where = array();
        if (null != $busca && null != $field) {
            $where[$field] = $busca;
        }

        $sql = $this->getSelect()
            ->where($where);
        return $this->select($sql);
    }
    
    public function save(DepartamentoEntity $departamentoEntity)
    {
        if ($departamentoEntity->getId() > 0) {
            return parent::update($departamentoEntity);
        }
        
        return parent::insert($departamentoEntity);
    }
}
