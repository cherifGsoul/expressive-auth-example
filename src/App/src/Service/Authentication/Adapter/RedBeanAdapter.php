<?php

namespace App\Service\Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use R;

class RedBeanAdapter implements AdapterInterface
{
  private $username;
  private $password;


    /**
   * Sets user username.
   */
  public function setUsername($username)
  {
      $this->username = $username;
  }

  /**
   * Sets password.
   */
  public function setPassword($password)
  {
      $this->password = (string)$password;
  }

  public function authenticate()
  {
    $user = R::findOne('user','username=:username',[':username'=>$this->username]);
    if ($user == null) {
      return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid credentials.']
            );
    }

    $bcrypt = new Bcrypt();
    $passwordHash = $user->password;

    if ($bcrypt->verify($this->password, $passwordHash)) {
            // Great! The password hash matches. Return user identity (username) to be
            // saved in session for later use.
            return new Result(
                    Result::SUCCESS,
                    $this->username,
                    ['Authenticated successfully.']);
    }
    return new Result(
               Result::FAILURE_CREDENTIAL_INVALID,
               null,
               ['Invalid credentials.']);
  }
}
