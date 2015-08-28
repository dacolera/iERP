<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        
        $renderer->headMeta()->appendName('keywords', 'contabilidade-fiscal');
        $renderer->headMeta()->appendName('description', 'Escrituracao fiscal, contabilidade de empresas');

        $mapperEmpresa = $this
                        ->getServiceLocator()
                        ->get('Application\Mapper\Empresa');

        $renderer->headTitle("ADMIN | ");


        $entityEmp = new \Application\Entity\Empresa();
        $entityEmp
            ->setRazaoSocial('empresa teste Ltda')
            ->setNomeFantasia('Emp teste')
            ->setCnpj('4736493842348230-8');

        $entityUser = new \Application\Entity\Usuario();
        $entityUser
            ->setDataCadastro(date('Y-m-d H:i:s'))
            ->setEmail('joao@contjet.com.br')
            ->setLogin('antunes')
            ->setSenha(md5('1q2w3e'))
            ->setOrigem('C')
            ->setStatus('A');

        $entityEnd = new \Application\Entity\Endereco();
        $entityEnd
            ->setLogradouro('Avenida Pompeia')
            ->setNumero('234')
            ->setComplemento('ao lado do estadio do palmeiras')
            ->setMunicipio('são paulo')
            ->setCep('12567-008')
            ->setEstado('SP');

        try {
            $mapperEmpresa->save($entityEmp, $entityUser, $entityEnd);
        } catch (\Exception $e) {
            print $e->getMessage();
            exit;
        }
        return new ViewModel();
    }
    
    public function formsAction()
    {
        return new ViewModel();
    }
    
    public function chartsAction()
    {
        $script = $this->getServiceLocator()->get('viewhelpermanager')->get('headScript');

        $script->appendFile("js/plugins/flot/jquery.flot.js");
        $script->appendFile("js/plugins/flot/jquery.flot.tooltip.min.js");
        $script->appendFile("js/plugins/flot/jquery.flot.resize.js");
        $script->appendFile("js/plugins/flot/jquery.flot.pie.js");
        $script->appendFile("js/plugins/flot/flot-data.js");

        return new ViewModel();
    }
    
    public function tablesAction()
    {
        return new ViewModel();
    }
    
    public function bootstrapElementsAction()
    {
        return new ViewModel();
    }
}
