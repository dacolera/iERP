<?php

namespace Application\Mapper;

use Application\Entity\Empresa as EmpresaEntity;
use Zend\Db\Sql\Where;

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
     * carrega todas as empresas
     * @return \Zend\Db\ResultSet\HydratingResultSet;
     */
    public function loadAllEmpresas($field = null, $busca = null)
    {
        $where = array();
        if (null != $busca && null != $field) {
            $where[$field] = $busca;
        }

        $sql = $this->getSelect()
            ->join('usr',
                'usr.usr_id = emp.usr_id'
            )
            ->join('endereco',
                'endereco.end_id = emp.end_id'
            )
            ->where($where);
        return $this->select($sql);
    }

    public function loadEmpresaById($id)
    {
        $sql = $this->getSelect()
            ->join('usr',
                'usr.usr_id = emp.usr_id'
            )
            ->join('endereco',
                'endereco.end_id = emp.end_id'
            )
            ->where(array('emp.id' => $id));

        return $this->select($sql)->getDataSource()->current();
    }

    public function deletarEmpresa($id) {

        return $this->delete('id ='. $id);
    }

    public function suspenderAtivarToogleEmpresa($id, $status)
    {
        return $this->usuarioMapper->update(array("status" => $status), sprintf('usr_id = %s', $id));
    }

    public function loadEmpresasInOrder($campo, $order)
    {
        $sql = $this->getSelect()
            ->join('usr',
                'usr.usr_id = emp.usr_id'
            )
            ->join('endereco',
                'endereco.end_id = emp.end_id'
            )
            ->order(array($campo => $order));
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
                ->where(array('status' => $status, 'cnpj' => $cnpj));

        return $this->select($sql);
    }

    /**
     * @param \Empresa\Entity\Empresa
     * @return ResultInterface
     */
    public function save(EmpresaEntity $empresa)
    {
        $db = $this->getDbAdapter();
        $con = $db->getDriver()->getConnection();
        $con->beginTransaction();

        try {
            if (!$empresa->getId()) {

                $arrUser = $this->usuarioMapper->getHydrator()->extract($empresa->getUsuario());
                unset($arrUser['id']);
                $arrEnd  = $this->enderecoMapper->getHydrator()->extract($empresa->getEndereco());
                unset($arrEnd['id']);

                $empresa
                    ->setUsrId(
                        $this->usuarioMapper->insert($arrUser)->getGeneratedValue()
                    )
                    ->setEnderecoId(
                        $this->enderecoMapper->insert($arrEnd)->getGeneratedValue()
                    );

                parent::insert($empresa);
            } else {
                //entitys to array

                $arrayUser = $this->usuarioMapper->getHydrator()->extract($empresa->getUsuario());

                $usr_id = $arrayUser['id'];
                unset($arrayUser['id']);

                $arrayEnd  = $this->enderecoMapper->getHydrator()->extract($empresa->getEndereco());
                $end_id = $arrayEnd['id'];
                unset($arrayEnd['id']);

                $this->usuarioMapper->update($arrayUser, sprintf("usr_id = %s", $usr_id));
                $this->enderecoMapper->update($arrayEnd, sprintf("end_id = %s", $end_id));
                $empresa
                    ->setUsrId($empresa->getUsuario()->getId())
                    ->setEnderecoId($empresa->getEndereco()->getId());

                $arrayEmp  = $this->getHydrator()->extract($empresa);
                $emp_id = $arrayEmp['id'];
                unset($arrayEmp['id']);

                parent::update($arrayEmp, sprintf("id = %s", $emp_id));
            }
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }   
}
