<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Livewire\Attributes\Title;

// use function Laravel\Prompts\password;

#[Title('ForgotPassword')]

class ForgotPasswordPage extends Component
{
    public $email;
    public function save()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255'
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);
        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'Password Rest Link Has been Sent to Your Email Addess.');
            $this->email = '';
        }
    }
    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}