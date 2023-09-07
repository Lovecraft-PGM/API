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
<<<<<<< Updated upstream
        return OS::frontendResponse('404', 'error',  $data, $msg ='Usuarios no encontrado.' );
        }else{
        return OS::frontendResponse('200','success', $data, $msg = 'Usuarios encontrado.'); 
=======
        return OS::frontendResponse('404', 'error',  $data, $msg ='Usuarios no encontrados.' );
        }else{
        return OS::frontendResponse('200','success', $data,$msg = 'Usuarios  encontrados.'); 
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Usuario no creado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Usuario creado correctamente.'); 
=======
            return OS::frontendResponse('404', 'error',  $data, $msg ='Usuario no creado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg ='Usuario creado correctamente.'); 
>>>>>>> Stashed changes
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $data[] = $user;
        if (!empty($data)) {
<<<<<<< Updated upstream
            return OS::frontendResponse('200','success', $data, $msg = 'Usuarios encontrados.'); 
        }else{
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Usuarios no encontrados.' );
=======
            return OS::frontendResponse('200','success', $data, $msg ='Usuarios encontrados.'); 
        }else{
            return OS::frontendResponse('404', 'error',  $data, $msg ='Usuarios no encontrados.' );
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream
            return OS::frontendResponse('404', 'error',  $data, $msg = 'Usuario no Actualizado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg = 'Usuario Actualizado correctamente.'); 
=======
            return OS::frontendResponse('404', 'error',  $data,$msg = 'Usuario no Actualizado.' );
        }else{
            return OS::frontendResponse('200','success', $data, $msg ='Usuario Actualizado correctamente.'); 
>>>>>>> Stashed changes
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,User $user)
    {
        if ($user->param_state != 1652) {
            // Cambia el estado solo si no es 1652
            $user->param_state = 1652;
            $user->save();
            $data[] = $user;
<<<<<<< Updated upstream
            return OS::frontendResponse('200', 'success', $data, $msg = 'Usuario desactivado correctamente.');
        }else{
            return OS::frontendResponse('400', 'error', [], $msg = 'El usuario ya se encuentra inactivo.');
=======
            return OS::frontendResponse('200', 'success', $data, $msg ='Usuario desactivado correctamente.');
        } else {
            return OS::frontendResponse('400', 'error', [],$msg = 'El usuario ya se encuentra inactivo.');
>>>>>>> Stashed changes
        }
    }
}
