<?php

namespace App\Services;

use App\Models\Code;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CodeService
{
    public function generate(int $count = 5): array
    {
        do {
            $codes = [];

            for ($i = 0; $i < $count; $i++) {
                $codes[] = $this->getCode();
            }
        } while (Code::whereIn('code', $codes)->exists());

        return $codes;
    }

    protected function getCode(): string
    {
        return Str::upper(fake()->bothify('????-###-????'));
    }
}
