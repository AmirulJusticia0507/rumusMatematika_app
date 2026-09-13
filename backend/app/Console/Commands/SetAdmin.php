<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetAdmin extends Command
{
    protected $signature = 'user:admin {email} {--remove : Cabut status admin}';

    protected $description = 'Jadikan (atau cabut) seorang user sebagai admin';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if ($user === null) {
            $this->error("User dengan email '{$this->argument('email')}' tidak ditemukan.");

            return self::FAILURE;
        }

        $remove = (bool) $this->option('remove');

        $user->forceFill(['is_admin' => ! $remove])->save();

        $this->info("{$user->email} sekarang ".($remove ? 'BUKAN admin' : 'adalah admin').'.');

        return self::SUCCESS;
    }
}
