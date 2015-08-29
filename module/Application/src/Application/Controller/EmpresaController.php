<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 29/08/15
 * Time: 12:56
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class EmpresaController  extends AbstractActionController{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function cadastrarAction()
    {
        if($this->getRequest()->isPost()) {

            $dados = $this->getRequest()->getPost();

            $entityUser = new \Application\Entity\Usuario();
            $entityUser
                ->setDataCadastro(date('Y-m-d H:i:s'))
                ->setEmail($dados['email'])
                ->setLogin($dados['login'])
                ->setSenha($dados['senha'])
                ->setOrigem('C')
                ->setStatus('A');

            $entityEnd = new \Application\Entity\Endereco();
            $entityEnd
                ->setLogradouro($dados['logradouro'])
                ->setNumero($dados['numero'])
                ->setComplemento($dados['complemento'])
                ->setBairro($dados['bairro'])
                ->setMunicipio($dados['municipio'])
                ->setCep($dados['cep'])
                ->setEstado($dados['estado']);

            $entityEmp = new \Application\Entity\Empresa();
            $entityEmp
                ->setUsuario($entityUser)
                ->setEndereco($entityEnd)
                ->setRazaoSocial($dados['razao-social'])
                ->setNomeFantasia($dados['nome-fantasia'])
                ->setCnpj($dados['cnpj']);

            try {
                $mapperEmpresa = $this->getServiceLocator()->get('Application\Mapper\Empresa');
                $mapperEmpresa->save($entityEmp);
            } catch (\Exception $e) {
                print $e->getMessage();
                exit;
            }

            $model =  new ViewModel();
            $model->setTemplate('application/empresa/sucesso.phtml');

            return $model;
        }
      die('erro ao cadastrar empresa');
    }

    public function editarAction()
    {

    }

    public function excluirAction()
    {

    }

    public function exportarAction()
    {

    }

    public function importar()
    {

    }
}