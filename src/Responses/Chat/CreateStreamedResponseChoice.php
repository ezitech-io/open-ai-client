<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

final class CreateStreamedResponseChoice
{
    private function __construct(
        public readonly int $index,
        public readonly CreateStreamedResponseDelta $delta,
        public readonly ?string $finishReason,
    ) {}

    /**
     * @param  array{index: int, delta?: array{role?: string, content?: string, reasoning?: string, annotations?: array}, finish_reason: string|null}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['index'],
            CreateStreamedResponseDelta::from($attributes['delta'] ?? []),
            $attributes['finish_reason'] ?? null,
        );
    }

    /**
     * @return array{index: int, delta: array{role?: string, content?: string, reasoning_content?: string}|array{role?: string, content: null, reasoning: null, annotations?: array, function_call: array{name?: string, arguments?: string}}, finish_reason: string|null}
     */
    public function toArray(): array
    {
        return [
            'index' => $this->index,
            'delta' => $this->delta->toArray(),
            'finish_reason' => $this->finishReason,
        ];
    }
}
