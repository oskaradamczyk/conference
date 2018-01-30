<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 14:18
 */

namespace AppBundle\Handler\Traits;


use Symfony\Component\Filesystem\Filesystem;

/**
 * Trait UploadableHandlerTrait
 * @package AppBundle\Handler\Traits
 */
trait UploadableHandlerTrait
{
    /** @var Filesystem */
    protected $fs;

    /** @var string */
    protected $archiveTempDir;

    /** @var string */
    protected $uploadDir;

    public function initTempDir(): void
    {
        if (!$this->fs->exists($this->archiveTempDir)) {
            $this->fs->mkdir($this->archiveTempDir);
            $this->fs->touch($this->archiveTempDir . '/.gitkeep');
            $this->fs->chmod($this->archiveTempDir, 0777, 0000, true);
        }
    }

    public function clearTempDir(): void
    {
        $this->fs->remove($this->archiveTempDir);
        $this->initTempDir();
    }
}
