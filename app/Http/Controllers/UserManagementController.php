<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $data['title'] = "Kelola Pengguna";
        $data['user'] = User::orderBy('created_at', 'desc')->get();
        return view('user_management', $data);
    }

    public function add(Request $request)
    {
        $data['id_user'] = null;
        $data['nama'] = $request->nama;
        $data['username'] = $request->username;
        $data['role'] = $request->role;
        $data['password'] = bcrypt(md5($request->password));

        $cek = User::where('username', $data['username'])->count();

        if ($cek > 0) {
            $result['status'] = '0';
            $result['msg'] = 'Username sudah digunakan akun lain!';
        } else {
            if (User::create($data)) {
                $result['status'] = '1';
                $result['msg'] = 'Berhasil menambahkan data';
            } else {
                $result['status'] = '0';
                $result['msg'] = 'Gagal menambahkan data';
            }
        }

        return response()->json($result);
    }

    public function detail(Request $request)
    {

        $id = $request->id;
        $user = User::where('id_user', $id)->get();
        if (count($user) > 0) {
            $result['status'] = '1';
            $result['msg'] = 'Data ditemukan';
            $result['user'] = $user;
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Data tidak ditemukan';
        }

        return response()->json($result);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data['nama'] = $request->nama;
        $data['username'] = $request->username;
        $data['role'] = $request->role;
        if ($request->password != "") {
            $data['password'] = bcrypt(md5($request->password));
        }

        $cek = User::where('username', $data['username'])->where('id_user', '!=', $id)->count();
        if ($cek > 0) {
            $result['status'] = '0';
            $result['msg'] = 'Username sudah digunakan akun lain!';
        } else {
            if (User::where('id_user', $id)->update($data)) {
                $result['status'] = '1';
                $result['msg'] = 'Berhasil perbarui data';
            } else {
                $result['status'] = '0';
                $result['msg'] = 'Gagal perbarui data';
            }
        }

        return response()->json($result);
    }

    public function delete(Request $request)
    {
        if (User::where('id_user', $request->id)->delete()) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }

        return response()->json($result);
    }
}
