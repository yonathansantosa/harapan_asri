<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;
    protected $table = 'accounts';
    public $timestamps = false;

    public static function get_accounts()
    {
        $data = Accounts::get();

        return $data;
    }

    public static function ganti_password($username, $password)
    {
        Accounts::where("username", $username)
            ->update(['password' => $password]);
    }
}
