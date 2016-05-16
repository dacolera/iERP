<?php

namespace Application\Mapper;

use Application\Entity\Usuario as UsuarioEntity;
use Zend\Db\Sql\Select;

class Usuario extends AbstractMapper
{

    protected $tableName = 'usr';

    public function loadById($id)
    {
        $sql = $this->getSelect($this->tableName)
                ->where('usr_id' , $id);

        return $this->select($sql);
    }
}
