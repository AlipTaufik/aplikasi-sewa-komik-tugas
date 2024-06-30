<?php

namespace App\Http\Controllers;

use App\Models\PenyewaanModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function index(Request $request) : View
    {
        $page = $request->input('page', 1);
        $perPage = 5;
        $data['penyewaan'] = PenyewaanModel::orderBy('id','desc')->paginate(5);
        $total = PenyewaanModel::count();
        $totalPages = ceil($total / $perPage);
        $data['totalpages']=$totalPages;
        return view('penyewaan.index', $data);
    }

    public function create() : view
    {
        return view('penyewaan.create');

    }

    public function store(Request $request) : RedirectResponse
    {
        $request->merge([
            'total_penyewaan' => $request->input('total_penyewaan', 0),

            'status_penyewaan' => 'DISEWA',
        ]);

        $validatedData = $request->validate([
            'nomor_sewa' => 'required',
            'customer' => 'required',

            'total_penyewaan' => 'nullable|numeric',

            'status_penyewaan' => 'nullable',
        ]);

        $penyewaan = new PenyewaanModel;
        $penyewaan->nomor_sewa = $validatedData['nomor_sewa'];
        $penyewaan->customer = $validatedData['customer'];

        $penyewaan->total_penyewaan = $validatedData['total_penyewaan'];

        $penyewaan->status_penyewaan = $validatedData['status_penyewaan'];
        $penyewaan->save();

        return redirect()->route('penyewaan.index')
                        ->with('success','penyewaan has been created successfully.');
    }

    public function show(PenyewaanModel $penyewaan) : view
    {
        return view('penyewaan.show',compact('penyewaan'));
    }

    public function edit(PenyewaanModel $penyewaan) : view
    {
        return view('penyewaan.edit',compact('penyewaan'));
    }

    public function update(Request $request, $id) : RedirectResponse
    {
        $request->validate([
          'nomor_sewa' => 'required',
          'customer' => 'required',

          'total_penyewaan' => 'required',

          'status_penyewaan' => 'required',
        ]);
        $penyewaan = PenyewaanModel::find($id);
        // Check if penyewaan exists
        if (!$penyewaan) {
            return redirect()->route('penyewaan.index')
                            ->with('error', 'penyewaan not found');
        }
        $penyewaan->nomor_sewa= $request->nomor_sewa;
        $penyewaan->customer= $request->customer;

        $penyewaan->total_penyewaan= $request->total_penyewaan;

        $penyewaan->status_penyewaan= $request->status_penyewaan;
        $penyewaan->save();

        return redirect()->route('penyewaan.index')
                         ->with('success','penyewaan Has Been updated successfully');
    }


    public function destroy(PenyewaanModel $penyewaan) : RedirectResponse
    {
        $penyewaan->delete();
        return redirect()->route('penyewaan.index')
                        ->with('success','penyewaan has been deleted successfully');
    }
}
