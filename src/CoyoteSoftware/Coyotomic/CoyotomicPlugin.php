<?php

namespace CoyoteSoftware\Coyotomic;

use Composer\Plugin\PluginInterface;

class CoyotomicPlugin implements PluginInterface, EventSubscriberInterface
{
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
        $buildDir = __DIR__ . '/../../Coyotomic'; // Replace this path with your build directory path
        $rootDir = getcwd();

        $fs->copyThenRemove($buildDir, $rootDir);
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
