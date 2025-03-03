<?php

namespace App\Livewire\Users;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Mary\Traits\Toast;

class AuthenticateUser extends Component
{
    use Toast;

    public $username, $password;
    protected $listeners = [];

    public function authenticate()
    {
//        $this->toast('You are successfully logged in', 'success');
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $this->username, 'password' => $this->password])){
            Auth::login(Auth::user());
            $this->success('Login Successful !!', timeout: 3000);
            return redirect()->route('dashboard');
        }
        else{
            $this->error('Login Failed. Username and Password do not match !!', timeout: 3000);
        }

    }
    public function render()
    {
        return view('livewire.users.auth.authenticate-user');
    }
}
