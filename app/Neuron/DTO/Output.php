<?php

namespace App\Neuron\DTO;

use NeuronAI\StructuredOutput\SchemaProperty;

class Output
{
    #[SchemaProperty(description: 'Значение вероятности в процентах.', required: true)]
    public float $percent;

    #[SchemaProperty(description: 'Причина выбора такого значения.', required: false)]
    public string $reason;
}
