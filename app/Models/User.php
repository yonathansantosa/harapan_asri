<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
  use HasFactory;
  protected $primaryKey = 'identifier';

  public static function get_detail($id)
  {
    $detail = DB::table('users')
      ->join('role_users', 'users.id_level', '=', 'role_users.id')
      ->select('users.*', 'role_users.keterangan as role')
      ->where('users.id', '=', $id)
      ->get();
    return $detail;
  }

  public static function get_user_detail($id)
  {
    $detail = DB::table('users')
      ->where('users.id', '=', $id)
      ->first();
    return $detail;
  }

  public static function get_user()
  {
    $user = DB::table('users')
      ->join('role_users', 'users.id_level', '=', 'role_users.id')
      ->select('users.*', 'role_users.keterangan as role')
      ->get();
    return $user;
  }

  public static function get_users($ids)
  {
    $users = DB::table('users')
      ->whereIn('id', $ids)
      ->get();

    return $users;
  }

  public static function login($username)
  {
    $login = DB::table('users')
      ->where('username', $username)
      ->get();
    if (!empty($login)) {
      return $login[0];
    } else {
      return $login[] = null;
    }
  }

  public static function tambah($data)
  {
    $return['error_tambah'] = null;
    $check_nik = DB::table('users')->where('nik', $data->nik)->get();
    if (count($check_nik) > 0) {
      $return['error_tambah']['nik'] = 'NIK sudah terdaftar';
    }
    if ($data->file('foto')) {
      $extension = $data->file('foto')->getClientOriginalExtension();
    } else {
      $extension = '';
    }

    if ($return['error_tambah'] == null) {
      $tgl_masuk = $data->mulaimasuk;
      $tgl_masuk = str_replace('-', '', $tgl_masuk);
      // $tgl_masuk = "20211019";
      // dd(strlen($tgl_masuk));
      $role = Role_user::where('id', $data->id_level)->get()->pluck('kode')[0];
      $check_id = User::where('id', 'like', $role . '%')->latest('id')->first('id');
      if ($check_id == null) {
        // dd($check_id);
        // if ($data->file('foto')) {
        //   $nama_foto = $role . '-' . $tgl_masuk . '-001' . '.' . $extension;
        //   $path = $data->file('foto')->storeAs('public/photo', $nama_foto);
        // } else {
        //   $nama_foto = null;
        // }
        User::insert([
          'id' => $role . '-' . $tgl_masuk . '-001',
          'id_level' => $data->id_level,
          'status' => 1,
          'nama' => $data->nama,
          'nik' => $data->nik,
          'foto' => $role . '-' . $tgl_masuk . '-001' . $extension,
          'tgl_lahir' => $data->tgl_lahir,
          'gender' => $data->gender,
          'agama' => $data->agama,
          'alamat' => $data->alamat,
          'notelp' => $data->notelp,
          'mulaimasuk' => $data->mulaimasuk,
          'ijazah' => $data->ijazah,
          'status_kepegawaian' => $data->status_kepegawaian,
          'pelatihan' => $data->pelatihan,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);


        return $return;
      } else {
        $last_id = User::where('id', 'like', $role . '%')->latest()->first();
        $last_id = substr($last_id->id, strlen($last_id->id) - 3, strlen($last_id->id));
        if ($last_id + 1 < 10) $last_id = '00' . $last_id + 1;
        elseif ($last_id + 1 < 100) $last_id = '0' . $last_id + 1;
        else $last_id = $last_id + 1;

        $new_id = $role . '-' . $tgl_masuk . '-' . $last_id;
        // dd($check_id, $last_id, $new_id);
        User::insert([
          'id' => $new_id,
          'id_level' => $data->id_level,
          'status' => 1,
          'nama' => $data->nama,
          'nik' => $data->nik,
          'foto' => $new_id . '.' . $extension,
          'tgl_lahir' => $data->tgl_lahir,
          'gender' => $data->gender,
          'agama' => $data->agama,
          'alamat' => $data->alamat,
          'notelp' => $data->notelp,
          'mulaimasuk' => $data->mulaimasuk,
          'ijazah' => $data->ijazah,
          'status_kepegawaian' => $data->status_kepegawaian,
          'pelatihan' => $data->pelatihan,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);

        $fileNameToStore = $new_id . '.' . $extension;
        // $path = $data->file('foto')->storeAs('public/photo', $fileNameToStore);
        return $return;
      }
    } else {
      return $return;
    }
  }

  public static function get_ganti_password($id)
  {
    $data = DB::table('users')
      ->select('id', 'username', 'nama')
      ->where('id', $id)
      ->first();
    return $data;
  }

  public static function ganti_password($data)
  {

    $return['error_ubahpassword'] = null;

    if (DB::table('users')->where('id', $data->id)->exists()) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['password' => Hash::make($data->password)]);
      return $return;
    } else {
      $return['error_ubahpassword']['id'] = 'ID tidak ditemukan';
      return $return;
    }
  }

  public static function edit($data)
  {
    $return['error_update'] = null;
    if (DB::table('users')->where('id', $data['id'])->exists()) {
      $update = DB::table('users')
        ->where('id', $data['id'])
        ->update($data);
    } else {
      $return['error_update'] == 'Tidak Berhasil';
    }

    return $return;
  }

  public static function edit1($data)
  {
    $return['error_update'] = null;

    $user = DB::table('users')
      ->where('id', $data->id)
      ->get();

    if ($user[0]->nama != $data->nama) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['nama' => $data->nama]);
    }

    if ($user[0]->username != $data->username) {
      $checkuser = DB::table('users')
        ->where('username', $data->username)
        ->get();
      if (count($checkuser) > 0) {
        $return['error_update']['username'] = "Username sudah ada";
      } else {
        DB::table('users')
          ->where('id', $data->id)
          ->update(['username' => $data->username]);
      }
    }

    if ($user[0]->id_level != $data->id_level) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['id_level' => $data->id_level]);
    }

    if ($user[0]->status != $data->status) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['status' => $data->status]);
    }
    if ($user[0]->NIK != $data->nik) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['NIK' => $data->nik]);
    }

    if ($user[0]->tgl_lahir != $data->tgl_lahir) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['tgl_lahir' => $data->tgl_lahir]);
    }

    if ($user[0]->gender != $data->gender) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['gender' => $data->gender]);
    }

    if ($user[0]->agama != $data->agama) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['agama' => $data->agama]);
    }

    if ($user[0]->notelp != $data->notelp) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['notelp' => $data->notelp]);
    }

    if ($user[0]->mulaimasuk != $data->mulaimasuk) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['mulaimasuk' => $data->mulaimasuk]);
    }

    if ($user[0]->ijazah != $data->ijazah) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['ijazah' => $data->ijazah]);
    }

    if ($user[0]->title != $data->title) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['title' => $data->title]);
    }

    if ($user[0]->pelatihan != $data->pelatihan && $data->pelatihan != null) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['pelatihan' => $data->pelatihan]);
    }

    if (
      $user[0]->status_kepegawaian != $data->status_kepegawaian
      && $data->status_kepegawaian != null
    ) {
      DB::table('users')
        ->where('id', $data->id)
        ->update(['status_kepegawaian' => $data->status_kepegawaian]);
    }

    if (isset($data->foto)) {
      $extension = $data->file('foto')->getClientOriginalExtension();
      $fileNameToStore = $data->id . '.' . $extension;
      $checkfile = public_path('storage/photo/' . $fileNameToStore);
      if (file_exists($checkfile)) {
        $count = count(glob(public_path('storage/photo/' . $data->id . "*")));
        Storage::move(
          'public/photo/' . $fileNameToStore,
          'public/photo/' .
            substr($user[0]->foto, 0, strpos($user[0]->foto, ".")) . "_" . $count + 1 .
            substr($user[0]->foto, strpos($user[0]->foto, "."), strlen($user[0]->foto))
        );
        $path = $data->file('foto')->storeAs('public/photo', $fileNameToStore);
        DB::table('users')
          ->where('id', $data->id)
          ->update(['foto' => $fileNameToStore]);
        $return['error_update']['foto'] = substr($user[0]->foto, strpos($user[0]->foto, "."), strlen($user[0]->foto));
      } else {
        $path = $data->file('foto')->storeAs('public/photo', $fileNameToStore);
        DB::table('users')
          ->where('id', $data->id)
          ->update(['foto' => $fileNameToStore]);
      }
    }

    return $return;
  }
}
