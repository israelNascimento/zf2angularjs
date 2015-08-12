<?php
/**
 * Created by PhpStorm.
 * User: israel
 * Date: 03/08/15
 * Time: 16:26
 */

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Produto as ProdutoEntity;
class Produto
{

    private $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $categoriaEntity=$this->em->getReference('Application\Entity\Categoria',$data['categoriaId']);
        $produtoEntity = new ProdutoEntity();
        $produtoEntity->setCategoria($categoriaEntity);
        $produtoEntity->setNome($data['nome']);
        $produtoEntity->setDescricao($data['descricao']);

        $categoriaEntity = $this->em->persist($produtoEntity);

        $this->em->flush();

        return $produtoEntity;

    }

    public function update(array $data)
    {
        $categoriaEntity = $this->em
            ->getReference('Application\Entity\Categoria', $data['categoriaId']);

        $produto = $this->em->getReference('Application\Entity\Produto', $data['id']);
        $produto->setNome($data['nome'])
            ->setDescricao($data['descricao'])
            ->setCategoria($categoriaEntity);

        $this->em->persist($produto);
        $this->em->flush();

        return $produto;

    }

    public function delete($id)
    {
        $produtoEntity = $this->em->getReference('Application\Entity\Produto', $id);

        if ($produtoEntity) {
            $this->em->remove($produtoEntity);
            $this->em->flush();
            return $id;
        }


    }
}
