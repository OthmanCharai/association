<?php

namespace App\Http\Controllers;

use App\Http\Requests\SponsorStoreRequest;
use App\Http\Requests\SponsorUpdateRequest;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sponsors = Sponsor::all();

        return view('sponsor.index', compact('sponsors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('sponsor.create');
    }

    /**
     * @param \App\Http\Requests\SponsorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SponsorStoreRequest $request)
    {
        $sponsor = Sponsor::create($request->validated());

        $request->session()->flash('sponsor.id', $sponsor->id);

        return redirect()->route('sponsor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sponsor $sponsor)
    {
        return view('sponsor.show', compact('sponsor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sponsor $sponsor)
    {
        return view('sponsor.edit', compact('sponsor'));
    }

    /**
     * @param \App\Http\Requests\SponsorUpdateRequest $request
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(SponsorUpdateRequest $request, Sponsor $sponsor)
    {
        $sponsor->update($request->validated());

        $request->session()->flash('sponsor.id', $sponsor->id);

        return redirect()->route('sponsor.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sponsor $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sponsor $sponsor)
    {
        $sponsor->delete();

        return redirect()->route('sponsor.index');
    }
}
