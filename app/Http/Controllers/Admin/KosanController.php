<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kosan;

class KosanController extends Controller
{
    public function index()
    {
        $kosans = Kosan::all();
        return view('admin.kosan.index', compact('kosans'));
    }

    public function create()
    {
        return view('admin.kosan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        Kosan::create($request->all());

        return redirect()->route('admin.kosan.index')->with('success', 'Data kosan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kosan = Kosan::findOrFail($id);
        return view('admin.kosan.show', compact('kosan'));
    }

    public function edit($id)
    {
        $kosan = Kosan::findOrFail($id);
        return view('admin.kosan.edit', compact('kosan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $kosan = Kosan::findOrFail($id);
        $kosan->update($request->all());

        return redirect()->route('admin.kosan.index')->with('success', 'Data kosan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kosan = Kosan::findOrFail($id);
        $kosan->delete();

        return redirect()->route('admin.kosan.index')->with('success', 'Data kosan berhasil dihapus.');
    }
}
