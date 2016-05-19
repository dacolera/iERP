<?php

namespace Application\Service;

use Application\Entity\Departamento as DepartamentoEntity;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class Departamento extends implements ServiceManagerAwareInterface
{
    protected $serviceManager;

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getService()
    {
        return $this->serviceManager;
    }

    public function saveDepartamento($dados)
    {
        $id = $dados['id_departamento'] ? $dados['id_departamento'] : null;

        $DepartamentoEntity = new DepartamentoEntity;
        $DepartamentoEntity
            ->setId($id)
            ->setDataCadastro(date('Y-m-d H:i:s'))
            ->setStatus('A');

        $enderecoEntity = new EnderecoEntity;    
        $enderecoEntity
            ->setId($end_id)
            ->setLogradouro($dados['logradouro'])
            ->setNumero($dados['numero'])
            ->setComplemento($dados['complemento'])
            ->setBairro($dados['bairro'])
            ->setMunicipio($dados['municipio'])
            ->setCep($dados['cep'])
            ->setEstado($dados['estado']);

        $empresaEntity = new EmpresaEntity;
        $empresaEntity
             ->setId($id)
             ->setUsuario($usuarioEntity)
             ->setRazaoSocial($dados['razao-social'])
             ->setNomeFantasia($dados['nome-fantasia'])
             ->setCnpj($dados['cnpj'])
             ->setEndereco($enderecoEntity)
             ->setInscricaoMunicipal($dados['inscricao-municipal'])
             ->setInscricaoEstadual($dados['inscricao-estadual'])
             ->setCNAEPrincipal($dados['cnae-principal'])
             ->setCNAESecundario($dados['cnae-secundario'])
             ->setRegimeTributacao($dados['regime-tributacao'])
             ->setValorHonorarios(Money::toFloat($dados['valor-honorarios']))
             ->setVencimentoHonorarios(Conversion::conversion($dados['vencimento-honorarios']))
             ->setVencimentoProcuracaoCaixa(Conversion::conversion($dados['vencimento-procuracao-caixa']))
             ->setVencimentoProcuracaoRFB(Conversion::conversion($dados['vencimento-procuracao-rfb']))
             ->setCertificadoDigital($certDig)
             ->setSenhaWeb($dados['senha-web'])
             ->setSenhaFazenda($dados['senha-fazenda'])
             ->setTipoEmpresa($dados['tipo-empresa'])
             ->setContrato($contrato)
             ->setVencimentoContrato(Conversion::conversion($dados['vencimento-contrato']));

        try {
            $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');
            $id = $mapperEmpresa->save($empresaEntity);
        } catch (\Exception $e) {
           throw $e;
        }
        return $id;
    }

    public function pegarEmpresas($field = null, $busca = null)
    {
        $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');

        $empresas = $mapperEmpresa->loadAllEmpresas($field, $busca);
        $empresasArray = [];
        foreach($empresas->getDataSource() as $empresa) {
            $empresasArray[] = $empresa;
        }
        return $empresasArray;
    }
    
    public function pegarEmpresasForExcel()
    {
        $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');
        
        return $mapperEmpresa->loadAllEmpresas();
    }

    public function pegarEmpresaPorId($id)
    {
        $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');

        return $mapperEmpresa->loadEmpresaById($id);
    }

    public function pegarEmpresasOrdenadas($campo, $order)
    {
        $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');

        $empresas = $mapperEmpresa->loadEmpresasInOrder($campo, $order);
        $empresasOrdenadas = [];
        foreach($empresas->getdataSource() as $empresa) {
            $empresasOrdenadas[] = $empresa;
        }
        return $empresasOrdenadas;
    }

    public function deletarEmpresa($id)
    {
        $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');
        return  $mapperEmpresa->deletarEmpresa($id);
    }

    public function suspenderAtivarToogleEmpresa($id, $status)
    {
        $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');
        $novoStatus = $status == 'Ativa' ? 'A' : 'S';
        return  $mapperEmpresa->suspenderAtivarToogleEmpresa($id, $novoStatus);
    }
    
}
