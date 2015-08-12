<?php
/**
 * Created by PhpStorm.
 * User: israel
 * Date: 04/08/15
 * Time: 10:02
 */

namespace SONUser\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;
class DoctrineAdapter implements AdapterInterface
{

    protected $em;
    protected $username;
    protected $password;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {

        $repos=$this->em->getRepository('SONUser\Entity\User');
        $user=$repos->findBy(array('username'=>$this->getUsername(),'password'=>$this->getPassword()));

        if($user)
        {
            return new Result(Result::SUCCESS,array('user'=>$user),array('messages'=>"OK"));
        }
        else
        {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID,null,array());
        }

    }


}