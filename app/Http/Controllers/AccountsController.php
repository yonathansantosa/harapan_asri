<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->Accounts = new Accounts();
    }

    public function index()
    {
        $return =  [
            'accounts' => $this->Accounts->get_accounts()
        ];

        return view('accounts.index')->with($return);
    }

    public function ubahPassword(Request $request)
    {
        $message = [
            'required' => 'Harap isi :attribute',
            'same' => ':other tidak sesuai dengan :attribute'
        ];
        $this->validate($request, [
            'passwordBaru' => 'required',
            'konfirmasiPasswordBaru' => 'required|same:passwordBaru',
        ], $message);

        $this->Accounts->ganti_password($request->input('username'), Hash::make($request->input('passwordBaru')));

        return redirect('accounts')->with(['message' => 'Password Berhasil Dirubah']);
    }
}
