<?php

namespace CoyoteSoftware\Coyotomic;

use Composer\Plugin\PluginInterface;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Script\ScriptEvents;
use Composer\Script\Event as ScriptEvent;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Util\Filesystem;


class InstallPlugin implements PluginInterface, EventSubscriberInterface
{
    public function deactivate(Composer $composer, IOInterface $io)
    {
        // Implement any necessary deactivation logic here
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // Implement any necessary uninstallation logic here
    }


    public function activate(Composer $composer, IOInterface $io)
    {
        $this->generateFilesAndFolders(new Filesystem());
        $this->copyBuildToRoot(new Filesystem());
    }

    private function generateFilesAndFolders(Filesystem $fs)
    {
        // Generate files and folders
    }

    private function copyBuildToRoot(Filesystem $fs)
    {
        // Copy the entire build folder to the project root
        $buildDir = __DIR__ . '/Build'; // Replace this path with your build directory path
        $rootDir = getcwd() . '/Coyotomic';
        $fs->ensureDirectoryExists($rootDir);

        $fs->copy($buildDir, $rootDir);
    }

    public static function getSubscribedEvents()
    {
        return [
            ScriptEvents::POST_AUTOLOAD_DUMP => 'onPostAutoloadDump',
        ];
    }

    public function onPostAutoloadDump(ScriptEvent $event)
    {
        // Activate the plugin when the post-autoload-dump event is triggered
        $composer = $event->getComposer();
        $io = $event->getIO();
        $this->activate($composer, $io);
    }
    
    private function configureTwig(Filesystem $fs)
    {
        $twigConfig = <<<EOL
twig:
    paths:
        - '%kernel.project_dir%/coyotomic/levels': coyotomic
EOL;

        $fs->appendToFile('config/packages/twig.yaml', $twigConfig);
    }
}
