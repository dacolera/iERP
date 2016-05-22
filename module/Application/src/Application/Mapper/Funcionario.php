<?php

namespace Application\Mapper;

use Application\Entity\Funcionario as FuncionarioEntity;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Predicate\Like;

class Funcionario extends AbstractMapper
{

    protected $tableName = 'funcionario';

    public function loadFuncionarioById($id)
    {
        $sql = $this->getSelect($this->tableName)
                ->where(['id_funcionario' => $id]);

        return $this->select($sql)->current();
    }
    
    /**
     * carrega todas os funcionarios
     * @return \Zend\Db\ResultSet\HydratingResultSet;
     */
    public function loadAllFuncionarios($field = null, $busca = null)
    {
        $where = [];
        if (null != $busca && null != $field) {
            $where[] = new Like($field, '%' . $busca . '%');
        }

        $sql = $this->getSelect()
            ->where($where);
            
        return $this->select($sql);
    }
    
    public function save(FuncionarioEntity $funcionarioEntity)
    {
        if ($funcionarioEntity->getId() > 0) {
            return parent::update($funcionarioEntity, ['id_funcionario' => $funcionarioEntity->getId()]);
        }
        
        return parent::insert($funcionarioEntity);
    }
    
    public function deletarFuncionario($condicao)
    {
        return parent::delete($condicao);
    }
    
    public function suspenderAtivarToogleFuncionario($id, $status)
    {
        return $this->update(["status" => $status], ['id_funcionario' => $id]);
    }
}