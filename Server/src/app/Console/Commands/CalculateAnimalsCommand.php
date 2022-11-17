<?php

namespace App\Console\Commands;

use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateAnimalsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animals:calculate {userId} {animalName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command calculates state (current age and size) of animals by created_at field';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $animals = Animal::where([
            'user_id' => $this->argument('userId'),
            'died_at' => null,
        ] + (
            $this->argument('animalName') ?
                [ 'name' => $this->argument('animalName') ] : []
            )
        )->with('animalKind')->get();

        foreach($animals as $animal) {
            $now = Carbon::now();
            $diff = $now->diffInSeconds($animal->created_at);
            $size = $diff * $animal->animalKind->growth_factor * 2;

            if($diff > 0) {
                $animal->update([
                    'size' => $size > $animal->animalKind->max_size ?
                        $animal->animalKind->max_size :
                        $size,
                    'age' => $diff,
                    'died_at' => $diff > $animal->animalKind->max_age ?
                         $animal->created_at->addSeconds($animal->animalKind->max_age) :
                         null,
                ]);
            }
        }

        $this->question($animals->count() . ' animals was updated');
        return Command::SUCCESS;
    }
}
