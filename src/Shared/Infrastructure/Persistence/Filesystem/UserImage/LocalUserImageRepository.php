<?php


namespace App\Shared\Infrastructure\Persistence\Filesystem\UserImage;


use App\Shared\Application\User\UserImageRepository;
use App\Shared\Domain\User\User;

/**
 * Class LocalUserImageRepository
 * @package App\Shared\Infrastructure\Persistence\Filesystem\UserImage
 */
class LocalUserImageRepository implements UserImageRepository
{
    /**
     * @var string
     */
    private $userImageDir;
    /**
     * @var string
     */
    private $userImageBaseUrl;

    /**
     * LocalUserImageRepository constructor.
     * @param string $userImageBaseUrl
     * @param string $userImageDir
     */
    public function __construct(
        string $userImageDir,
        string $userImageBaseUrl
    )
    {
        $this->userImageDir = $userImageDir;
        $this->userImageBaseUrl = $userImageBaseUrl;
    }

    /**
     * @inheritDoc
     */
    public function ofUser(User $user): string
    {
        $imageLocalPath = $this->getImageLocalPath($user);

        if (!file_exists($imageLocalPath)) {
            $this->createImage($user);
        }

        return $this->getImagePublicUrl($user);
    }

    /**
     * @param User $user
     * @return string
     */
    private function getImageFilename(User $user)
    {
        return sprintf('%s.png', $user->id());
    }

    /**
     * @param User $user
     * @return string
     */
    private function getImageLocalPath(User $user)
    {
        return sprintf('%s%s', $this->userImageDir, $this->getImageFilename($user));
    }

    /**
     * @param User $user
     * @return string
     */
    private function getImagePublicUrl(User $user)
    {
        return sprintf(
            '%s%s',
            $this->userImageBaseUrl,
            $this->getImageFilename($user)
        );
    }

    /**
     * @param User $user
     */
    private function createImage(User $user)
    {
        $im = imagecreate(250, 250);

        $col = imagecolorallocatealpha($im,255,255,255,127);
        imagefill($im, 0, 0, $col);
        imagetruecolortopalette($im, true, 256);
        imagepng($im, $this->getImageLocalPath($user));
        imagedestroy($im);
    }
}