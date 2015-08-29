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
                $this->usuarioMapper->update($empresa->getUsuario(), $empresa->getUsuario()->getId());
                $this->enderecoMapper->update($empresa->getEndereco(), $empresa->getEndereco()->getId());
                $empresa
                    ->setUsrId($empresa->getUsuario()->getId())
                    ->setEnderecoId($empresa->getEndereco()->getId());

                parent::update($empresa, $empresa->getId());
            }
            $con->commit();
        } catch (Exception $e) {
            $con->rollback();
            throw $e;
        }
    }   
}
