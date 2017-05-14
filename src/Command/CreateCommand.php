<?php
namespace MrOak\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use DirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use FilesystemIterator;


class CreateCommand extends Command
{
    const MODULE_TEMPLATE_PATH = __DIR__ . '/../Module';

    protected function configure()
    {
        $this->setName('create')
            ->setDescription('Create a module')
            ->addArgument(
                'Module Path',
                InputArgument::REQUIRED,
                'Path of the module to create'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $modulePath = $input->getArgument('Module Path');
        $moduleName = $this->getModuleName($modulePath);

        $this->createFileStructure($modulePath, $moduleName);
    }

    private function getModuleName($path)
    {
        $path = explode('/', $path);
        $name = array_pop($path);

        if (empty($name)) {
            echo 'Invalid Module Name' . "\n";
            exit();
        }

        return $name;
    }

    private function createFileStructure($modulePath, $moduleName)
    {
        $directoryList = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(self::MODULE_TEMPLATE_PATH),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($directoryList as $pathName => $directory) {
            if (substr($pathName, -2, 2) == '..' || substr($pathName, -1, 1) == '.') {
                continue;
            }

            $src = $this->srcPath($directory);
            $target = $this->targetPath($modulePath, $moduleName, $directory);

            if ($directory->isDir()) {
                mkdir($target, 0775, true);
            } else {
                $fileContents = file_get_contents($src);
                $modifiedFileContents = str_replace('{Module}', $moduleName, $fileContents);
                file_put_contents($target, $modifiedFileContents);
            }
        }
    }

    private function srcPath($directory)
    {
        return sprintf(
            '%s/%s/%s',
            self::MODULE_TEMPLATE_PATH,
            str_replace(self::MODULE_TEMPLATE_PATH, '', $directory->getPath()),
            $directory->getFilename()
        );
    }

    private function targetPath($modulePath, $moduleName, $directory)
    {
        return sprintf(
            '%s/%s%s/%s',
            getcwd(),
            $modulePath,
            str_replace(self::MODULE_TEMPLATE_PATH, '', $directory->getPath()),
            str_replace('{Module}', $moduleName, $directory->getFilename())
        );
    }
}
