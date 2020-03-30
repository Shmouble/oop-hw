<?php

use Illuminate\Database\Seeder;
use App\Model\Todo;

class todo_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Todo::class, 10)->create();
    }
}
