<?php
namespace MrOak\Command;

use DirectoryIterator;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CreateCommand extends Command
{
    private $moduleTemplatePath = '';

    protected function configure()
    {
        $this->setName('create')
             ->setDescription('Create a module')
             ->addArgument(
                'Template',
                InputArgument::REQUIRED,
                'Name of the template to use'
             )
             ->addArgument(
                'Module Path',
                InputArgument::REQUIRED,
                'Path of the module to create'
             )
             ->addOption(
                'namespace',
                's',
                InputOption::VALUE_REQUIRED,
                'Namespace for the module'
             );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $template = $input->getArgument('Template');
        $modulePath = $input->getArgument('Module Path');
        $moduleName = $this->getModuleName($modulePath);
        $namespace = $input->getOption('namespace');

        $this->validateTemplate($template);
        $this->validateModulePath($modulePath);
        $this->validateNamespace($namespace);

        $this->moduleTemplatePath = $this->getFullTemplatePath($template);

        $this->createFileStructure($modulePath, $moduleName, $namespace);

        echo sprintf(
            'Module "%s%s" created.%s',
            $namespace,
            $moduleName,
            "\n"
        );
    }

    private function validateTemplate($template)
    {
        if (!$this->getFullTemplatePath($template)) {
            echo "Cant locate template path\n";
            exit();
        }

        return true;
    }

    private function getFullTemplatePath($template)
    {
        // Check Current Vendor Directory
        $dir = sprintf('%s/../../vendor/%s', __DIR__, $template);
        if (is_dir($dir)) {
            return $dir;
        }

        // Check Parent Vendor Directory
        $dir = sprintf('%s/../../../../%s', __DIR__, $template);
        if (is_dir($dir)) {
            return $dir;
        }

        // Check Absolute Path
        if (is_dir($template)) {
            return $template;
        }

        return false;
    }

    private function validateNamespace($namespace)
    {
        if (substr($namespace, -1, 1) !== '\\') {
            echo "Please enter a valid namespace e.g. 'Acme\\'\n";
            exit();
        }
    }

    private function validateModulePath($modulePath)
    {
        if (is_dir($modulePath)) {
            echo sprintf(
                'Could not create "%s" as a module with that name already exists.%s',
                $modulePath,
                "\n"
            );
            exit();
        }
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

    private function createFileStructure($modulePath, $moduleName, $namespace)
    {
        $directoryList = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->moduleTemplatePath),
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
                $fileContents = str_replace('{Module}', $moduleName, $fileContents);
                $fileContents = str_replace('{Namespace}', $namespace, $fileContents);
                file_put_contents($target, $fileContents);
            }
        }
    }

    private function srcPath($directory)
    {
        return sprintf(
            '%s/%s/%s',
            $this->moduleTemplatePath,
            str_replace($this->moduleTemplatePath, '', $directory->getPath()),
            $directory->getFilename()
        );
    }

    private function targetPath($modulePath, $moduleName, $directory)
    {
        return sprintf(
            '%s/%s%s/%s',
            getcwd(),
            $modulePath,
            str_replace($this->moduleTemplatePath, '', $directory->getPath()),
            str_replace('{Module}', $moduleName, $directory->getFilename())
        );
    }
}
