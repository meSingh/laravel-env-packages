<?php

namespace meSingh\EnvPackages\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;

/**
 * Generates Lock file for packages config
 *
 * @package EnvPackages
 * @author Mandeep Singh <im@msingh.me>
 *
 **/
class GenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envpackages:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Lock file for enviroments specific packages configuration.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $packages = [];
        $config = config('envpackages');

        $packages['providers']         = $this->fixEnvironmentNames($config['providers']);
        $packages['aliases']           = $this->fixEnvironmentNames($config['aliases']);
        $packages['middlewares']       = $this->fixEnvironmentNames($config['middlewares']);
        $packages['routerMiddlewares'] = $this->fixEnvironmentNames($config['routerMiddlewares']);

        file_put_contents(app_path('../envpackages.lock'), json_encode($packages, JSON_PRETTY_PRINT));
    }

    /**
     * Fix multienvironment names to their given
     * arrays for processing.
     *
     * @param  array $config Configuration provided for a given requirement
     *
     * @return array
     */
    public function fixEnvironmentNames($config)
    {
        $values = [];
        foreach ($config as $key => $item) {
            $envs = explode(',', $key);

            if (count($envs) > 1) {
                foreach ($envs as $env) {
                    $values[$env] = $this->cleanValues($values, $env, $item);
                }
            } else {
                $values[$key] = $this->cleanValues($values, $key, $item);
            }
        };

        return $values;
    }

    /**
     * Cleanup any overlapping requiroments
     *
     * @param  array  $value Configuration provided for a given requirement
     * @param  string $env   Given environment value
     * @param  array  $item  Given requirement value
     *
     * @return array
     */
    public function cleanValues($value, $env, $item)
    {
        return isset($value[$env])
            ? array_values(
                array_unique(
                    array_merge(
                        $value[$env],
                        $item
                    )
                )
            )
            : $item;
    }
}
