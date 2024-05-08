<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the study modes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::paginate(25);

        return view('pages.access-control.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::pluck('name', 'id')->all();

        return view('pages.access-control.roles.create', compact('permissions'));
    }

    /**
     * Store a new study mode in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            $role = Role::create($data);

            $role->syncPermissions($request->permissions);

            return redirect()->route('roles.role.index')
                ->with('success_message', 'Role was successfully added.');
        } catch (Exception $exception) {
            
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        return view('pages.access-control.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified study mode.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $permissions = Permission::pluck('name', 'id')->all();

        $assignedPermissions = $role->permissions->pluck('name')->toArray();

        return view('pages.access-control.roles.edit', compact('role', 'permissions', 'assignedPermissions'));
    }

    /**
     * Update the specified study mode in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $role = Role::findOrFail($id);

            $role->update($data);

            $role->syncPermissions($request->permissions);

            return redirect()->route('roles.role.index')
                ->with('success_message', 'Role was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified study mode from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.role.index')
                ->with('success_message', 'Role was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
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
            'name' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
