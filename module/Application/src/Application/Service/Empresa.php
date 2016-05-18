<?php

namespace Application\Service;

use \Application\Entity\Empresa as EmpresaEntity;
use \Application\Entity\Usuario as UsuarioEntity;
use \Application\Entity\Endereco as EnderecoEntity;
use ZfcBase\EventManager\EventProvider;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Application\Utils\DateConversion as Conversion;
use Application\Model\Rotulos;
use Application\Utils\Money;

class Empresa extends EventProvider implements ServiceManagerAwareInterface
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

    public function saveEmpresa($dados, $files = null)
    {
        $id = $dados['id'] ? $dados['id'] : null;
        $usr_id = $dados['usr_id'] ? $dados['usr_id'] : null;
        $end_id = $dados['end_id'] ? $dados['end_id'] : null;
        $status = $dados['status'] ? $dados['status'] : 'A';
        $origem = $dados['origem'] ? $dados['origem'] : 'C';
        $certDig = isset($files['certificado-digital']) ? $files['certificado-digital'] : $dados['certificado-digital'];
        $contrato = isset($files['contrato']) ? $files['contrato'] : $dados['contrato'];

        $usuarioEntity = new UsuarioEntity;
        $usuarioEntity
            ->setId($usr_id)
            ->setDataCadastro(date('Y-m-d H:i:s'))
            ->setEmail($dados['email'])
            ->setLogin($dados['login'])
            ->setSenha($dados['senha'])
            ->setOrigem($origem)
            ->setStatus($status);

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