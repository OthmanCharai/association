<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChildStoreRequest;
use App\Http\Requests\ChildUpdateRequest;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $children = Child::all();

        return view('child.index', compact('children'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('child.create');
    }

    /**
     * @param \App\Http\Requests\ChildStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChildStoreRequest $request)
    {
        $child = Child::create($request->validated());

        $request->session()->flash('child.id', $child->id);

        return redirect()->route('child.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Child $child
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Child $child)
    {
        return view('child.show', compact('child'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Child $child
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Child $child)
    {
        return view('child.edit', compact('child'));
    }

    /**
     * @param \App\Http\Requests\ChildUpdateRequest $request
     * @param \App\Models\Child $child
     * @return \Illuminate\Http\Response
     */
    public function update(ChildUpdateRequest $request, Child $child)
    {
        $child->update($request->validated());

        $request->session()->flash('child.id', $child->id);

        return redirect()->route('child.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Child $child
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Child $child)
    {
        $child->delete();

        return redirect()->route('child.index');
    }
}
