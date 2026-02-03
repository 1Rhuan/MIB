<?php

namespace App\DTOs;

class CreateOrderDto
{
    public function __construct(
        public readonly int $product_id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $player_id,
        public readonly string $platform,
        public readonly ?string $nickname = null,
    )
    {}

    public static function fromArray(array $data): self
    {
        return new self(
            product_id: $data['product_id'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            email: $data['email'],
            player_id: $data['player_id'],
            platform: $data['platform'],
            nickname: $data['nickname'] ?? null,
        );
    }
}
