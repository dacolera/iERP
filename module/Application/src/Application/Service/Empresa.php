<?php

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use \Application\Entity\Empresa as EmpresaEntity;
use \Application\Entity\Usuario as UsuarioEntity;
use \Application\Entity\Endereco as EnderecoEntity;

class Empresa
{
    protected $serviceLocator;
    protected $empresaEntity;
    protected $usuarioEntity;
    protected $enderecoEntity;

    public function __construct(EmpresaEntity $empresa, UsuarioEntity $usuario, EnderecoEntity $endereco)
    {
        $this->empresaEntity  = $empresa;
        $this->usuarioEntity  = $usuario;
        $this->enderecoEntity = $endereco;
    }

    public function setService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getService()
    {
        return $this->serviceLocator;
    }

    public function saveEmpresa($dados)
    {
        $id = $dados['id'] ? $dados['id'] : null;
        $usr_id = $dados['usr_id'] ? $dados['usr_id'] : null;
        $end_id = $dados['end_id'] ? $dados['end_id'] : null;

        $this->usuarioEntity
            ->setId($usr_id)
            ->setDataCadastro(date('Y-m-d H:i:s'))
            ->setEmail($dados['email'])
            ->setLogin($dados['login'])
            ->setSenha($dados['senha'])
            ->setOrigem('C')
            ->setStatus('A');

        $this->enderecoEntity
            ->setId($end_id)
            ->setLogradouro($dados['logradouro'])
            ->setNumero($dados['numero'])
            ->setComplemento($dados['complemento'])
            ->setBairro($dados['bairro'])
            ->setMunicipio($dados['municipio'])
            ->setCep($dados['cep'])
            ->setEstado($dados['estado']);

        $this->empresaEntity
             ->setId($id)
             ->setUsuario($this->usuarioEntity)
             ->setRazaoSocial($dados['razao-social'])
             ->setNomeFantasia($dados['nome-fantasia'])
             ->setCnpj($dados['cnpj'])
             ->setEndereco($this->enderecoEntity)
             ->setInscricaoMunicipal($dados['inscricao-municipal'])
             ->setInscricaoEstadual($dados['inscricao-estadual'])
             ->setCNAEPrincipal($dados['cnae-principal'])
             ->setCNAESecundario($dados['cnae-secundario'])
             ->setRegimeTributacao($dados['regime-tributacao'])
             ->setValorHonorarios($dados['valor-honorarios'])
             ->setVencimentoHonorarios($dados['vencimento-honorarios'])
             ->setVencimentoProcuracaoCaixa($dados['vencimento-procuracao-caixa'])
             ->setVencimentoProcuracaoRFB($dados['vencimento-procuracao-rfb'])
             ->setCertificadoDigital($dados['certificado-digital'])
             ->setSenhaWeb($dados['senha-web'])
             ->setSenhaFazenda($dados['senha-fazenda'])
             ->setTipoEmpresa($dados['tipo-empresa'])
             ->setContrato($dados['contrato'])
             ->setVencimentoContrato($dados['vencimento-contrato']);

        try {
            $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');
            $mapperEmpresa->save($this->empresaEntity);
        } catch (\Exception $e) {
           throw $e;
        }
    }

    public function pegarEmpresas()
    {
        $mapperEmpresa = $this->getService()->get('Application\Mapper\Empresa');

        $empresas = $mapperEmpresa->loadAllEmpresas();
        $empresasArray = [];
        foreach($empresas->getDataSource() as $empresa) {
            $empresasArray[] = $empresa;
        }
        return $empresasArray;
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