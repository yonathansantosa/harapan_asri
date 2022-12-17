<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AskepPenghuni extends Model
{
  use HasFactory;
  // protected $table = 'askep_diagnosa_penghuni';

  public function data_askep($query = '', $start, $limit, $order, $dir)
  {
    if ($query == '') {

      $data = DB::table('askep_diagnosa_penghuni')
        ->join('askep_diagnosa', 'askep_diagnosa_penghuni.id_diagnosa', '=', 'askep_diagnosa.id')
        ->join('askep_gejala_diagnosa_penghuni', 'askep_gejala_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('askep_intervensi_diagnosa_penghuni', 'askep_intervensi_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('askep_penyebab_diagnosa_penghuni', 'askep_penyebab_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('penghuni', 'penghuni.id', '=', 'askep_diagnosa_penghuni.id_penghuni')
        ->orderBy($order, $dir)
        ->offset($start)
        ->limit($limit)
        ->select(
          'askep_diagnosa_penghuni.id',
          'askep_diagnosa_penghuni.id_penghuni',
          'askep_diagnosa_penghuni.id_diagnosa',
          'askep_diagnosa_penghuni.created_at',
          DB::raw('group_concat(distinct(askep_gejala_diagnosa_penghuni.id_gejala)) as id_gejalas'),
          DB::raw('group_concat(distinct(askep_penyebab_diagnosa_penghuni.id_penyebab)) as id_penyebabs'),
          DB::raw('group_concat(distinct(askep_intervensi_diagnosa_penghuni.id_intervensi)) as id_intervensis'),
          'penghuni.nama',
          'askep_diagnosa.diagnosa'
        )
        ->groupBy([
          'askep_diagnosa_penghuni.id',
          'askep_diagnosa_penghuni.id_penghuni',
          'askep_diagnosa_penghuni.id_diagnosa',
          'askep_diagnosa_penghuni.created_at',
          'penghuni.nama',
          'askep_diagnosa.diagnosa'
        ])
        ->get();
    } else {
      $gejala = DB::table('askep_gejala_diagnosa')
        ->join('askep_gejala_diagnosa_penghuni', 'askep_gejala_diagnosa_penghuni.id_gejala', '=', 'askep_gejala_diagnosa.id')
        ->select('askep_gejala_diagnosa_penghuni.id_diagnosa_penghuni')
        ->where('gejala', 'like', '%' . $query . '%')
        ->get();

      $intervensi = DB::table('askep_intervensi_diagnosa')->join('askep_intervensi_diagnosa_penghuni', 'askep_intervensi_diagnosa_penghuni.id_intervensi', '=', 'askep_intervensi_diagnosa.id')->select('askep_intervensi_diagnosa_penghuni.id_diagnosa_penghuni')->where('intervensi', 'like', '%' . $query . '%')->get();

      $penyebab = DB::table('askep_penyebab_diagnosa')
        ->join('askep_penyebab_diagnosa_penghuni', 'askep_penyebab_diagnosa_penghuni.id_penyebab', '=', 'askep_penyebab_diagnosa.id')
        ->select('askep_penyebab_diagnosa_penghuni.id_diagnosa_penghuni')
        ->where('penyebab', 'like', '%' . $query . '%')
        ->get();

      $gejala->merge($intervensi);
      $gejala->merge($penyebab);

      // dd($penyebab);

      $data = DB::table('askep_diagnosa_penghuni')
        ->join('askep_diagnosa', 'askep_diagnosa_penghuni.id_diagnosa', '=', 'askep_diagnosa.id')
        ->join('askep_gejala_diagnosa_penghuni', 'askep_gejala_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('askep_intervensi_diagnosa_penghuni', 'askep_intervensi_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('askep_penyebab_diagnosa_penghuni', 'askep_penyebab_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('penghuni', 'penghuni.id', '=', 'askep_diagnosa_penghuni.id_penghuni')
        ->where('penghuni.nama', 'like', '%' . $query . '%')
        ->orWhere('askep_diagnosa_penghuni.created_at', 'like', '%' . $query . '%')
        ->orWhere('askep_diagnosa.diagnosa', 'like', '%' . $query . '%')
        ->orWhere('askep_gejala_diagnosa_penghuni.id_gejala', $gejala)
        // ->orWhere('askep_penyebab_diagnosa_penghuni.id_penyebab', $penyebab)
        // ->orWhere('askep_intervensi_diagnosa_penghuni.id_intervensi', $intervensi)
        ->orWhereIn('askep_diagnosa_penghuni.id', array_keys($gejala->pluck('distinct(id_diagnosa_penghuni')->toArray()))
        ->orderBy($order, $dir)
        ->offset($start)
        ->limit($limit)
        ->select(
          'askep_diagnosa_penghuni.id',
          'askep_diagnosa_penghuni.id_penghuni',
          'askep_diagnosa_penghuni.id_diagnosa',
          'askep_diagnosa_penghuni.created_at',
          DB::raw('group_concat(distinct(askep_gejala_diagnosa_penghuni.id_gejala)) as id_gejalas'),
          DB::raw('group_concat(distinct(askep_penyebab_diagnosa_penghuni.id_penyebab)) as id_penyebabs'),
          DB::raw('group_concat(distinct(askep_intervensi_diagnosa_penghuni.id_intervensi)) as id_intervensis'),
          'penghuni.nama',
          'askep_diagnosa.diagnosa'
        )
        ->groupBy([
          'askep_diagnosa_penghuni.id',
          'askep_diagnosa_penghuni.id_penghuni',
          'askep_diagnosa_penghuni.id_diagnosa',
          'askep_diagnosa_penghuni.created_at',
          'penghuni.nama',
          'askep_diagnosa.diagnosa'
        ])
        ->get();
    }
    return $penyebab;
  }

  public function data_askep_count()
  {
    $count = DB::table('askep_diagnosa_penghuni')
      ->count();

    return $count;
  }

  public function data_askep_gejala($id_gejala)
  {
    $data = DB::table('askep_gejala_diagnosa')
      ->whereIn('id', $id_gejala)
      ->pluck('gejala');

    return $data;
  }
  public function data_askep_penyebab($id_penyebab)
  {
    $data = DB::table('askep_penyebab_diagnosa')
      ->whereIn('id', $id_penyebab)
      ->pluck('penyebab');

    return $data;
  }
  public function data_askep_intervensi($id_intervensi)
  {
    $data = DB::table('askep_intervensi_diagnosa')
      ->whereIn('id', $id_intervensi)
      ->pluck('intervensi');

    return $data;
  }
}
