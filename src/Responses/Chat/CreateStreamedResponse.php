<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\FakeableForStreamedResponse;

/**
 * @implements ResponseContract<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}|array{role?: string, content: null, function_call: array{name?: string, arguments?: string}}, finish_reason: string|null}>}>
 */
final class CreateStreamedResponse implements ResponseContract
{
    /**
     * @readonly
     */
    public string $id;
    /**
     * @readonly
     */
    public string $object;
    /**
     * @readonly
     */
    public int $created;
    /**
     * @readonly
     */
    public string $model;
    /**
     * @var array<int, CreateStreamedResponseChoice>
     * @readonly
     */
    public array $choices;
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}|array{role?: string, content: null, function_call: array{name?: string, arguments?: string}}, finish_reason: string|null}>}>
     */
    use ArrayAccessible;

    use FakeableForStreamedResponse;

    /**
     * @param  array<int, CreateStreamedResponseChoice>  $choices
     */
    private function __construct(string $id, string $object, int $created, string $model, array $choices)
    {
        $this->id = $id;
        $this->object = $object;
        $this->created = $created;
        $this->model = $model;
        $this->choices = $choices;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}, finish_reason: string|null}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $choices = array_map(fn (array $result): CreateStreamedResponseChoice => CreateStreamedResponseChoice::from(
            $result
        ), $attributes['choices']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['model'],
            $choices,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'model' => $this->model,
            'choices' => array_map(
                static fn (CreateStreamedResponseChoice $result): array => $result->toArray(),
                $this->choices,
            ),
        ];
    }
}
