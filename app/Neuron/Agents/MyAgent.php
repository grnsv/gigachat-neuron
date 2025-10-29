<?php

declare(strict_types=1);

namespace App\Neuron\Agents;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Support\Str;
use NeuronAI\Agent;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\GigaChat\Config;
use NeuronAI\Providers\GigaChat\GigaChat;
use NeuronAI\Providers\HttpClientOptions;
use NeuronAI\SystemPrompt;

final class MyAgent extends Agent
{
    public function __construct(
        private readonly ConfigRepository $config,
        private readonly CacheRepository $cache,
    ) {}

    protected function provider(): AIProviderInterface
    {
        return new GigaChat(
            config: new Config(...$this->config->get('services.gigachat')),
            cache: $this->cache,
            verifyTLS: false,
            httpOptions: new HttpClientOptions(headers: ['X-Session-ID' => $this->getSessionId()]),
        );
    }

    private function getSessionId(): string
    {
        return $this->cache->remember(
            'my_agent:session_id',
            now()->endOfWeek(),
            fn (): string => (string) Str::uuid(),
        );
    }

    public function instructions(): string
    {
        return (string) new SystemPrompt(
            background: ["You are a friendly AI Agent created with NeuronAI framework."],
        );
    }
}
