<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Todo;

class ClearOldTodos extends Command
{
    protected $signature = 'oldTodos:clear';
    protected $description = 'Clears todos older than 7 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $borderTime = date('yy-m-d H:i:s', strtotime("-7 days"));
        $todos = Todo::whereDate('execution_time', '<', $borderTime)->get();

        if($todos->count() > 0)
        {
            Todo::whereDate('execution_time', '<', $borderTime)->delete();
            $this->output->write('Todos older than 7 days have been deleted.');

            return true;
        }
        else
        {
            $this->output->write('Nothing to delete. None of the todos is older than 7 days');

            return false;
        }
    }
}
