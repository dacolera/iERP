<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DepartamentoController  extends AbstractActionController
{
    public function indexAction()
    {
        $busca = $this->params()->fromQuery('busca', null);
        $field = $this->params()->fromQuery('field', null);
        
        $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
        $listaDepartamentos = $serviceDepartamento->pegarDepartamentos($field, $busca);
        
        $model = new ViewModel(['departamentos' => $listaDepartamentos]);
        return $model;
    }
    
    public function cadastrarAction()
    {
        if($this->getRequest()->isPost()) {
            
            $serviceDepartamento = $this->getServiceLocator()->get('Application\Service\Departamento');
            try {
                $serviceDepartamento->saveDepartamento(
                        $this->getRequest()->getPost()
                );
            } catch (\Eception $e) {
                throw $e;
            }

            $this->redirect()->toRoute('listarDepartamento');
        }
    }
}