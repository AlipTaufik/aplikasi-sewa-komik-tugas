<?php

namespace App\Http\Controllers;

use App\Models\PenyewaandetailModel;
use App\Models\PenyewaanModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyewaandetailController extends Controller
{
    public function list(Request $request, $id)
    {
        // Enable query log
        DB::enableQueryLog();

        // Build the query
        $query = PenyewaandetailModel::where('penyewaan_id', $id)->with('komik');
        $penyewaan = PenyewaanModel::where('id', $id)->get();
        // Get the SQL query string and bindings
        $sql = $query->toSql();
        $bindings = $query->getBindings();

        // Execute the query
        $data['penyewaandetail'] = $query->get();
        if ($data['penyewaandetail']->isEmpty()) {
            $empty = 'Belum ada Data';
        } else {
            $empty = '';
        }
        // Get the executed queries
        $queries = DB::getQueryLog();

        // Pass the data to the view
        return view('penyewaandetail.list', [
            'penyewaandetail' => $data['penyewaandetail'],
            'penyewaan' => $penyewaan,
            'sql' => $sql,
            'id' => $id,
            'empty' => $empty,
            'bindings' => $bindings,
            'queries' => $queries
        ]);
    }

    public function create($id) : View
    {
        return view('penyewaandetail.create',['id' => $id]);
    }


    public function store(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
          'penyewaan_id' => 'required',
          'kode_komik' => 'required',
          'tanggal_sewa' => 'required',
          'tanggal_dikembalikan' => 'required',
          'qty' => 'required',
          'harga' => 'required',
          'subtotal' => 'required',

        ]);


        $penyewaandetail = new PenyewaandetailModel;
        $penyewaandetail->penyewaan_id = $request->penyewaan_id;
        $penyewaandetail->kode_komik = $request->kode_komik;
        $penyewaandetail->tanggal_sewa = $request->tanggal_sewa;
        $penyewaandetail->tanggal_dikembalikan = $request->tanggal_dikembalikan;
        $penyewaandetail->qty = $request->qty;
        $penyewaandetail->harga = $request->harga;
        $penyewaandetail->subtotal = $request->subtotal;

        $penyewaandetail->save();

        // Update total_penyewaan in penyewaanModel
        $this->updateTotalPenyewaan($penyewaandetail->penyewaan_id, $penyewaandetail->subtotal);


        return redirect()->route('penyewaandetail.list', ['id' => $request->penyewaan_id])
                        ->with('success', 'penyewaandetail has been created successfully.');
    }

    private function updateTotalPenyewaan($penyewaanId, $subtotal)
    {
        $penyewaan = PenyewaanModel::findOrFail($penyewaanId);

        // Get the current value of total_penyewaan
        $currentTotalPenyewaan = $penyewaan->total_penyewaan;

        // Add the new subtotal to the current total_penyewaan
        $newTotalPenyewaan = $currentTotalPenyewaan + $subtotal;

        // Update the total_penyewaan field
        $penyewaan->total_penyewaan = $newTotalPenyewaan;
        $penyewaan->save();
    }

    public function setLunas($penyewaanId)
    {
        $penyewaan = PenyewaanModel::findOrFail($penyewaanId);

        // Update the status_pembayaran field
        $penyewaan->status_penyewaan = 'DIKEMBALIKAN';
        $penyewaan->save();

        return redirect()->route('penyewaandetail.list', ['id' => $penyewaanId])
                     ->with('success', 'penyewaan has been set to Lunas successfully.');
    }

    public function destroy($detail_id, $penyewaan_id): RedirectResponse
    {
        $penyewaandetail = PenyewaandetailModel::where('id', $detail_id)->first();
        $subtotal = -1 * $penyewaandetail->subtotal;
        $penyewaandetail->delete();
        // Update total_pembelian in penyewaanModel
        $this->updateTotalPenyewaan($penyewaandetail->penyewaan_id, $subtotal);
        return redirect()->route('penyewaandetail.list', ['id' => $penyewaan_id])
                        ->with('success', 'penyewaandetail has been deleted successfully.');
    }
}
