<?php

namespace App\Http\Controllers;

use App\Exports\PerjalananExport;
use App\Models\Perjalanan;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PerjalananController extends Controller
{
    public function input()
    {
        $data['title'] = "Input Perjalanan";
        $perjalanan = Perjalanan::join('tb_user', 'tb_user.id_user', '=', 'tb_perjalanan.petugas')->where('from', Auth::user()->role)->where('petugas', Auth::user()->id_user);
        if (Auth::user()->role == '2') {
            $perjalanan = $perjalanan->where('pos9', null);
        } else {
            $perjalanan = $perjalanan->where('pos1', null);
        }
        $data['perjalanan'] = $perjalanan->orderBy('tb_perjalanan.created_at', 'desc')->get();
        return view('perjalanan_input', $data);
    }

    public function add_input(Request $request)
    {
        $data['id_perjalanan'] = null;
        $data['petugas'] = Auth::user()->id_user;
        $data['driver'] = $request->driver;
        $data['tanggal'] = $request->tanggal;
        $data['jenis'] = $request->jenis;
        $data['nopol'] = $request->nopol;
        $data['penumpang'] = $request->penumpang;
        if (Auth::user()->role == '2') {
            $data['pos1'] = date('H:i:s');
        } else {
            $data['pos9'] = date('H:i:s');
        }
        $data['from'] = Auth::user()->role;

        if (isset($request->foto)) {
            $namaFoto = 'img_' . date('YmdHis') . '_' . rand(1, 9999) . '.' . $request->foto->extension();
            $folder = "files/img";
            $data['foto'] = $folder . '/' . $namaFoto;
            $request->foto->move(public_path($folder), $namaFoto);
        }

        if (Perjalanan::create($data)) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menambahkan data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menambahkan data';
        }
        return response()->json($result);
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $perjalanan = Perjalanan::where('id_perjalanan', $id)->get();
        if (count($perjalanan) > 0) {
            $result['status'] = '1';
            $result['msg'] = 'Data ditemukan';
            $result['perjalanan'] = $perjalanan;
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Data tidak ditemukan';
        }
        return response()->json($result);
    }

    public function edit_input(Request $request)
    {
        $id = $request->id;
        $data['petugas'] = Auth::user()->id_user;
        $data['driver'] = $request->driver;
        $data['tanggal'] = $request->tanggal;
        $data['jenis'] = $request->jenis;
        $data['nopol'] = $request->nopol;
        $data['penumpang'] = $request->penumpang;
        if (Auth::user()->role == '2') {
            $data['pos1'] = date('H:i:s');
        } else {
            $data['pos9'] = date('H:i:s');
        }
        $data['from'] = Auth::user()->role;

        if (isset($request->foto)) {
            $namaFoto = 'img_' . date('YmdHis') . '_' . rand(1, 9999) . '.' . $request->foto->extension();
            $folder = "files/img";
            $data['foto'] = $folder . '/' . $namaFoto;
            $request->foto->move(public_path($folder), $namaFoto);
        }

        if (Perjalanan::where('id_perjalanan', $id)->update($data)) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil perbuari data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal perbuari data';
        }
        return response()->json($result);
    }

    public function terima()
    {
        $data['title'] = "Terima Perjalanan";
        $perjalanan = Perjalanan::join('tb_user', 'tb_user.id_user', '=', 'tb_perjalanan.petugas');
        if (Auth::user()->role == '2') {
            $perjalanan = $perjalanan->where('from', '3')->where('pos9', '!=', null)->where('pos1', null);
        } else {
            $perjalanan = $perjalanan->where('from', '2')->where('pos1', '!=', null)->where('pos9', null);
        }
        $data['perjalanan'] = $perjalanan->orderBy('tb_perjalanan.created_at', 'asc')->get();
        return view('perjalanan_terima', $data);
    }

    public function add_terima(Request $request)
    {
        $id = $request->id;
        $data['penerima'] = Auth::user()->id_user;

        if (Auth::user()->role == '2') {
            $data['pos1'] = date('H:i:s');
        } else {
            $data['pos9'] = date('H:i:s');
        }

        if (Perjalanan::where('id_perjalanan', $id)->update($data)) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil submit data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal submit data';
        }
        return response()->json($result);
    }

    public function riwayat()
    {
        $data['title'] = "Riwayat Perjalanan";
        $perjalanan = Perjalanan::where('pos1', '!=', null)
            ->where('pos9', '!=', null)
            ->orderBy('tb_perjalanan.created_at', 'desc')->get();
        foreach ($perjalanan as $row) {
            $input = User::where('id_user', $row->petugas)->withTrashed()->get();
            $row->petugas_input = $input[0]->nama;
            $submit = User::where('id_user', $row->penerima)->withTrashed()->get();
            $row->petugas_submit = $submit[0]->nama;

            $waktuAwal = new DateTime($row->pos1);
            $waktuAkhir = new DateTime($row->pos9);
            $selisih = $waktuAwal->diff($waktuAkhir);
            $row->selisih = ($selisih->h * 60) + $selisih->i;
        }
        $data['perjalanan'] = $perjalanan;
        return view('riwayat', $data);
    }

    public function export()
    {
        return Excel::download(new PerjalananExport, 'Data Riwayat Perjalanan.xlsx');
    }
}
