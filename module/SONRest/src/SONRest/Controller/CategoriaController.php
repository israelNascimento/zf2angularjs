<?php
/**
 * Created by PhpStorm.
 * User: israel
 * Date: 06/08/15
 * Time: 08:22
 */

namespace SONRest\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use JMS\Serializer;
class CategoriaController extends AbstractRestfulController
{


    public function getList()
    {
        $em=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repos=$em->getRepository('Application\Entity\Categoria');
        $data=$repos->findAll();

       /* $serializer =Serializer\SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($data, 'json');

            $response=new \Zend\Http\Response();
            $response->setContent($jsonContent);

            $headers=$response->getHeaders();
            $headers->addHeaderLine('Content-type','application/json');
            $response->setHeaders($headers);*/

       return $data;
        //return new JsonModel(array('data'=>$categorias));
    }

    public function get($id)
    {
        $em=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repos=$em->getRepository('Application\Entity\Categoria');
        $data=$repos->find($id);
        return $data;
    }

    public function create($data)
    {
       $service=$this->getServiceLocator()->get('Application\Service\Categoria');
        $data=$service->insert($data['name']);

        if($data)
        return $data;
        else
            return array('success'=>false);
    }

    public function update($id, $data)
    {
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categoria');
        $param['id'] = $id;
        $param['name'] = $data['name'];
        $categoria = $serviceCategoria->update($param);
        if($categoria) {
            return $categoria;
        } else {
            return array('success'=>false);
        }
    }

    public function delete($id)
    {
        $service=$this->getServiceLocator()->get('Application\Service\Categoria');
        $result=$service->delete($id);

        if($result)
            return $result;
        else
            return array('success'=>false);
    }



}