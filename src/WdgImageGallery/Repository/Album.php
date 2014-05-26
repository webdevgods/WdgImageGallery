<?php
namespace WdgImageGallery\Repository;

use Doctrine\ORM\EntityRepository;

class Album extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\Query
     */
    public function findAlphaPaginationQuery()
    {
        return $this->createQueryBuilder("p")
                ->select("p")
                ->orderBy("p.title", "DESC")
                ->getQuery();
    }
}