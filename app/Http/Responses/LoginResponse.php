<?php

namespace App\Http\Responses;

use App\Enums\UserRole;
use App\Filament\Pages\AdminDashboard;
use App\Filament\Resources\PresenceResource;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        if (auth()->guard()->user()->role === UserRole::Admin) {
            return redirect()->to(AdminDashboard::getUrl());
        }

        if (auth()->guard()->user()->role === UserRole::Employee) {
            return redirect()->to(PresenceResource::getUrl('index'));
        }

        return parent::toResponse($request);
    }
}
