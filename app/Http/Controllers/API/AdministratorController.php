<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AdministratorResource;
use App\Models\Administrator;

class AdministratorController extends Controller
{

    public $modelclass = Administrator::class;

    public function index(Request $request)
    {
        return AdministratorResource::collection(
            Administrator::orderBy($request->_sort ?? 'id', $request->_order ?? 'asc')
            ->paginate($request->perPage)
        );   }


    public function store(Request $request)
    {
        // Solo los administradores pueden crear administradores
        if (!$request->user()->isAdministrator()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        // Validamos los datos de la petición
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        // Convertimos los datos de la petición a un array asociativo
        $administratorData = json_decode($request->getContent(), true);
        $administrator = Administrator::create($administratorData);

        return new AdministratorResource($administrator);


    }


    public function show(Administrator $administrador)
    {
        return new AdministratorResource($administrador);
    }


    public function update(Request $request,  Administrator $administrador)
    {
        // Solo los administradores pueden actualizar administradores
        if (!$request->user()->isAdministrator()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $administratorData = json_decode($request->getContent(), true);
        $administrator->update($administratorData);

        return new AdministratorResource($administrator);
    }


    public function destroy(Administrator $administrator)
    {
        // Solo los administradores pueden eliminar administradores
        if (!$request->user()->isAdministrator()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        try {
            $administrator->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }
}