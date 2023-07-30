<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        // Selecciona todos los usuarios

        $usuarios = User::all();

        return view('users.index',compact('usuarios')) ;
    }


    public function create(){
        return view('users.create');
    }

    public function store(Request $request){

        $user= new User();

        //Si existe el usuario mandar alerta
        // Sino guardar los datos
        $this->validate($request, [
            'name' => ['required', 'string','unique:users'],
            'login' => ['required', 'string','unique:users'],
            'email' => ['required', 'string','unique:users'],
            'password' => ['required', 'string']
        ],
        // Errores personalizados
        [
            'name.unique' => 'Nombre de Usuario duplicado',
            'login.unique' => 'Nombre de Login duplicado',
            'email.unique' => 'Nombre de Email duplicado',

        ]);

            $user-> name= $request->name;
            $user-> login= $request->login;
            $user-> email= $request->email;
            $user-> password=  Hash::make($request->password);
            $user->activated = ($request->activated ? '1' : '0') ;

            $user->save();



        return redirect()->route('users.index');
    }

    public function destroy($id){

        $user = User::find($id);

        $user -> delete();

        return redirect()->route('users.index');
    }

public function update(Request $request,$id){

    $user = User::find($id);



        $this->validate($request, [
            'email' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'login' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'string', Rule::unique('users')->ignore($user->id)]
        ],
        // Errores personalizados
        [
            'email.unique' => 'Nombre de Email duplicado'

        ]);
        $user->update([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'activated' => $request->activated == 'on' ? 1 : 0

        ]);





    return redirect()->route('users.index');
}

}
