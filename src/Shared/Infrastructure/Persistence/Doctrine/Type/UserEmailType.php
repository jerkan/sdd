<?php


namespace App\Shared\Infrastructure\Persistence\Doctrine\Type;


use App\Shared\Domain\User\UserEmail;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Class UserEmailType
 * @package App\Shared\Infrastructure\Persistence\Doctrine\Type
 */
class UserEmailType extends Type
{
    const TYPE = 'user_email';

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param UserEmail $value
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
     * @return UserEmail
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new UserEmail($value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::TYPE;
    }
}