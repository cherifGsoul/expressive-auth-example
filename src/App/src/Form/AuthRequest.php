<?php

namespace App\Form;

use Zend\Form\Annotation;

/**
 * @Annotation\Name("auth")
 * @Annotation\Hydrator("Zend\Hydrator\ClassMethods")
 * @Annotation\Type("App\Form\AuthForm")
 */

class AuthRequest
{

    /**
    * @Annotation\Filter({"name":"StringTrim"})
    * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
    * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
    * @Annotation\Required(true)
    * @Annotation\Attributes({"type":"text"})
    * @Annotation\Options({"label":"Username:"})
    */
    private $username;

    /**
    * @Annotation\Filter({"name":"StringTrim"})
    * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":25}})
    * @Annotation\Required(true)
    * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
    * @Annotation\Attributes({"type":"password"})
    * @Annotation\Options({"label":"Password:"})
    */
    private $password;

    /**
     * Get the value of Username
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of Username
     *
     * @param mixed username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}
