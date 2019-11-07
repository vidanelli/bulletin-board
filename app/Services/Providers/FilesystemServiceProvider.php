<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Services\Providers;

use App\Core\Di\ServiceProvider;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use League\Flysystem\Plugin\ListFiles;
use function App\Helpers\storagePath;
use function App\Helpers\systemPath;
use function App\Helpers\tmpPath;

class FilesystemServiceProvider extends ServiceProvider
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
