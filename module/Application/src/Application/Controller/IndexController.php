<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
/*
        $service=$this->getServiceLocator()->get('Application\Service\Produto');
        $service->insert(array(
            'categoriaId'=>'1',
            'nome'=>'footboll',
            'descricao'=>'game de futbool'

        ));
       // $entity=$service->delete(3);


        $em=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repos=$em->getRepository('Application\Entity\Categoria');
        $categorias=$repos->findAll();


        return new ViewModel(array('categorias'=>$categorias));*/
    }
}
