<?php

namespace App\Commands;

use App\Helper\TemplateHelper;
use App\Model\File;
use App\Model\Module;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Storage;
use LaravelZero\Framework\Commands\Command;

/**
 * Class MagentoModule
 * @package App\Commands
 */
class MagentoModule extends Command
{
    private const OPTIONS = [
        'command' => 'Command',
        'log' => 'Log',
        'graphql' => 'GraphQL',
        'composer' => 'Composer',
        'restapi' => 'Rest API'
    ];

    /**
     * @var array
     */
    private $addons = [];

    /**
     * @var Module
     */
    private $module;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:magento:module';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Make a Magento module';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->module = new Module();
        $vendorName = $this->ask('Vendor name?', 'SDM');
        $moduleName = $this->ask('Module name?');

        $this->module->setVendor($vendorName)->setName($moduleName);

        $this->additions();

        $this->createSimple();
        $this->createGraphQL();
        $this->createComposer();

//        $this->createRegistration();
//        $this->createModuleXML();
//        $this->createGraphQL();
//        $this->createGraphQLResolver();
//        $this->createLogger();

//        $selected = implode(',', $this->selectedOptions);
//        $this->info(TemplateHelper::getRootPath());
    }

    private function prepareModule()
    {

    }

    private function additions()
    {
        while (array_diff(self::OPTIONS, $this->addons)) {
            $key = $this->menu(sprintf('%s Module | selected additions: (%s)', $this->module->getName(),
                implode(',', $this->addons)),
                array_diff(self::OPTIONS, $this->addons))
                ->setExitButtonText(">> Finish <<")
                ->open();

            if ($key === null) {
                break;
            }

            $this->addons[$key] = self::OPTIONS[$key];
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    /**
     * @param File $file
     * @return File
     */
    private function create(File $file): File
    {
        $file->setContent(TemplateHelper::getMagentoModulePath($file->getName(), $file->getVariables()));
        Storage::put($this->getModulePath() . $file->getPath() . $file->getName(), $file->getContent());

        return $file;
    }

    private function createSimple(): void
    {
        // Create registration.php
        $this->create(
            (new File())->setName('registration.php')->setVariables([
                'module_name' => $this->module->getName()
            ])->setPath('/')
        );

        // Create module.xml
        $this->create(
            (new File())->setName('module.xml')->setVariables([
                'module_name' => $this->module->getName()
            ])->setPath('/etc/')
        );
    }


    private function createGraphQL(): void
    {
        // Create schema.graphqls
        $this->create(
            (new File())->setName('schema.graphqls')->setVariables([
                'module_name' => $this->module->getName()
            ])->setPath('/etc/')
        );

        // Create Resolver
        $this->create(
            (new File())->setName('Resolver.php')->setVariables([
                'module_name' => $this->module->getName()
            ])->setPath('/Model/Resolver/')
        );
    }

    private function createComposer(): void
    {
        // Create composer.json
        $this->create(
            (new File())->setName('composer.json')->setVariables([
                'module_name' => $this->module->getName(),
                'package_name' => strtolower($this->module->getName())
            ])->setPath('/')
        );

        // Create .gitignore
        $this->create((new File())->setName('.gitignore')->setPath('/'));
    }

    private function createRestAPI()
    {
        $webapi = 'webapi.xml';
        $restInterface = 'RestInterface.php';
        $restClass = 'Rest.php';
    }

    private function createLogger(): bool
    {
        $logger = 'Logger.php';
        $handler = 'Info.php';
        $di = 'di.xml';
        $loggerName = strtolower($this->moduleName);

        $loggerContent = TemplateHelper::getMagentoModulePath($logger, [
            'module_name' => $this->moduleName
        ]);
        $handlerContent = TemplateHelper::getMagentoModulePath($handler, [
            'module_name' => $this->moduleName,
            'logger_name' => $loggerName
        ]);
        $diContent = TemplateHelper::getMagentoModulePath($di, [
            'module_name' => $this->moduleName,
            'logger_name' => $loggerName
        ]);

        $putLogger = Storage::put($this->getModulePath() . '/Logger/' . $logger, $loggerContent);
        $putHandler = Storage::put($this->getModulePath() . '/Logger/Handler/' . $handler, $handlerContent);
        $putDi = Storage::put($this->getModulePath() . '/etc/' . $di, $diContent);

        return $putLogger && $putHandler && $putDi;
    }

    private function createCommand(): bool
    {
        $command = 'Command.php';
        $di = 'di.xml';
        $commandName = strtolower($this->moduleName);

        $commandContent = TemplateHelper::getMagentoModulePath($command, [
            'module_name' => $this->moduleName,
            'command_name' => $commandName
        ]);

        $diContent = TemplateHelper::getMagentoModulePath($di, [
            'module_name' => $this->moduleName,
            'command_name' => $commandName
        ]);

        $putCommand = Storage::put($this->getModulePath() . '/Console/Command/' . $this->moduleName . $command,
            $commandContent);
        $putDi = Storage::put($this->getModulePath() . '/etc/' . $di, $diContent);

        return $putCommand && $putDi;
    }

    private function createDI()
    {
        $command = 'Command.php';
        $commandName = strtolower($this->moduleName);

        $logger = 'Logger.php';
        $handler = 'Info.php';
        $loggerName = strtolower($this->moduleName);

        $di = 'di.xml';
        $diData = ['module_name' => $this->moduleName];

        if (in_array('Command', $this->selectedOptions)) {
            $commandContent = TemplateHelper::getMagentoModulePath($command, [
                'module_name' => $this->moduleName,
                'command_name' => $commandName
            ]);

            $diData['command_name'] = $commandName;

            Storage::put($this->getModulePath() . '/Console/Command/' . $this->moduleName . $command, $commandContent);
        }

        if (in_array('Log', $this->selectedOptions)) {
            $loggerContent = TemplateHelper::getMagentoModulePath($logger, [
                'module_name' => $this->moduleName
            ]);
            $handlerContent = TemplateHelper::getMagentoModulePath($handler, [
                'module_name' => $this->moduleName,
                'logger_name' => $loggerName
            ]);

            $diData['logger_name'] = $loggerName;

            Storage::put($this->getModulePath() . '/Logger/' . $logger, $loggerContent);
            Storage::put($this->getModulePath() . '/Logger/Handler/' . $handler, $handlerContent);
        }

        Storage::put($this->getModulePath() . '/etc/' . $di, $diContent);
    }

    private function getModulePath(): string
    {
        return 'app/code/SDM/' . $this->moduleName . '/';
    }
}
