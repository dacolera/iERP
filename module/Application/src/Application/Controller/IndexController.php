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

        $renderer->headTitle("ADMIN | Contjet");

       /* $objPHPExcel = new \PHPExcel;
        // Definimos o estilo da fonte
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        // Criamos as colunas
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Listagem de Credenciamento' )
            ->setCellValue('B1', "Nome " )
            ->setCellValue("C1", "Sobrenome" )
            ->setCellValue("D1", "E-mail" );

        // Podemos configurar diferentes larguras paras as colunas como padrão
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(90);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        // Também podemos escolher a posição exata aonde o dado será inserido (coluna, linha, dado);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, "Fulano");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 2, " da Silva");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 2, "fulano@exemplo.com.br");

        // Exemplo inserindo uma segunda linha, note a diferença no segundo parâmetro
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, "Beltrano");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 3, " da Silva Sauro");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 3, "beltrando@exemplo.com.br");

        // Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
        $objPHPExcel->getActiveSheet()->setTitle('Credenciamento para o Evento');

        // Cabeçalho do arquivo para ele baixar
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="arquivo_de_exemplo01.xls"');
        header('Cache-Control: max-age=0');
        // Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');

        // Acessamos o 'Writer' para poder salvar o arquivo
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        // Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
        $objWriter->save('php://output'); 

        exit;*/
        
        //$sessionUser = new Container('user');

        $model = new ViewModel();

        /*if(!$sessionUser->logado) {
            $this->layout()->setTemplate('layout/layout-deslogado');
            return $model;
        }*/

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
        //$sessionUser = new Container('user');
        //$sessionUser->logado = false;
        $login = $this->getRequest()->getPost()->get('login', false);
        $senha = $this->getRequest()->getPost()->get('password', false);

        foreach($users as $user) {
            if($login == $user['user'] && $senha == $user['senha']) {
               //$sessionUser->logado = true;
               //$sessionUser->nome = $login;
            }
        }
    }
}
