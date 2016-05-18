<?php

namespace Application\Mapper;

use Application\Entity\Funcionario as FuncionarioEntity;
use Zend\Db\Sql\Select;

class Funcionario extends AbstractMapper
{

    protected $tableName = 'funcionario';

    public function loadById($id)
    {
        $sql = $this->getSelect($this->tableName)
                ->where('id_funcionario' , $id);

        return $this->select($sql);
    }
    
    public function save(FuncionarioEntity $funcionarioEntity)
    {
        if ($funcionarioEntity->getId() > 0) {
            return parent::update($funcionarioEntity);
        }
        
        return parent::insert($funcionarioEntity);
    }
}