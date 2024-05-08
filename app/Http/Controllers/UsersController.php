<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        
        return $dataTable->render('pages.access-control.users.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::with('permissions')->get();

        return view('pages.access-control.users.create', compact('roles'));
    }

    /**
     * Store a new qualification in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $data['username'] = Str::slug($request->first_name." ". $request->last_name, '.');
            $data['password'] = Hash::make($data['password']);
            $data['email_verified_at'] = date('Y-m-d H:i:s');
            $data['user_type'] = 'Staff';

            $user = User::create($data);

            $user->syncPermissions($request->permissions);

            $user->syncRoles($request->role);

            return redirect()->route('users.index')
            ->with('success_message', 'User was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Show the form for editing the specified qualification.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        $assignedRoles = $user->roles->pluck('id')->toArray();

        $assignedPermissions = $user->permissions->pluck('id')->toArray();

        $roles = Role::with('permissions')->get();

        return view('pages.access-control.users.edit', compact('user', 'assignedRoles', 'assignedPermissions', 'roles'));
    }

    /**
     * Update the specified qualification in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|max:255|email|unique:users,id,' . $id,

            ]);

            $user = User::findOrFail($id);

            if (isset($request->password)) {
                $request->validate([
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                ]);

                $user->update(['password' => Hash::make($request->password)]);
            }

            $user->update($request->except('password'));

            $user->syncPermissions($request->permissions);

            $user->syncRoles($request->role);

            return redirect()->route('users.index')
            ->with('success_message', 'User was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified qualification from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $qualification = Qualification::findOrFail($id);
            $qualification->delete();

            return redirect()->route('qualifications.qualification.index')
            ->with('success_message', 'Qualification was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    public function accessControlView($userId){

        $user = User::find($userId);

        $roles = Role::all();

        $assignedPermissions = $user->permissions->pluck('id')->toArray();

        $assignedRoles = $user->roles->pluck('id')->toArray();

        return view('pages.access-control.users.access-control.index', compact('user', 'roles', 'assignedPermissions', 'assignedRoles'));
    }

    public function assignPermission(Request $request)
    {
        $user = User::find($request->user_id);
        $user->givePermissionTo($request->permission_or_role);
        return response()->json(['status' => 'Permission assigned successfully']);
    }

    public function removePermission(Request $request)
    {
        $user = User::find($request->user_id);
        $user->revokePermissionTo($request->permission_or_role);
        return response()->json(['status' => 'Permission removed successfully']);
    }

    public function assignRole(Request $request)
    {
        
        $user = User::find($request->user_id);
        $user->assignRole($request->permission_or_role);
        return response()->json(['status' => 'Role assigned successfully']);
    }

    public function removeRole(Request $request)
    {
        $user = User::find($request->user_id);
        $user->removeRole($request->permission_or_role);
        return response()->json(['status' => 'Permission removed successfully']);
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {

        $rules = [
            'first_name' => 'string|min:1|required',
            'last_name' => 'string|min:1|required',
            'email' => 'string|min:1|required|unique:users',
            'password' => 'required|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
