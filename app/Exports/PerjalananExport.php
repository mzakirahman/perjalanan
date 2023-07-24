<?php

namespace App\Exports;

use App\Models\Perjalanan as Perjalanan;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\FromCollection;

class PerjalananExport implements FromView
{
    public function view(): View
    {
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
        return view('export_perjalanan', [
            'perjalanan' => $perjalanan
        ]);
    }
}
