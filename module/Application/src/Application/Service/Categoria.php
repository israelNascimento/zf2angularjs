<?php
/**
 * Created by PhpStorm.
 * User: israel
 * Date: 03/08/15
 * Time: 16:26
 */

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Categoria as CategoriaEntity;
class Categoria
{

    private $em;

    function __construct(EntityManager $em)
    {
        $this->em=$em;
    }

    public function insert($name)
    {
        $categoriaEntity=new CategoriaEntity();
        $categoriaEntity->setName($name);

        $this->em->persist($categoriaEntity);

        $this->em->flush();

        return $categoriaEntity;

    }

    public function update(array $data)
    {
        $categoriaEntity = $this->em
            ->getReference('Application\Entity\Categoria', $data['id']);

        $categoriaEntity->setName($data['name']);

        $this->em->persist($categoriaEntity);
        $this->em->flush();

        return $categoriaEntity;

    }

    public function delete($id)
    {
        $categoriaEntity=$this->em->getReference('Application\Entity\Categoria',$id);

        if($categoriaEntity)
        {
            $this->em->remove($categoriaEntity);
            $this->em->flush();
            return $id;
        }


    }
}