<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Form\Annotation\AnnotationBuilder;
use App\Form\AuthForm;
use App\Form\AuthRequest;

class AuthAction implements MiddlewareInterface
{
    private $template;
    private $authService;
    private $authAdapter;

    public function __construct(
      TemplateRendererInterface $template,
      AuthenticationServiceInterface $authService,
      AdapterInterface $authAdapter
    )
    {
      $this->template = $template;
      $this->authService = $authService;
      $this->authAdapter = $authAdapter;
    }
    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
      $builder = new AnnotationBuilder();
      $model  = new AuthRequest();
      $form    = $builder->createForm($model);
      $method = $request->getMethod();

      if ($method === 'POST') {
        $params = $request->getParsedBody();
        $form->setData($params);
        if ($form->isValid()) {
          $data = $form->getData();
          $this->authenticate($data);
        }
      }
      return new HtmlResponse($this->template->render('app::auth',['form'=>$form]));
    }

    private function authenticate(array $input)
    {
      $this->authAdapter->setUsername($input['username']);
      $this->authAdapter->setPassword($input['username']);
      $result = $this->authService->authenticate();
      return new RedirectResponse('/backend');
    }
}
