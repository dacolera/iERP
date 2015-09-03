<?php
namespace Application\Form;

use Zend\Form\Element\Text;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

class Example extends Form
{
    public function __construct()
    {
        parent::__construct('teste');
        
        $this->setAttribute('method', 'POST');

        $arquivo = new Text('nome');
        $arquivo->setLabel('Nome');
        $arquivo->setAttribute('class', 'form-control');
        $this->add($arquivo);

        $arquivo = new Text('email');
        $arquivo->setLabel('Email');
        $arquivo->setAttribute('class', 'form-control');
        $this->add($arquivo);

        $arquivo = new Text('telefone');
        $arquivo->setLabel('Telefone');
        $arquivo->setAttribute('class', 'form-control');
        $this->add($arquivo);

        $btn = new Submit('enviar');
        $btn->setValue('Enviar')
            ->setAttribute('class', 'btn btn-primary');
        $this->add($btn);
    }
} 