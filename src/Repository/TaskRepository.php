<?php

namespace App\Repository;

use App\Entity\Task;
use App\Enums\TaskStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findFiltered(array $filters): array
    {
        $qb = $this->createQueryBuilder('t');

        // Filtre par statut
        if (!empty($filters['status'])) {
            $status = TaskStatus::from($filters['status']); // convertit string → enum
            $qb->andWhere('t.status = :status')
               ->setParameter('status', $status);
        }

        // Filtre par priorité
        if (!empty($filters['priority'])) {
            $qb->andWhere('t.priority = :priority')
               ->setParameter('priority', $filters['priority']);
        }

        // Filtre par dossier
        if (!empty($filters['folder'])) {
            $qb->andWhere('t.folder = :folder')
               ->setParameter('folder', $filters['folder']);
        }

        // Tâches épinglées en premier
        $qb->orderBy('t.isPinned', 'DESC')
           ->addOrderBy('t.id', 'DESC');

        return $qb->getQuery()->getResult();
    }
}