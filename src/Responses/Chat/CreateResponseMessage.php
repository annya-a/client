<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateResponseMessage
{
    /**
     * @readonly
     */
    public string $role;
    /**
     * @readonly
     */
    public ?string $content;
    /**
     * @readonly
     */
    public ?CreateResponseFunctionCall $functionCall;
    private function __construct(string $role, ?string $content, ?CreateResponseFunctionCall $functionCall)
    {
        $this->role = $role;
        $this->content = $content;
        $this->functionCall = $functionCall;
    }
    /**
     * @param  array{role: string, content: ?string, function_call: ?array{name: string, arguments: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['role'],
            $attributes['content'] ?? null,
            isset($attributes['function_call']) ? CreateResponseFunctionCall::from($attributes['function_call']) : null,
        );
    }

    /**
     * @return array{role: string, content: string|null, function_call?: array{name: string, arguments: string}}
     */
    public function toArray(): array
    {
        $data = [
            'role' => $this->role,
            'content' => $this->content,
        ];

        if ($this->functionCall instanceof CreateResponseFunctionCall) {
            $data['function_call'] = $this->functionCall->toArray();
        }

        return $data;
    }
}
