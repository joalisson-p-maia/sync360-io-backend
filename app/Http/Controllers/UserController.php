<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function listAllUsers(): JsonResponse{
        $users = User::all();
        if(count($users) === 0){
            return response()->json([
                "status"=> "error",
                "message"=> "Lista de usuário vazia",
                "status_code" => 404,
                "users" => null
            ], 404);
        }

        return response()->json([
            "status"=> "success",
            "message"=> "Lista de usuários encontrada",
            "status_code" => 200,
            "users" => UserResource::collection($users)
        ],200);
    }

    public function getUserById(string $id):JsonResponse{
        $user = User::find($id);
        if(!$user){
            return response()->json([
                "status"=> "error",
                "message"=> "Usuário não encontrado",
                "status_code" => 404,
                "users" => null
            ],404);
        }

        return response()->json([
            "status"=> "success",
            "message"=> "Usuário encontrado",
            "status_code" => 200,
            "users" => new UserResource($user)
        ],200);
    }

    public function createUser(UserRequest $request): JsonResponse{
        $userRequestValidated = $request->validated();

        $fullName = $userRequestValidated['full_name'];
        $folderName = str_replace(' ', '-', $fullName);

        $imagePath = null;
        if($request->hasFile('profile')){
            $imagePath = $request->file('profile')->store("profiles/{$folderName}", 'public');
        }

        $user = new User();
        $user->full_name = $userRequestValidated['full_name'];
        $user->age = $userRequestValidated['age'];
        $user->street = $userRequestValidated['street'];
        $user->neighborhood = $userRequestValidated['neighborhood'];
        $user->state = $userRequestValidated['state'];
        $user->biography = $userRequestValidated['biography'];
        $user->profile = $imagePath;

        if(!$user->save()){
            return response()->json([
                "status" => "error",
                "message" => "Falha ao tentar salvar usuário",
                "status_code" => 500
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "Usuário criado com sucesso",
            "status_code" => 201
        ]);
    }

   public function updateUserById(string $id, Request $request): JsonResponse
    {
        $updateUser = User::find($id);

        if (!$updateUser) {
            return response()->json([
                "status" => "error",
                "message" => "Usuário não encontrado",
                "status_code" => 404
            ], 404);
        }

        $request->validate([
            'full_name' => 'required|string|max:60',
            'age' => 'required|integer|min:1',
            'street' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            'biography' => 'required|string|max:2000',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->full_name) {
            $updateUser->full_name = $request->full_name;
        }
        if ($request->age) {
            $updateUser->age = $request->age;
        }
        if ($request->street) {
            $updateUser->street = $request->street;
        }
        if ($request->neighborhood) {
            $updateUser->neighborhood = $request->neighborhood;
        }
        if ($request->state) {
            $updateUser->state = $request->state;
        }
        if ($request->biography) {
            $updateUser->biography = $request->biography;
        }

        if ($request->hasFile('profile')) {
            if ($updateUser->profile && Storage::disk('public')->exists($updateUser->profile)) {
                Storage::disk('public')->delete($updateUser->profile);
            }

            $folderName = str_replace(' ', '-', $updateUser->full_name);
            $newImagePath = $request->file('profile')->store("profiles/{$folderName}", 'public');
            $updateUser->profile = $newImagePath;
        }

        if(!$updateUser->save()){
            return response()->json([
                "status"=> "error",
                "message" => "Falha ao tentar atualizar usuário",
                "status_code" => 500
            ],500);
        }

        return response()->json([
            "status" => "success",
            "message" => "Usuário atualizado com sucesso!",
            "status_code" => 200
        ], 200);
    }


    public function deleteUserById(string $id): JsonResponse{
        $user = User::find($id);
        if(!$user){
            return response()->json([
                "status"=> "error",
                "message"=> "Usuário não encontrado",
                "status_code" => 404,
            ],404);
        }

        $folderName = str_replace(' ', '-', $user->full_name);
        Storage::disk('public')->deleteDirectory("profiles/{$folderName}");

        $deleteUser = $user->delete();
        if(!$deleteUser){
            return response()->json([
                "status"=> "error",
                "message"=> "Falha ao tentar deletar usuário",
                "status_code" => 500,
            ],500);
        }

        return response()->json([
            "status"=> "success",
            "message"=> "Usuário deletado",
            "status_code" => 204,
        ],204);
    }
}
