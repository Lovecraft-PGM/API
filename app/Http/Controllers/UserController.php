<?php
namespace App\Http\Controllers;
use App\Http\Controllers\ServiceController as OS;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->sortBy('id');
        
        foreach ($users as $user) {
            // if ($user->id != '1') {
                $user['first_name'] = $user->first_name;
                $user['last_name'] = $user->last_name;
                $user['birthday'] = $user->birthday;
                $user['address'] = $user->address;
                $user['param_city']  = $user->param_city;
                $user['type_user'] = $user->type_user;
                $user['email'] =   $user->email;
                $user['image'] =   $user->image;
                $user['password'] = $user->password;
                $user['param_rol'] = $user->param_rol;
                $user['param_gender'] = $user->param_gender;
                $user['param_state'] = $user->param_state;
                $data[] = $user;
            // }
        }
       if (count($users) == null) {
        $data[] = $users;
        return OS::frontendResponse('404', 'error',  $data, $msg = 'Usuarios no encontrados.' );
        }else{
        return OS::frontendResponse('200','success', $data, $msg = 'Usuarios encontrados.'); 
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->param_city = $request->param_city;
        $user->type_user = $request->type_user;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->param_rol = $request->param_rol;
        $user->param_gender = $request->param_gender;
        $user->param_state = $request->param_state;
        $user->save(); 
        $data[] = $user;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Usuario no creado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Usuario creado correctamente.'); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user){
        
        $data[] = $user;
        if (!empty($data)) {
            return OS::frontendResponse('200','success', $data, $msg = 'Usuario encontrado.'); 
        }else{
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Usuario no encontrado.' );

        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->param_city = $request->param_city;
        $user->param_rol = $request->param_rol;
        $user->param_state = $request->param_state;
        $user->type_user = $request->type_user;
        $user->email = $request->email;
        $user->param_gender = $request->param_gender;
        $user->password = $request->password;
        $user->save();    // save
        $data[]= $user;
        if ($data == null) {
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Usuario no actualizado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Usuario actualizado correctamente.'); 
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,User $user)
    {
        if ($user->param_state != 1652) {
            $user->param_state = 1652;
            $user->save();
            $data[] = $user;
            return OS::frontendResponse('200', 'success', $data, $msg = 'El usuario se ha desactivado correctamente.');
        }else{
            return OS::frontendResponse('404', 'error', [], $msg = 'El usuario ya se encuentra inactivo.');
        }
    }
}
