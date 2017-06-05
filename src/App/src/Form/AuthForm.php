<?php

namespace App\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Zend\Form\Annotation\AnnotationBuilder;

class AuthForm extends Form
{
  private $authenticationService;
  private $authenticationAdapter;

  public function __construct()
  {
    parent::__construct('login-form');
    $this->setAttribute('method', 'post');



    $this->add(array(
      'type' => 'Csrf',
      'name' => 'csrf'
    ));

    $this->add(array(
      'name' => 'submit',
      'attributes' => array(
        'type' => 'submit',
        'value' => 'Login'
      )
    ));
  }
}
