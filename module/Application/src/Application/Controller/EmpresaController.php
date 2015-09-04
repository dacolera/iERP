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
            foreach($this->getRequest()->getFiles()->toArray() as $arquivo) {
                $this->fileUpload($arquivo);
            } 
            exit;
            $serviceEmpresa = $this->getServiceLocator()->get('Application\Service\Empresa');
            try {
                $serviceEmpresa->saveEmpresa($this->getRequest()->getPost());
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
                $serviceEmpresa->saveEmpresa($this->getRequest()->getPost());
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
    
    protected function fileUpload($file)
    {
        $uploaddir = realpath(dirname(__FILE__)) .'/ierp/uploads/';
        $uploadfile = $uploaddir . basename($file['name']);
        

        echo '<pre>';
        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
            echo "Arquivo válido e enviado com sucesso.\n";
        } else {
            echo "Possível ataque de upload de arquivo!\n";
        }

        echo 'Aqui está mais informações de debug:';
        print_r($_FILES);

        print "</pre>";
    }

    public function exportarAction()
    {

    }
}