<?php

namespace App\Repository;

use App\Entity\Report;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Data\SearchData;

/**
 * @extends ServiceEntityRepository<Report>
 *
 * @method Report|null find($id, $lockMode = null, $lockVersion = null)
 * @method Report|null findOneBy(array $criteria, array $orderBy = null)
 * @method Report[]    findAll()
 * @method Report[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function findAllPlaces(): array
    {
        $reports = $this->findAll();

        foreach($reports as $item){
            $places[$item->getPlace()] = $item->getPlace();
        }

        return array_unique($places);
    }

    public function findSearch(SearchData $search): array
    {
        $query = $this
        ->createQueryBuilder('r');

        if(!empty($search->place) && $search->place!='Wszystkie' ){
            $query = $query
            ->andWhere('r.place = :place')
            ->setParameter('place', $search->place);
        }

        if(!empty($search->date_start)){
            $query = $query
            ->andWhere('r.date >= :date_start')
            ->setParameter('date_start', $search->date_start);
        }

        if(!empty($search->date_end)){
            $query = $query
            ->andWhere('r.date <= :date_end')
            ->setParameter('date_end', $search->date_end);
        }
        return $query->getQuery()->getResult();
    }
}
