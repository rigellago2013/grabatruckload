<?php

namespace App\Console\Commands\Loads;

use App\Models\Load;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class GetLoadHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loads:history {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output the history of a load';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $activities = Load::find($this->argument('id'))->activities;

        foreach ($activities as $activity) {
            if ($activity->event == 'created') {
                $this->info($activity->created_at . ': Load was created');
            }
            if ($activity->event == 'updated') {
                $this->info($activity->updated_at . ': Load was updated, the following fields were changed');
                $keys = (array_keys(array_diff(
                    Arr::dot($activity->properties['old']),
                    Arr::dot($activity->properties['attributes'])
                )));
                $data = [];
                foreach ($keys as $key) {
                    $data[] = [
                        $key,
                        $activity->properties['old'][$key],
                        $activity->properties['attributes'][$key],
                    ];
                }
                $this->table(['Key', 'From', 'To'], $data);
            }
        }

        return 0;
    }
}
