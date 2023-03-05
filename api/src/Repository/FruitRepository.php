<?php

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fruit>
 *
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{
    protected $_entityName = Fruit::class;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    public function save(Fruit $entity, bool $flush = false): void
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

    public function remove(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getFruitsWithPaging(?string $search, ?string $order, ?string $orderBy, ?int $offset, ?int $limit)
    {


        $params = new ArrayCollection();
        $where = [];
        $whereClause = '';
        $orderClause = '';
        $limitClause = '';


        if ($search) {
            $where[] = " name like '%' || :search || '%' ";
            $params->add(new Parameter(':search', $search));
        }

        if ($orderBy) {
            $orderBy = $this->getClassMetadata()->getColumnName($orderBy);
//            $orderBy = 'fefeqfeq';
            $orderClause = " order by $orderBy $order ";
        }

        if ($limit) {
            $limitClause = " limit $limit ";
            if ($offset)
                $limitClause .= "offset $offset";
        }

        if ($where) {
            $whereClause = ' where ' . implode(' and ', $where) . ' ';
        }


        $sql = <<<SQL
            select * from fruit f
                {$whereClause} {$orderClause} {$limitClause}
        SQL;

        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata(Fruit::class, 'f');

//        $d = 12/0;


        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameters($params);

        $result = $query->getResult();

        return $result;
    }


    public function getFavoriteFruitsWithPaging(?string $search, ?string $order, ?string $orderBy, ?int $offset, ?int $limit)
    {


        $params = new ArrayCollection();
        $where []= " favorite = true";
        $whereClause = '';
        $orderClause = '';
        $limitClause = '';




        if ($search) {
            $where[] = " name like '%' || :search || '%' ";
            $params->add(new Parameter(':search', $search));
        }

        if ($orderBy) {
            $orderBy = $this->getClassMetadata()->getColumnName($orderBy);
//            $orderBy = 'fefeqfeq';
            $orderClause = " order by $orderBy $order ";
        }

        if ($limit) {
            $limitClause = " limit $limit ";
            if ($offset)
                $limitClause .= "offset $offset";
        }

        if ($where) {
            $whereClause = ' where ' . implode(' and ', $where) . ' ';
        }


        $sql = <<<SQL
            select * from fruit f
                {$whereClause} {$orderClause} {$limitClause}
        SQL;

        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata(Fruit::class, 'f');

//        $d = 12/0;


        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameters($params);

        $result = $query->getResult();

        return $result;
    }


    public function countRows(string $search, bool $favorite = false)
    {
        $params = new ArrayCollection();
        $where = [];
        $whereClause = '';

        if ($search) {
            $where[] = " name like '%' || :search || '%' ";
            $params->add(new Parameter(':search', $search));
        }

        if ($favorite) {
            $where[] = "f.favorite = :favorite ";
            $params->add(new Parameter(':favorite', true, Types::BOOLEAN));
        }


        if ($where) {
            $whereClause = ' where ' . implode(' and ', $where) . ' ';
        }

        $sql = <<<SQL
            select count(*) as counts from fruit f
                {$whereClause} 
        SQL;

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('counts', 'counts', Types::INTEGER);

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameters($params);

        $result = $query->getSingleScalarResult();
        return $result;
    }

}
