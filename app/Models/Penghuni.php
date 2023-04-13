<?php

namespace App\Models;

// use App\Models\Penghuni;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghuni extends Model
{
  use HasFactory;
  protected $table = 'penghuni';

  public static function daftar_penghuni($query = "", $start, $limit, $order, $dir)
  {
    // $q = explode("/", $query);
    // $data;
    if ($query == "") {
      $data = Penghuni::offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();
    } else {
      $data = Penghuni::where('nama', 'like', "%" . $query . "%")
        ->orWhere('id', 'like', "%" . $query . "%")
        ->orWhere('no_induk', 'like', "%" . $query . "%")
        ->orWhere('ruang', 'like', "%" . $query . "%")
        ->orWhere('tgl_lahir', 'like', "%" . $query . "%")
        ->get();
    }

    // if ($data->count() == 0) {
    //     $data = Penghuni::get();
    // }

    return $data;
  }

  public static function detail_penghuni($id)
  {
    $data = Penghuni::where('id', $id);
    return $data->first();
  }

  public static function simpan($id, $data)
  {
    Penghuni::where('id', $id)->update($data);
  }

  public static function tambah($data)
  {
    Penghuni::insert($data);
  }

  // YDS list penguhini untuk obat
  public static function list_penghuni()
  {
    $data = Penghuni::select('id', 'no_induk', 'nama')->get();
    return $data;
  }
}
