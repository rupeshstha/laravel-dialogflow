<?php

namespace BhaktijKoli\LaravelDialogflow\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class DialogflowIntent extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'dialogflow:intent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Dialogflow Intent handler';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'IntentHandler';

    /**
     * Get the class name from name input.
     *
     * @return string
     */
    protected function getClassName()
    {
        return ucwords(Str::camel($this->getNameInput()));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../stubs/intent.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name = null)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceClass($stub, $this->getClassName());
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        $stub = str_replace('{{class}}', $class, $stub);

        return $stub;
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return base_path() . '/app/Dialogflow/Intents/' . str_replace('\\', '/', $name) . '.php';
    }
}
