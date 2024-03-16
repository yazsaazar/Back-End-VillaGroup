<?php
namespace App\Http\Controllers;

use App\Models\Usuarios;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('usuario', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        // Guardar el token_jwt en la base de datos
        $usuario = Auth::user();
        $usuario->token_jwt = $token;
        $usuario->save();

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'usuario' => 'required|unique:usuarios',
            'password' => 'required|min:6',
            'id_resort' => 'required|exists:resorts,id' // Validar que el id_resort exista en la tabla resorts
        ]);

        $usuario = new Usuarios();
        $usuario->usuario = $request->usuario;
        $usuario->password = $request->password;
        $usuario->id_resort = $request->id_resort; // Asignar el id_resort proporcionado
        $usuario->save();

        return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
    }


    public function logout(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $usuario = Auth::user();

            // Guardar el token JWT en el usuario
            $usuario->guardarToken(null); // Pasar null para limpiar el token
        }

        // Cerrar sesión
        Auth::logout();

        return response()->json(['message' => 'Logout exitoso'], 200);
    }




    public function index()
    {
        $usuarios = Usuarios::with('resort:id,nombre')->get();
        return response()->json($usuarios);
    }

    public function show($id)
    {
        $usuario = Usuarios::with('resort:id,nombre')->findOrFail($id);
        return response()->json($usuario);
    }



    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'usuario' => 'required|unique:usuarios,usuario,'.$id,
            'password' => 'required|min:6',
            'id_resort' => 'required|exists:resorts,id'
        ]);

        // No es necesario cifrar la contraseña, ya que ya lo hiciste en el registro

        $usuario->usuario = $request->usuario;
        $usuario->password = $request->password; // Asignar la contraseña proporcionada
        $usuario->id_resort = $request->id_resort;
        $usuario->save();

        return response()->json(['message' => 'Usuario actualizado exitosamente'], 200);
    }




    public function destroy($id)
    {
        $usuario = Usuarios::find($id);
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
    }




    public function updatePassword(Request $request, $id)
{
    $usuario = Usuarios::find($id);
    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Verificar la contraseña actual
    if (!Hash::check($request->input('current_password'), $usuario->password)) {
        return response()->json(['error' => 'La contraseña actual es incorrecta'], 400);
    }

    // Validar la nueva contraseña
    $request->validate([
        'new_password' => 'required|min:6',
    ]);

    // Actualizar la contraseña
    $usuario->password = bcrypt($request->input('new_password'));
    $usuario->save();

    return response()->json(['message' => 'Contraseña actualizada exitosamente'], 200);
}

}
