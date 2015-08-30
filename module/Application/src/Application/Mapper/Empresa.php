<?php

namespace Application\Mapper;

use Application\Entity\Empresa as EmpresaEntity;

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
    public function loadAllEmpresas()
    {
        $sql = $this->getSelect()
            ->join('usr',
                'usr.usr_id = emp.usr_id', array()
            )
            ->join('endereco',
                'endereco.end_id = emp.end_id', array()
            );

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

        $this->delete('id ='. $id);
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
        return $this->select($sql)->getDataSource()->current();
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
        $db = $this->getDbAdapter();
        $con = $db->getDriver()->getConnection();
        $con->beginTransaction();

        try {
            if (!$empresa->getId()) {
                $empresa
                    ->setUsrId(
                        $this->usuarioMapper->insert($empresa->getUsuario())->getGeneratedValue()
                    )
                    ->setEnderecoId(
                        $this->enderecoMapper->insert($empresa->getEndereco())->getGeneratedValue()
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

                $this->usuarioMapper->update($arrayUser, "usr_id = ". $usr_id);
                $this->enderecoMapper->update($arrayEnd, "end_id = ". $end_id);
                $empresa
                    ->setUsrId($empresa->getUsuario()->getId())
                    ->setEnderecoId($empresa->getEndereco()->getId());

                $arrayEmp  = $this->getHydrator()->extract($empresa);
                $emp_id = $arrayEmp['id'];
                unset($arrayEmp['id']);

                parent::update($arrayEmp, "id = ". $emp_id);
            }
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }   
}
