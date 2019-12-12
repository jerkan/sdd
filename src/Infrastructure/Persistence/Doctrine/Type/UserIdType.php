<?php


namespace App\Infrastructure\Persistence\Doctrine\Type;


use App\Domain\User\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Class UserIdType
 * @package App\Infrastructure\Persistence\Doctrine\Type
 */
class UserIdType extends Type
{
    const TYPE = 'user_id';

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param UserId $value
     * @param AbstractPlatform $platform
     * @return mixed|void
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return UserId
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new UserId($value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::TYPE;
    }
}