<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; // <-- Adicionar esta linha
use Illuminate\Auth\Events\Registered; // <-- Adicionar esta linha

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     * Original: Redirecionava para '/home'
     * Modificado: Não será mais usado diretamente pelo método register sobrescrito.
     * @var string
     */
    // protected $redirectTo = '/home'; // Comentado ou removido

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // --- NOVO MÉTODO ADICIONADO ---
    /**
     * Handle a registration request for the application.
     * Sobrescreve o método padrão do trait RegistersUsers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // Cria o usuário e dispara o evento Registered
        event(new Registered($user = $this->create($request->all())));

        // *** Modificação Principal: Redireciona para o login em vez de logar ***
        // $this->guard()->login($user); // Linha removida/comentada para não logar automaticamente
        // return $this->registered($request, $user) ?: redirect($this->redirectPath()); // Linha removida/comentada

        // Redireciona para a página de login com uma mensagem flash
        return redirect()->route('login')->with('status', 'Cadastro realizado com sucesso! Faça o login para continuar.');
    }
    // --- FIM DO NOVO MÉTODO ---
}