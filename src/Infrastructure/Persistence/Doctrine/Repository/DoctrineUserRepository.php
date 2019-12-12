<?php


namespace App\Infrastructure\Persistence\Doctrine\Repository;


use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

/**
 * Class DoctrineUserRepository
 * @package App\Infrastructure\Persistence\Doctrine\Repository
 */
class DoctrineUserRepository extends ServiceEntityRepository implements UserRepository
{
    protected static $entityClass = User::class;
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, self::$entityClass);
        $this->em = $this->getEntityManager();
    }

    /**
     * @inheritDoc
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @inheritDoc
     */
    public function ofId(UserId $id): ?User
    {
        return $this->getEntityManager()->getRepository(self::$entityClass)->ofId($id);
    }

    /**
     * @inheritDoc
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(User $user): void
    {
        $this->em->remove($user);
        $this->em->flush();
    }
}