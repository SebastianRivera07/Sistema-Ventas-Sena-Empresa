<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use Illuminate\Http\Request;

class MeasureController extends Controller
{
    public function index()
    {
        $measures = Measure::all();
        return view('measures.index', compact('measures'));
    }

    public function create()
    {
        return view('measures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        Measure::create($request->only('name'));

        return redirect()->route('measures.index')->with('ok', 'Medida creada');
    }

    public function show(Measure $measure)
    {
        return view('measures.show', compact('measure'));
    }

    public function edit(Measure $measure)
    {
        return view('measures.edit', compact('measure'));
    }

    public function update(Request $request, Measure $measure)
    {
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $measure->update($request->only('name'));

        return redirect()->route('measures.index')->with('ok', 'Medida actualizada');
    }

    public function destroy(Measure $measure)
    {
        $measure->delete();
        return redirect()->route('measures.index')->with('ok', 'Medida eliminada');
    }
}
