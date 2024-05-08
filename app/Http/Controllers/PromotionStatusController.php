<?php

namespace App\Http\Controllers;

use App\Models\PromotionStatus;
use Exception;
use Illuminate\Http\Request;

class PromotionStatusController extends Controller
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

        $promotionStatuses = PromotionStatus::paginate(25);

        return view('pages.settings.promotion_statuses.index', compact('promotionStatuses'));
    }

    /**
     * Show the form for creating a new education system.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $promotedOptions = [
            '1' => 'Yes',
            '0' => 'No',
        ];

        return view('pages.settings.promotion_statuses.create', compact('promotedOptions'));
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

            PromotionStatus::create($data);

            return redirect()->route('promotion_statuses.promotion_status.index')
            ->with('success_message', 'Promotion Status was successfully added.');
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
        $promotionStatus = PromotionStatus::findOrFail($id);

        return view('pages.settings.promotion_statuses.show', compact('promotionStatus'));
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
        $promotionStatus = PromotionStatus::findOrFail($id);

        $promotedOptions = [
            '1' => 'Yes',
            '0' => 'Yes',
        ];

        return view('pages.settings.promotion_statuses.edit', compact('promotionStatus', 'promotedOptions'));
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

            $promotionStatus = PromotionStatus::findOrFail($id);

            $promotionStatus->update($data);

            return redirect()->route('promotion_statuses.promotion_status.index')
            ->with('success_message', 'Promotion Status was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function updateStatus(Request $request)
    {

        $promotionStatus = PromotionStatus::find($request->id);

        $promotionStatus->active = $request->active;

        $promotionStatus->save();

        return response()->json(array('success_message' => 'Status was successfully added.'), 200);
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
            'promoted' => 'required',
            'description' => 'string|min:1|required',
        ];

        $data = $request->validate($rules);

        return $data;
    }
}
