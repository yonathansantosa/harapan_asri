<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

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
}
