<?php


namespace App\Infrastructure\Persistence\Doctrine\Type;


use App\Domain\User\UserPassword;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Class UserPasswordType
 * @package App\Infrastructure\Persistence\Doctrine\Type
 */
class UserPasswordType extends Type
{
    const TYPE = 'user_password';

    /**
     * @inheritDoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param UserPassword $value
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
     * @return UserPassword
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new UserPassword($value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::TYPE;
    }
}