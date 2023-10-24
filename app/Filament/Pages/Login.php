<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Facades\Filament;

class Login extends BaseAuth
{
    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }
}
