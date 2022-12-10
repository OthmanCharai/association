<?php

namespace App\Http\Controllers;

use App\Http\Requests\WidowStoreRequest;
use App\Http\Requests\WidowUpdateRequest;
use App\Models\Widow;
use Illuminate\Http\Request;

class WidowController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $widows = Widow::all();

        return view('widow.index', compact('widows'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('widow.create');
    }

    /**
     * @param \App\Http\Requests\WidowStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WidowStoreRequest $request)
    {
        $widow = Widow::create($request->validated());

        $request->session()->flash('widow.id', $widow->id);

        return redirect()->route('widow.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Widow $widow
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Widow $widow)
    {
        return view('widow.show', compact('widow'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Widow $widow
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Widow $widow)
    {
        return view('widow.edit', compact('widow'));
    }

    /**
     * @param \App\Http\Requests\WidowUpdateRequest $request
     * @param \App\Models\Widow $widow
     * @return \Illuminate\Http\Response
     */
    public function update(WidowUpdateRequest $request, Widow $widow)
    {
        $widow->update($request->validated());

        $request->session()->flash('widow.id', $widow->id);

        return redirect()->route('widow.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Widow $widow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Widow $widow)
    {
        $widow->delete();

        return redirect()->route('widow.index');
    }
}
