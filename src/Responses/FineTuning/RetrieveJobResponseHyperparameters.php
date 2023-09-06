<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTuning;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{n_epochs: int}>
 */
final class RetrieveJobResponseHyperparameters implements ResponseContract
{
    /**
     * @readonly
     */
    public int $nEpochs;
    /**
     * @use ArrayAccessible<array{n_epochs: int}>
     */
    use ArrayAccessible;

    private function __construct(int $nEpochs)
    {
        $this->nEpochs = $nEpochs;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{n_epochs: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['n_epochs'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'n_epochs' => $this->nEpochs,
        ];
    }
}
