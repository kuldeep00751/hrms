<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
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
        $permissions = Permission::all();

        return view('pages.access-control.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new study mode.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {


        return view('pages.access-control.permissions.create');
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

            Permission::create($data);

            return redirect()->route('permissions.permission.index')
                ->with('success_message', 'Permission was successfully added.');
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
        $permission = Permission::with('permissions')->findOrFail($id);

        $permissionRoles = $permission->roles;

        return view('pages.access-control.permissions.show', compact('permission', 'permissionRoles'));
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
        $permission = Permission::findOrFail($id);


        return view('pages.access-control.permissions.edit', compact('permission'));
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

            $permission = Permission::findOrFail($id);

            $permission->update($data);

            return redirect()->route('permissions.permission.index')
                ->with('success_message', 'Permission was successfully updated.');
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
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return redirect()->route('permissions.permission.index')
                ->with('success_message', 'Permission was successfully deleted.');
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
