<?php

namespace App\Http\Controllers;

use App\Models\KomikModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KomikController extends Controller
{
    public function index(Request $request) : View
    {
        $page = $request->input('page', 1);
        $perPage = 10;
        $data['komik'] = KomikModel::orderBy('id','desc')->paginate($perPage);
        $total = KomikModel::count();
        $totalPages = ceil($total / $perPage);
        $data['totalpages'] = $totalPages;
        return view('komik.index', $data);
    }

    public function create() : View
    {
        return view('komik.create');
    }

    public function store(Request $request)
    {
        $vaildatedData = $request->validate([
            'kode_komik' => 'required',
            'nama_komik' => 'required',
            'harga' => 'required',
            'genre' => 'required',
            'image' => 'required',

        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/komik', $filename);
        $data = $request->all();

        $komik = new KomikModel;
        $komik->kode_komik = $request->kode_komik;
        $komik->nama_komik = $request->nama_komik;
        $komik->harga = $request->harga;
        $komik->genre = $request->genre;
        $komik->image = $filename;
        $komik->save();

        return redirect()->route('komik.index')->with('Succes', 'Komik Sucessfully Created');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $brg = KomikModel::where('nama_komik', 'LIKE', "%{$query}%")->limit(10)->get();
        return response()->json($brg);
    }

    public function show(KomikModel $komik) : view
    {
        return view('komik.show',compact('komik'));
    }

    public function edit(komikModel $komik) : view
    {
        return view('komik.edit',compact('komik'));
    }

    public function update(Request $request, $id) : RedirectResponse
    {
        $request->validate([
          'kode_komik' => 'required',
          'nama_komik' => 'required',
          'harga' => 'required',
          'genre' => 'required',
          'image' => 'required',
        ]);

        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/komik', $filename);
        $data = $request->all();
        $komik = KomikModel::find($id);
        // Check if komik exists
        if (!$komik) {
            return redirect()->route('komik.index')
                            ->with('error', 'komik not found');
        }
        $komik->kode_komik= $request->kode_komik;
        $komik->nama_komik= $request->nama_komik;
        $komik->harga= $request->harga;
        $komik->genre= $request->genre;
        $komik->image = $filename;
        $komik->save();

        return redirect()->route('komik.index')
                         ->with('success','komik Has Been updated successfully');
    }

    public function destroy(KomikModel $komik) : RedirectResponse
    {
        $komik->delete();
        return redirect()->route('komik.index')
                        ->with('success','ko$komik has been deleted successfully');
    }
}
