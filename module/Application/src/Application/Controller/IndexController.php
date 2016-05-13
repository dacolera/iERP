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


        //$renderer->headTitle("ADMIN | Contjet");

        $model = new ViewModel();

        if(!isset($_SESSION['user']['logado']) || !$_SESSION['user']['logado']) {
            $this->logar();

            if(!$_SESSION['user']['logado']) {
                $this->layout()->setTemplate('layout/layout-deslogado');
                return $model;
            }
        }

        $model->setTemplate('application/index/dashboard.phtml');
        return $model;
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
    
    public function logar()
    {
        $users = array(
            array('user' => 'gustavo', 'senha' => 'gupsyfrito'),
            array('user' =>'joao' , 'senha' => 'antunes'),
            array('user' =>'dacolera' , 'senha' => '666007')
        );  

        $_SESSION['user']['logado'] = false;
        $login = $this->getRequest()->getPost()->get('login', false);
        $senha = $this->getRequest()->getPost()->get('password', false);

        foreach($users as $user) {
            if($login == $user['user'] && $senha == $user['senha']) {
                $_SESSION['user']['logado'] = true;
                $_SESSION['user']['nome'] = $login;
            }
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['user']);
        $this->redirect()->toRoute('home');
    }
    
    public function downloadAction()
    {
        $arquivo = "/home/contjet/bender/notas_1.zip";
        if (!file_exists($arquivo)) die('Arquivo inexistente ou localizacao errada'); 
        header("Content-Type: application/zip"); // informa o tipo do arquivo ao navegador
        header("Content-Length: ".filesize($arquivo)); // informa o tamanho do arquivo ao navegador
        header("Content-Disposition: attachment; filename=".basename($arquivo)); // informa ao navegador que é tipo anexo e faz abrir a janela de download, tambem informa o nome do arquivo
        readfile($arquivo); // lê o arquivo
        exit; // aborta pós-ações
    }

}
