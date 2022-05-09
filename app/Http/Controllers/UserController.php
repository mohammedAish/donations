<?php

namespace App\Http\Controllers;

use App\Mail\UserWelcomeEmail;
use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::with('city')->withCount('permissions')->get();
        return response()->view('cms.users.index', ['users' => $users]);
    }

    public function editUserPermissions(Request $request, User $user)
    {
        $permissions = Permission::where('guard_name', '=', 'user')
            ->orWhere('guard_name', '=', 'user-api')
            ->get();
        $userPermissions = $user->permissions;
        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);
            foreach ($userPermissions as $userPermission) {
                if ($permission->id == $userPermission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }

        return response()->view('cms.users.user-permissions', ['permissions' => $permissions, 'user' => $user]);
    }

    public function updateUserPermissions(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);
        if (!$validator->fails()) {
            //SELECT * FROM permissions where guard_name = 'user' AND id = 1;
            // $permission = Permission::findById($request->input('permission_id'), 'user');
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($user->hasPermissionTo($permission)) {
                $user->revokePermissionTo($permission);
            } else {
                $user->givePermissionTo($permission);
            }
            return response()->json(['message' => 'Permission updated successfully'], Response::HTTP_OK);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.users.create', ['cities' => $cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email_address' => 'required|email|unique:users,email',
            'city_id' => 'required|numeric|exists:cities,id',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->password = Hash::make('12345');
            $user->city_id = $request->input('city_id');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = Carbon::now() . '_user_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/users', $imageName);
                $imagePath = 'images/users/' . $imageName;
                $user->image = $imagePath;
            }
            $isSaved = $user->save();
            if ($isSaved) {
                Mail::to($user)->send(new UserWelcomeEmail($user));
                $admin = Admin::first();
                $admin->notify(new NewUserNotification($user));
            }
            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.users.edit', ['user' => $user, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email_address' => 'required|email|unique:users,email,' . $user->id,
            'city_id' => 'required|numeric|exists:cities,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);
        if (!$validator->fails()) {
            $user->name = $request->input('name');
            $user->email = $request->input('email_address');
            $user->city_id = $request->input('city_id');
            if ($request->hasFile('image')) {
                //Delete user previous image.
                Storage::delete($user->image);
                //Save new image.
                $file = $request->file('image');
                //date_time_user_image.extenssion
                $imageName = Carbon::now() . '_user_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/users', $imageName);
                $imagePath = 'images/users/' . $imageName;
                $user->image = $imagePath;
            }
            $isSaved = $user->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $deleted = $user->delete();
        if ($deleted) {
            Storage::delete($user->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'User deleted successfully' : 'User deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
