<?php

namespace App\Repository;

use App\Entity\Nutrition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nutrition>
 *
 * @method Nutrition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nutrition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nutrition[]    findAll()
 * @method Nutrition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NutritionRepository extends ServiceEntityRepository
{
    protected $_entityName = Nutrition::class;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nutrition::class);
    }

    public function save(Nutrition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    public function remove(Nutrition $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
