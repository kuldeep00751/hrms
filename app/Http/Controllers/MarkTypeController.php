<?php

namespace App\Http\Controllers;

use App\Models\MarkType;
use Exception;
use Illuminate\Http\Request;

class MarkTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the education systems.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $markTypes = MarkType::paginate(25);

        return view('pages.settings.mark_types.index', compact('markTypes'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        return view('pages.settings.mark_types.create');
    }

    /**
     * Store a new education system in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            MarkType::create($data);

            return redirect()->route('mark_types.mark_type.index')
                ->with('success_message', 'Assessment mark type was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $markType = MarkType::findOrFail($id);

        return view('pages.settings.mark_types.show', compact('markType'));
    }

    /**
     * Show the form for editing the specified education system.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $markType = MarkType::findOrFail($id);

        return view('pages.settings.mark_types.edit', compact('markType'));
    }

    /**
     * Update the specified education system in the storage.
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

            $markType = MarkType::findOrFail($id);

            $markType->update($data);

            return redirect()->route('mark_types.mark_type.index')
                ->with('success_message', 'Assessment mark type was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified education system from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $markType = MarkType::findOrFail($id);
            $markType->delete();

            return redirect()->route('mark_types.mark_type.index')
                ->with('success_message', 'Assessment Mark Type was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function getMarkTypesViaAjax(){
        $markTypes = MarkType::select('id', 'mark_type')->get();

        return view('pages.settings.continuous_assessments.assessment_types', compact('markTypes'))->render();
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
            'mark_type' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);


        return $data;
    }
}
