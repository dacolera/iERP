<?php

namespace Application\Mapper;

use Application\Entity\Departamento as DepartamentoEntity;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Predicate\Like;

class Departamento extends AbstractMapper
{

    protected $tableName = 'departamento';

    public function loadDepartamentoById($id)
    {
        $sql = $this->getSelect($this->tableName)
                ->where('id_departamento' , $id);

        return $this->select($sql)->current();
    }
    
    /**
     * carrega todas os departamentos
     * @return \Zend\Db\ResultSet\HydratingResultSet;
     */
    public function loadAllDepartamentos($field = null, $busca = null)
    {
        $where = [];
        if (null != $busca && null != $field) {
            $where[] = new Like($field, '%' . $busca . '%');
        }

        $sql = $this->getSelect()
            ->where($where);
            
        return $this->select($sql);
    }
    
    public function save(DepartamentoEntity $departamentoEntity)
    {
        if ($departamentoEntity->getId() > 0) {
            return parent::update($departamentoEntity, ['id_departamento' => $departamentoEntity->getId()]);
        }
        
        return parent::insert($departamentoEntity);
    }
    
    public function deletarDepartamento($condicao)
    {
        return parent::delete($condicao);
    }
    
    public function suspenderAtivarToogleDepartamento($id, $status)
    {
        return $this->update(["status" => $status], ['id_departamento' => $id]);
    }
}
