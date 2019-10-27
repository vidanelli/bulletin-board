<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Services\Providers;

use Phalcon\Di\ServiceProviderInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use League\Flysystem\Plugin\ListFiles;
use function BulletinBoardProject\Helpers\storagePath;
use function BulletinBoardProject\Helpers\systemPath;
use function BulletinBoardProject\Helpers\tmpPath;

class FilesystemServiceProvider implements ServiceProviderInterface
{
    /**
     * The Service name.
     * @var string
     */
    protected $name = 'filesystem';

    /**
     * Register application service.
     *
     * @param \Phalcon\DiInterface $di
     * @return void
     */
    public function register(\Phalcon\DiInterface $di): void
    {
        $di->setShared($this->name,
            function () {
                /** @var \Phalcon\DiInterface $this */

                $storage = new Local(storagePath());
                $system = new Local(systemPath());
                $tmp = new Local(tmpPath());

                $manager = new MountManager();
                $manager->addPlugin(new ListFiles());
                $manager->mountFilesystem('storage', new Filesystem($storage))
                    ->mountFilesystem('system', new Filesystem($system))
                    ->mountFilesystem('tmp', new Filesystem($tmp));

                return $manager;
            }
        );
    }
}
