<?php

namespace App\Http\Controllers;

use App\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $list_arsip = Arsip::all();
        if ($request->ajax()) {
            return datatables()->of($list_arsip)
                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Tampil" class="tampil btn btn-info btn-sm tampil-post"> Lihat</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="arsip/edit/' . $data->id . '" class="btn-success btn btn-sm" >Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="delete btn btn-danger btn-sm delete-post"> Delete</a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('show');
    }
    public function create()
    {
        return view('create');
    }
    public function edit(Arsip $arsip)
    {
        return view('edit', [
            'arsip' => $arsip
        ]);
    }
    public function show($id)
    {
        $where = array('id' => $id);
        $post  = Arsip::where($where)->first();

        return response()->json($post);
    }
    public function store(Request $request)
    {
        $request->validate([
            'dokumen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        if ($request->hasFile('dokumen')) {
            $dokumen = $request->nama . '_' . date("h_i_s") . '.' . $request->dokumen->extension();
            $request->dokumen->move(public_path('dokumen'), $dokumen);
        }
        if ($request->file('dokumen') == null) {
            $dokumen = null;
        }

        $arsip = new Arsip();
        $arsip->nama = $request->nama;
        $arsip->dokumen = $dokumen;
        $arsip->save();
        return redirect()->to('/arsip/create');
    }
    public function update(Arsip $arsip, Request $request)
    {
        $request->validate([
            'dokumen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        if ($request->hasFile('dokumen')) {
            Storage::disk('aset')->delete('dokumen/' . $arsip->dokumen);
            $dokumen = $request->nama . '_' . date("h_i_s") . '.' . $request->dokumen->extension();
            $request->dokumen->move(public_path('dokumen'), $dokumen);
        }
        if ($request->file('dokumen') == null) {
            $dokumen = $arsip->dokumen;
        }


        $arsip->nama = $request->nama;
        $arsip->dokumen = $dokumen;
        $arsip->update();
        return redirect()->to('/arsip');
    }
    public function destroy(Arsip $arsip)
    {
        Storage::disk('aset')->delete('dokumen/' . $arsip->dokumen);
        $arsip->delete();
        return redirect('/arsip');
    }
}
