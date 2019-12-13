<?php


namespace App\Shared\Infrastructure\Persistence\Doctrine\Type;


use App\Shared\Domain\User\UserName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Class UserNameType
 * @package App\Infrastructure\Persistence\Doctrine\Type
 */
class UserNameType extends Type
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
     * @param UserName $value
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
     * @return UserName
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new UserName($value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::TYPE;
    }
}