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
        
        $serviceEmp = $this->getServiceLocator()->get('Application\Service\Empresa');
        $listaEmpresas = $serviceEmp->pegarEmpresasForExcel();
        $this->exportExcel($listaEmpresas);
        
        $renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
        
        $renderer->headMeta()->appendName('keywords', 'contabilidade-fiscal');
        $renderer->headMeta()->appendName('description', 'Escrituracao fiscal, contabilidade de empresas');

        $mapperEmpresa = $this
                        ->getServiceLocator()
                        ->get('Application\Mapper\Empresa');

        $renderer->headTitle("ADMIN | Contjet");

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
    
    public function tablesAction()
    {
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


    protected function exportExcel($filter)
    {
        set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__ . '/../../../../../public/Pear'));
        set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__ . '/../../../../../public'));
        require_once('Spreadsheet/Excel/Writer.php');
        header("Content-type: application/Octet-Stream");
        header("Content-Disposition: inline; filename=Imprensa.xls");
        header("Content-Disposition: attachment; filename=Imprensa.xls");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

        $xls = new \Spreadsheet_Excel_Writer();
        $xls->SetVersion(8);

        $format['titulo'] =& $xls->addFormat(array('bold' => 1, 'align' => 'center', 'size' => 11, 'fontFamily' => 'Arial'));
        $format['subtitulo'] =& $xls->addFormat(array('bold'=>1, 'size'=>8, 'fontFamily'=>'arial', 'align'=>'center', 'fgColor' => 'silver', 'borderColor' => 'black', 'border'=>1));
        $format['subtitulo-esq'] =& $xls->addFormat(array('bold'=>1, 'size'=>8, 'fontFamily'=>'arial', 'align'=>'left', 'fgColor' => 'silver', 'borderColor' => 'black', 'border'=>1));
        $format['normal'] =& $xls->addFormat(array('bold'=>0, 'size'=>8, 'fontFamily'=>'arial', 'borderColor' => 'black', 'border'=>1));
        $format['normal-esq'] =& $xls->addFormat(array('bold'=>0, 'size'=>8, 'fontFamily'=>'arial', 'borderColor' => 'black', 'border'=>1, 'align'=>'left'));
        $format['normal-cen'] =& $xls->addFormat(array('bold'=>0, 'size'=>8, 'fontFamily'=>'arial', 'borderColor' => 'black', 'border'=>1, 'align'=>'center'));
        $format['normal-gray'] =& $xls->addFormat(array('bold'=>0, 'size'=>8, 'fontFamily'=>'arial', 'borderColor' => 'black', 'border'=>1, 'fgColor' => 'silver'));
        $format['normal-esq-gray'] =& $xls->addFormat(array('bold'=>0, 'size'=>8, 'fontFamily'=>'arial', 'borderColor' => 'black', 'border'=>1, 'align'=>'left', 'fgColor' => 'silver'));
        $format['normal-cen-gray'] =& $xls->addFormat(array('bold'=>0, 'size'=>8, 'fontFamily'=>'arial', 'borderColor' => 'black', 'border'=>1, 'align'=>'center', 'fgColor' => 'silver'));
        $plan =& $xls->addWorksheet('Empresas');

        $plan->writeString(0, 0, 'Listagem de Empresas', $format['titulo']);
        $plan->setMerge(0, 0, 0, 4);
        $plan->setColumn(0, 0, 15);
        $plan->setColumn(1, 1, 20);
        $plan->setColumn(2, 2, 20);
        $plan->setColumn(3, 3, 50);
        $plan->setColumn(4, 4, 15);

        $plan->writeString(2, 0, 'Código', $format['subtitulo']);
        $plan->writeString(2, 1, 'Tipo', $format['subtitulo']);
        $plan->writeString(2, 2, 'Data', $format['subtitulo']);
        $plan->writeString(2, 3, 'Título', $format['subtitulo']);
        $plan->writeString(2, 4, 'Status', $format['subtitulo']);

        
        
        $totalRegistros = count($filter) ;

        if ($totalRegistros > 0) {
            $linha = 3;
            $rsRegistros = $filter;
            foreach ($rsRegistros as $record) {
                $plan->writeString($linha, 0, $record->getCodigo(), $format["normal-cen"]);
                $plan->writeString($linha, 1, $record->getRazaoSocial(), $format["normal-cen"]);
                $plan->writeString($linha, 2, $record->getNomeFantasia(), $format["normal-cen"]);
                $plan->writeString($linha, 3, $record->getCnpj(), $format["normal"]);
                $plan->writeString($linha, 4, Application\Model\Rotulos::$tipoEmpresa[$record->getTipoEmpresa()], $format["normal-cen"]);
                $linha++;
            }
            unset($rsRegistros);
        } else {
            $plan->writeString(3, 0, 'Sem registros para exibição', $format["normal-cen"]);
            for ($c = 1; $c <= 4; $c++) {
                $plan->writeString(3, $c, '', $format["normal-cen"]);
            }
            $plan->setMerge(3, 0, 3, 4);
        }
        unset($filter);

        $xls->close();
    }
}
