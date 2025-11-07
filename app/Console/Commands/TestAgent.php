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
    protected $description = 'Test NeuronAI + GigaChat agent';

    /**
     * Execute the console command.
     */
    public function handle(MyAgent $agent)
    {
        $response = $agent->structured(
            new UserMessage('Какова вероятность в процентах, что ИИ в этом году захватит мир?'),
        );

        $this->info(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
