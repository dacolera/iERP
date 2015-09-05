<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 29/08/15
 * Time: 12:56
 */

namespace Application\Controller;

use Application\Utils\DateConversion;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class EmpresaController  extends AbstractActionController{

    public function indexAction()
    {
        $empresaService = $this->getServiceLocator()->get('\Application\Service\Empresa');

        $dados = $empresaService->pegarEmpresas();

        $model = new ViewModel();
        $model->setVariable('empresas', $dados);
        //do something here
        return $model;
    }

    public function cadastrarAction()
    {
        if($this->getRequest()->isPost()) {
            
            $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Empresa');
            try {
                $serviceEmpresa->saveEmpresa(
                    
                        $this->getRequest()->getPost(),
                        $this->sanitizeFiles($this->getRequest()->getFiles())
                );
            } catch (\Eception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listar');
        }
        $model = new ViewModel();

        $dados = [];
        $dados['tipo-empresa'] = \Application\Model\Rotulos::$tipoEmpresa;
        $dados['estados'] = \Application\Model\Rotulos::$UF;

        $model->setVariable('combos', $dados);

        return $model;

    }

    public function editarAction()
    {
        if($this->getRequest()->isPost()) {
            $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Empresa');

            try {
                $serviceEmpresa->saveEmpresa(
                    $this->getRequest()->getPost(),
                    $this->sanitizeFiles($this->getRequest()->getFiles())
                );
            } catch (\Eception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listar');
        }

        $id =  $this->params()->fromRoute('id', false);

        if($id) {
            $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Empresa');
            $empresa = $serviceEmpresa->pegarEmpresaPorId($id);

            $model =  new ViewModel();
            $model->setVariable('empresa', $empresa);
            $model->setVariable('id', $id);

            return $model;
        }
    }

    public function deletarAction()
    {
        $id =  $this->params()->fromRoute('id', false);

        if($id) {
            $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Empresa');

            try {
                $serviceEmpresa->deletarEmpresa($id);
            } catch (\Exception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listar');
        }
    }

    public function ordenarAjaxAction()
    {
        if($this->getRequest()->isXmlHttpRequest()){
            $campo =  $this->params()->fromRoute('campo', false);
            $order =  $this->params()->fromRoute('order', false);

            if($campo && $order) {
                $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Empresa');
               $model = new ViewModel();
               $model->setTerminal(true);
               $arrayOrdenado = $serviceEmpresa->pegarEmpresasOrdenadas($campo, $order);
               echo  json_encode($arrayOrdenado);
               exit;
            }
        }
        $this->redirect()->toRoute('listar');
    }

    public function suspenderAtivarEmpresaToogleAjaxAction()
    {
        if($this->getRequest()->isXmlHttpRequest()){
            $id =  $this->params()->fromRoute('id', false);
            $status = $this->params()->fromRoute('status', false);
            if($id && $status) {
                $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Empresa');
                $model = new ViewModel();
                $model->setTerminal(true);
                try {
                    $serviceEmpresa->suspenderAtivarToogleEmpresa($id, $status);
                    $retorno = array('status' => 'ok');
                } catch (\Exception $e) {
                    throw $e;
                }
                echo  json_encode($retorno);
                exit;
            }
        }
        $this->redirect()->toRoute('listar');
    }
    
    public function exportarAction()
    {
            //pega o service de empresa
            $serviceEmp = $this->getServiceLocator()->get('Application\Service\Empresa');
            //pega o(s) parametros de filtro da rota ajax
            $filter = $this->params()->fromRoute('filter', false);
            //realiza a query e retorna array
            $listaEmpresas = $serviceEmp->pegarEmpresas();//$serviceEmp->pegarEmpresasExcel($filter);
            //chama o exporta excel
            $serviceEmp->exportExcel($listaEmpresas);
    }

    protected function fileUpload($file, $mod)
    {
        $uploaddir = realpath(__DIR__ .'/../../../../../data/upload/');
        $uploadfile = $uploaddir ."/{$mod}". basename($file['name']);

        try {
            move_uploaded_file($file['tmp_name'], $uploadfile);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    protected function filterFiles(array $files)
    {
        return array_filter($files, function($file){
            return $file['error'] == 0;
        });
    }

    protected function sanitizeFiles($FILES)
    {
        $files = [];
        foreach($this->filterFiles($FILES->toArray()) as $chave => $arquivo) {
            $mod = substr(md5(date('H:i:s')),0,5).'_';
            $files[$chave] = $mod.$arquivo['name'];
            $this->fileUpload($arquivo,$mod);
        }
        return $files;
    }
}