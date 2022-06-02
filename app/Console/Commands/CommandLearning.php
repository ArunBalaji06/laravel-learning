<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CommandLearning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:learning {name=balaji} {--queue} {--tag}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command all types are to learn';

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
        $argument = $this->argument('name');

        $queueOption = $this->option('queue');

        $tagOption = $this->option('tag');

        $question = $this->ask('What is your name?');

        $password = $this->secret('What is the password?');

        $confirmation = $this->confirm('Do you wish to continue?');

        $confirmation = $this->confirm('Do you wish to continue?',true);

        $anticipate = $this->anticipate('What is your name?', ['Arun', 'Balaji']);

        $choise = $this->choice(
            'What is your name?',
            ['Arun', 'Balaji'],
        );

        $default = $this->choice(
            'What is your name?',
            ['Arun', 'Balaji'],
            'Arun'
        );

        $multiselectoption = $this->choice(
            'What is your name?',
            ['Arun', 'Balaji'],
            $maxAttempts = 3,
            $allowMultipleSelections = 5
        );

        $this->info('The command was successful!');
        
        $this->error('Something went wrong!');

        $this->newLine();

        $this->newLine(5);

        $this->line('Display this on the screen');

        $users = $this->table(
            ['Name', 'Email'],
            User::all(['name', 'email'])->toArray()
        );

        $users = $this->withProgressBar(100, function ($user) {
            $count = 0;
            $count++;
        });
        return 0;
    }
}
