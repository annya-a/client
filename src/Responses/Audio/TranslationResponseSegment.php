<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>
 */
final class TranslationResponseSegment implements ResponseContract
{
    /**
     * @readonly
     */
    public int $id;
    /**
     * @readonly
     */
    public int $seek;
    /**
     * @readonly
     */
    public float $start;
    /**
     * @readonly
     */
    public float $end;
    /**
     * @readonly
     */
    public string $text;
    /**
     * @var array<int, int>
     * @readonly
     */
    public array $tokens;
    /**
     * @readonly
     */
    public float $temperature;
    /**
     * @readonly
     */
    public float $avgLogprob;
    /**
     * @readonly
     */
    public float $compressionRatio;
    /**
     * @readonly
     */
    public float $noSpeechProb;
    /**
     * @readonly
     */
    public bool $transient;
    /**
     * @use ArrayAccessible<array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, int>  $tokens
     */
    private function __construct(int $id, int $seek, float $start, float $end, string $text, array $tokens, float $temperature, float $avgLogprob, float $compressionRatio, float $noSpeechProb, bool $transient)
    {
        $this->id = $id;
        $this->seek = $seek;
        $this->start = $start;
        $this->end = $end;
        $this->text = $text;
        $this->tokens = $tokens;
        $this->temperature = $temperature;
        $this->avgLogprob = $avgLogprob;
        $this->compressionRatio = $compressionRatio;
        $this->noSpeechProb = $noSpeechProb;
        $this->transient = $transient;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient?: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['seek'],
            $attributes['start'],
            $attributes['end'],
            $attributes['text'],
            $attributes['tokens'],
            $attributes['temperature'],
            $attributes['avg_logprob'],
            $attributes['compression_ratio'],
            $attributes['no_speech_prob'],
            $attributes['transient'] ?? false,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'seek' => $this->seek,
            'start' => $this->start,
            'end' => $this->end,
            'text' => $this->text,
            'tokens' => $this->tokens,
            'temperature' => $this->temperature,
            'avg_logprob' => $this->avgLogprob,
            'compression_ratio' => $this->compressionRatio,
            'no_speech_prob' => $this->noSpeechProb,
            'transient' => $this->transient,
        ];
    }
}
