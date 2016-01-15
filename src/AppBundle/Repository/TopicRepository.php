<?php

namespace AppBundle\Repository;

/**
 * TopicRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TopicRepository extends \Doctrine\ORM\EntityRepository
{

    public function getTopics()
    {
        return $this->getEntityManager()
            ->createQuery("
                SELECT t FROM AppBundle:Topic t ORDER BY t.name ASC
            ")->execute();
    }


    public function getAllWithCount()
    {
        return $this->getEntityManager()
            ->createQuery("
                SELECT t, s, count(s.id) as total
                FROM AppBundle:Topic t
                JOIN t.subscriptions s
                ORDER BY t.name ASC
            ")
            ->execute();
    }


}
