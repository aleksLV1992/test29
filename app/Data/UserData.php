<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    /**
     * @param int $id
     * @param string $name
     * @param string $email
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ) {}


    /**
     * @param User $user
     * @return self
     */
    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
        );
    }

    /***
     * @return array|mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
