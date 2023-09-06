<?php

namespace OpenAI\Responses\Meta;

final class MetaInformationRateLimit
{
    /**
     * @readonly
     */
    public int $limit;
    /**
     * @readonly
     */
    public int $remaining;
    /**
     * @readonly
     */
    public string $reset;
    public function __construct(int $limit, int $remaining, string $reset)
    {
        $this->limit = $limit;
        $this->remaining = $remaining;
        $this->reset = $reset;
    }
    /**
     * @param  array{limit: int, remaining: int, reset: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['limit'],
            $attributes['remaining'],
            $attributes['reset'],
        );
    }
}
