<?php

namespace App\Console\Commands;

use App\Neuron\Agents\MyAgent;
use Illuminate\Console\Command;
use NeuronAI\Chat\Messages\UserMessage;

final class TestAgent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-agent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(MyAgent $agent)
    {
        $response = $agent->chat(
            new UserMessage("Hi, Who are you?")
        );

        $this->info($response->getContent());
    }
}
