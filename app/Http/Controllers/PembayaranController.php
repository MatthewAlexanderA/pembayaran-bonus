<?php

namespace App\Http\Controllers;

use App\Models\Buruh;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index() 
    {
        $pembayarans = Pembayaran::latest()->get();

        return view('pembayaran.index', compact('pembayarans'));
    }

    public function user() 
    {
        $pembayarans = Pembayaran::latest()->get();

        return view('pembayaran.user', compact('pembayarans'));
    }

    public function create() 
    {
        return view('pembayaran.create');
    }

    public function store(Request $request)
    {
        $check = 0;
        foreach ($request->percentage as $p) {
            $check += $p;
        }
        if ($check != 100) {
            return back()->with('error', 'Total persen tidak 100%!');
        }

        $pembayaran['nominal'] = $request->pembayaran;
        $id = Pembayaran::create($pembayaran);

        $length = count($request->nama_buruh);
        for ($i=0; $i < $length; $i++) { 
            $buruh['nama_buruh'] = $request->nama_buruh[$i];
            $buruh['percentage'] = $request->percentage[$i];
            $buruh['pembayaran_id'] = $id->id;
            Buruh::create($buruh);
        }

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin-dashboard')
                ->with('success', 'Pembayaran Berhasil!');
        } else {
            return redirect()->route('user-dashboard')
                ->with('success', 'Pembayaran Berhasil!');
        }
    }

    public function show($id) 
    {
        $pembayaran = Pembayaran::find($id);
        $buruhs = Buruh::where('pembayaran_id', $pembayaran->id)->get();

        return view('pembayaran.show', compact('pembayaran', 'buruhs'));    
    }

    public function edit($id) 
    {
        $pembayaran = Pembayaran::find($id);
        $buruhs = Buruh::where('pembayaran_id', $pembayaran->id)->get();

        return view('pembayaran.edit', compact('pembayaran', 'buruhs')); 
    }

    public function update(Request $request, $id)
    {
        $check = 0;
        foreach ($request->percentage as $p) {
            $check += $p;
        }
        if ($check != 100) {
            return back()->with('error', 'Total persen tidak 100%!');
        }

        $data['nominal'] = $request->pembayaran;
        $pembayaran = Pembayaran::find($id);
        $pembayaran->update($data);

        $length = count($request->buruh_id);
        for ($i=0; $i < $length; $i++) { 
            $updateData['nama_buruh'] = $request->nama_buruh[$i];
            $updateData['percentage'] = $request->percentage[$i];
            $buruh = Buruh::find($request->buruh_id[$i]);
            $buruh->update($updateData);
        }
        
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin-dashboard')
                ->with('success', 'Update Berhasil!');
        } else {
            return redirect()->route('user-dashboard')
                ->with('success', 'Update Berhasil!');
        }
    }

    public function destroy(Pembayaran $pembayaran) 
    {
        $pembayaran->delete($pembayaran->id);
        
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin-dashboard')
                ->with('success', 'Delete Berhasil!');
        } else {
            return redirect()->route('user-dashboard')
                ->with('success', 'Delete Berhasil!');
        }
    }

}
