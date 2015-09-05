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
    protected $empresaEntity;
    protected $usuarioEntity;
    protected $enderecoEntity;

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
        $certDig = $files['certificado-digital'] ? $files['certificado-digital'] : $dados['certificado-digital'];
        $contrato = $files['contrato'] ? $files['contrato'] : $dados['contrato'];

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
    
    public function exportExcel($filter)
    {
        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();
        
        // Definimos o estilo da fonte
        
        $num_registros = count($filter);
        if($num_registros > 0 ) {
            
            $objPHPExcel->getActiveSheet()->getStyle('Z1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $campos = [];
            $count = 0;
    
            foreach ($filter[0] as $chave => $fields)
            {
                $campos[] =  \Application\Utils\StringConversion::indexToTitle($chave);
                $normalizeField[] = $chave;
                
            }
            foreach ( range('A', $objPHPExcel->getActiveSheet()->getHighestColumn()) as $column_key) {
                $objPHPExcel->getActiveSheet()->getStyle($column_key.'1')->getFont()->setBold(true);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($column_key.'1', $campos[$count]);
                if($column_key != 'A') 
                    $objPHPExcel->getActiveSheet()->getColumnDimension($column_key)->setWidth(30);
                $count++;    
            }
            $row=2;
            foreach($filter as $linha) {
                for($i = 0 ; $i < count($normalizeField); $i++) {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, $row, $linha[$normalizeField[$i]]);
                }
                $row++;
            }
        } else {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Não existem registros para serem exibidos !");
        }    
        // Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
        $objPHPExcel->getActiveSheet()->setTitle('Listagem de Empresas');
        
        // Cabeçalho do arquivo para ele baixar
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="listagem_empresas.xls"');
        header('Cache-Control: max-age=0');
        // Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');
        
        // Acessamos o 'Writer' para poder salvar o arquivo
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        
        // Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
        $objWriter->save('php://output'); 
        
        exit;
    }
}