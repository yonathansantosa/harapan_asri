<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;

class AskepPenghuni extends Model
{
  use HasFactory;
  // protected $table = 'askep_diagnosa_penghuni';

  public static function data_askep($query = '', $start, $limit, $order, $dir)
  {
    if ($query == '') {

      $data = DB::table('askep_diagnosa_penghuni')
        ->join('askep_diagnosa', 'askep_diagnosa_penghuni.id_diagnosa', '=', 'askep_diagnosa.id')
        ->leftJoin('askep_gejala_diagnosa_penghuni', 'askep_gejala_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->leftJoin('askep_intervensi_diagnosa_penghuni', 'askep_intervensi_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->leftJoin('askep_penyebab_diagnosa_penghuni', 'askep_penyebab_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
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
        ->value('id_diagnosa_penghuni');

      $intervensi = DB::table('askep_intervensi_diagnosa')
        ->join('askep_intervensi_diagnosa_penghuni', 'askep_intervensi_diagnosa_penghuni.id_intervensi', '=', 'askep_intervensi_diagnosa.id')
        ->select('askep_intervensi_diagnosa_penghuni.id_diagnosa_penghuni')
        ->where('intervensi', 'like', '%' . $query . '%')
        ->value('id_diagnosa_penghuni');

      $penyebab = DB::table('askep_penyebab_diagnosa')
        ->join('askep_penyebab_diagnosa_penghuni', 'askep_penyebab_diagnosa_penghuni.id_penyebab', '=', 'askep_penyebab_diagnosa.id')
        ->select('askep_penyebab_diagnosa_penghuni.id_diagnosa_penghuni')
        ->where('penyebab', 'like', '%' . $query . '%')
        ->value('id_diagnosa_penghuni');

      $id_penghuni = collect([$gejala, $intervensi, $penyebab])->whereNotNull()->unique()->all();

      $data = DB::table('askep_diagnosa_penghuni')
        ->join('askep_diagnosa', 'askep_diagnosa_penghuni.id_diagnosa', '=', 'askep_diagnosa.id')
        ->join('askep_gejala_diagnosa_penghuni', 'askep_gejala_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('askep_intervensi_diagnosa_penghuni', 'askep_intervensi_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('askep_penyebab_diagnosa_penghuni', 'askep_penyebab_diagnosa_penghuni.id_diagnosa_penghuni', '=', 'askep_diagnosa_penghuni.id')
        ->join('penghuni', 'penghuni.id', '=', 'askep_diagnosa_penghuni.id_penghuni')
        ->where('penghuni.nama', 'like', '%' . $query . '%')
        ->orWhere('askep_diagnosa_penghuni.created_at', 'like', '%' . $query . '%')
        ->orWhere('askep_diagnosa.diagnosa', 'like', '%' . $query . '%')
        // ->orWhere('askep_gejala_diagnosa_penghuni.id_gejala', $gejala)
        // ->orWhere('askep_penyebab_diagnosa_penghuni.id_penyebab', $penyebab)
        // ->orWhere('askep_intervensi_diagnosa_penghuni.id_intervensi', $intervensi)
        ->orWhereIn('askep_diagnosa_penghuni.id', $id_penghuni)
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
    return $data;
  }

  public static function data_askep_count()
  {
    $count = DB::table('askep_diagnosa_penghuni')
      ->count();

    return $count;
  }

  public static function data_diagnosa($id_diagnosa = null)
  {
    if ($id_diagnosa) {
      $data = DB::table('askep_diagnosa')
        ->whereIn('id', $id_diagnosa)
        ->get();
    } else {
      $data = DB::table('askep_diagnosa')
        ->get();
    }

    return $data;
  }

  public static function data_askep_diagnosa($id_diagnosa)
  {
    $data = DB::table('askep_diagnosa_penghuni')
      ->where('id', $id_diagnosa)
      ->get();

    return $data;
  }

  public static function data_askep_gejala($id_gejala = null, $id_diagnosa = null)
  {
    if ($id_gejala) {
      $data = DB::table('askep_gejala_diagnosa')
        ->whereIn('id', $id_gejala)
        ->pluck('gejala', 'id');
    } else {
      if ($id_diagnosa) {
        $data = DB::table('askep_gejala_diagnosa')
          ->where('id_diagnosa', $id_diagnosa)
          ->get();
      } else {
        $data = DB::table('askep_gejala_diagnosa')
          ->get();
      }
    }

    return $data;
  }

  public static function detail_gejala_penghuni($id_diagnosa_penghuni)
  {
    $data = DB::table('askep_gejala_diagnosa_penghuni')
      ->join('askep_gejala_diagnosa', 'askep_gejala_diagnosa_penghuni.id_gejala', '=', 'askep_gejala_diagnosa.id')
      ->join('users', 'users.id', '=', 'askep_gejala_diagnosa_penghuni.id_pegawai')
      ->where('askep_gejala_diagnosa_penghuni.id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->get(['askep_gejala_diagnosa_penghuni.*', 'users.nama', 'askep_gejala_diagnosa.*']);

    return $data;
  }

  public static function data_askep_penyebab($id_penyebab = null, $id_diagnosa = null)
  {
    if ($id_penyebab) {
      $data = DB::table('askep_penyebab_diagnosa')
        ->whereIn('id', $id_penyebab)
        ->pluck('penyebab', 'id');
    } else {
      if ($id_diagnosa) {
        $data = DB::table('askep_penyebab_diagnosa')
          ->where('id_diagnosa', $id_diagnosa)
          ->get();
      } else {
        $data = DB::table('askep_penyebab_diagnosa')
          ->get();
      }
    }

    return $data;
  }

  public static function detail_penyebab_penghuni($id_diagnosa_penghuni)
  {
    $data = DB::table('askep_penyebab_diagnosa_penghuni')
      ->join('askep_penyebab_diagnosa', 'askep_penyebab_diagnosa_penghuni.id_penyebab', '=', 'askep_penyebab_diagnosa.id')
      ->join('users', 'users.id', '=', 'askep_penyebab_diagnosa_penghuni.id_pegawai')
      ->where('askep_penyebab_diagnosa_penghuni.id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->get(['askep_penyebab_diagnosa_penghuni.*', 'users.nama', 'askep_penyebab_diagnosa.*']);

    return $data;
  }

  public static function data_askep_intervensi($id_intervensi = null, $id_diagnosa = null)
  {
    if ($id_intervensi) {
      $data = DB::table('askep_intervensi_diagnosa')
        ->whereIn('id', $id_intervensi)
        ->pluck('intervensi', 'id');
    } else {
      if ($id_diagnosa) {
        $data = DB::table('askep_intervensi_diagnosa')
          ->where('id_diagnosa', $id_diagnosa)
          ->get();
      } else {
        $data = DB::table('askep_intervensi_diagnosa')
          ->get();
      }
    }

    return $data;
  }

  public static function data_askep_implementasi($id_implementasi = null)
  {
    if ($id_implementasi) {
      $data = DB::table('askep_implementasi')
        ->whereIn('id', $id_implementasi)
        ->pluck('implementasi', 'id');
    } else {
      $data = DB::table('askep_implementasi')
        ->get();
    }

    return $data;
  }

  public static function data_askep_gejala_penghuni($id_diagnosa_penghuni)
  {
    $data = DB::table('askep_gejala_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->get();

    return $data;
  }

  public static function data_askep_penyebab_penghuni($id_diagnosa_penghuni)
  {
    $data = DB::table('askep_penyebab_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->get();

    return $data;
  }

  public static function data_askep_intervensi_penghuni($id_diagnosa_penghuni)
  {
    $data = DB::table('askep_intervensi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->get();

    return $data;
  }

  public static function data_askep_implementasi_penghuni($id_diagnosa_penghuni)
  {
    $data = DB::table('askep_implementasi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->get();

    return $data;
  }

  public static function insert_diagnosa_penghuni($id_penghuni, $id_diagnosa)
  {
    $id_diagnosa_penghuni = DB::table('askep_diagnosa_penghuni')
      ->insertGetId([
        'id_penghuni' => $id_penghuni,
        'id_diagnosa' => $id_diagnosa,
        // 'id_pegawai' => $id_pegawai,
        // 'id_pj_1' => $id_pj_1,
        // 'id_pj_2' => $id_pj_2,
        // 'id_pj_3' => $id_pj_3,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

    return $id_diagnosa_penghuni;
  }

  public static function update_diagnosa_penghuni($id_diagnosa_penghuni, $id_penghuni, $id_diagnosa)
  {
    // dd($id_diagnosa_penghuni);
    $upd = DB::table('askep_diagnosa_penghuni')
      ->where('id', $id_diagnosa_penghuni)
      ->update([
        'id_penghuni' => $id_penghuni,
        'id_diagnosa' => $id_diagnosa,
        'updated_at' => Carbon::now()
      ]);
  }

  public static function delete_diagnosa_penghuni($id_diagnosa_penghuni)
  {
    $delete = DB::table('askep_diagnosa_penghuni')
      ->where('id', $id_diagnosa_penghuni)
      ->delete();
  }

  public static function insert_gejala_penghuni($id_diagnosa_penghuni, $gejalas = null, $id_diagnosa = null, $id_pegawai = null)
  {
    $data = [];
    foreach ($gejalas as $gejala) {
      if (!is_numeric($gejala)) {
        $id_gejala = DB::table('askep_gejala_diagnosa')
          ->insertGetId([
            'id_diagnosa' => $id_diagnosa,
            'gejala' => $gejala
          ]);
        $gejala = $id_gejala;
      }
      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_gejala' => $gejala,
        'id_pegawai' => $id_pegawai,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $ins = DB::table('askep_gejala_diagnosa_penghuni')
      ->insert($data);
  }

  public static function insert_penyebab_penghuni($id_diagnosa_penghuni, $penyebabs = null, $id_diagnosa = null, $id_pegawai = null)
  {
    $data = [];
    foreach ($penyebabs as $penyebab) {
      if (!is_numeric($penyebab)) {
        $id_penyebab = DB::table('askep_penyebab_diagnosa')
          ->insertGetId([
            'id_diagnosa' => $id_diagnosa,
            'penyebab' => $penyebab
          ]);
        $penyebab = $id_penyebab;
      }
      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_penyebab' => $penyebab,
        'id_pegawai' => $id_pegawai,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $ins = DB::table('askep_penyebab_diagnosa_penghuni')
      ->insert($data);
  }

  public static function insert_intervensi_penghuni($id_diagnosa_penghuni, $intervensis = null, $id_diagnosa = null, $id_pegawai = null)
  {
    $data = [];
    foreach ($intervensis as $intervensi) {
      if (!is_numeric($intervensi)) {
        $id_intervensi = DB::table('askep_intervensi_diagnosa')
          ->insertGetId([
            'id_diagnosa' => $id_diagnosa,
            'intervensi' => $intervensi
          ]);
        $intervensi = $id_intervensi;
      }
      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_intervensi' => $intervensi,
        'id_pegawai' => $id_pegawai,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $ins = DB::table('askep_intervensi_diagnosa_penghuni')
      ->insert($data);
  }

  public static function insert_implementasi_penghuni($id_diagnosa_penghuni, $implementasis = null, $id_diagnosa = null, $id_pegawai = null)
  {
    $data = [];
    foreach ($implementasis as $implementasi) {
      if (!is_numeric($implementasi)) {
        $id_implementasi = DB::table('askep_implementasi_diagnosa')
          ->insertGetId([
            'id_diagnosa' => $id_diagnosa,
            'implementasi' => $implementasi
          ]);
        $implementasi = $id_implementasi;
      }
      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_implementasi' => $implementasi,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $ins = DB::table('askep_implementasi_diagnosa_penghuni')
      ->insert($data);
  }

  public static function delete_penyebab_penghuni($id_diagnosa_penghuni)
  {
    $delete = DB::table('askep_penyebab_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->delete();
  }

  public static function delete_gejala_penghuni($id_diagnosa_penghuni)
  {
    $delete = DB::table('askep_gejala_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->delete();
  }

  public static function delete_intervensi_penghuni($id_diagnosa_penghuni)
  {
    $delete = DB::table('askep_intervensi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->delete();
  }

  public static function delete_implementasi_penghuni($id_diagnosa_penghuni)
  {
    $delete = DB::table('askep_implementasi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->delete();
  }

  public static function update_gejala_penghuni($id_diagnosa_penghuni, $gejalas = null, $id_diagnosa = null, $old_data = [], $id_pegawai = null)
  {
    $data = [];

    foreach ($gejalas as $gejala) {
      if (!is_numeric($gejala)) {
        $id_gejala = DB::table('askep_gejala_diagnosa')
          ->insertGetId([
            'id_diagnosa' => $id_diagnosa,
            'gejala' => $gejala
          ]);
        $gejala = $id_gejala;
      }

      $delete = DB::table('askep_gejala_diagnosa_penghuni')
        ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
        ->delete();

      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_gejala' => $gejala,
        'id_pegawai' => $id_pegawai,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $new = collect($data)->pluck('id_gejala');
    $old = DB::table('askep_gejala_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_gejala');
    $diff = $old->diff($new)->all();
    $delete = DB::table('askep_gejala_diagnosa_penghuni')
      ->whereIn('id_gejala', $diff)
      ->delete();

    // dd($data);


    $ins = DB::table('askep_gejala_diagnosa_penghuni')
      ->upsert($data, ['id_diagnosa_penghuni', 'id_gejala'], ['updated_at']);
  }

  public static function update_penyebab_penghuni($id_diagnosa_penghuni, $penyebabs = null, $id_diagnosa = null, $old_data = [], $id_pegawai = null)
  {
    $data = [];

    foreach ($penyebabs as $penyebab) {
      if (!is_numeric($penyebab)) {
        $id_penyebab = DB::table('askep_penyebab_diagnosa')
          ->insertGetId([
            'id_diagnosa' => $id_diagnosa,
            'penyebab' => $penyebab
          ]);
        $penyebab = $id_penyebab;
      }

      $delete = DB::table('askep_penyebab_diagnosa_penghuni')
        ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
        ->delete();

      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_penyebab' => $penyebab,
        'id_pegawai' => $id_pegawai,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $new = collect($data)->pluck('id_penyebab');
    $old = DB::table('askep_penyebab_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_penyebab');
    $diff = $old->diff($new)->all();
    $delete = DB::table('askep_penyebab_diagnosa_penghuni')
      ->whereIn('id_penyebab', $diff)
      ->delete();

    $ins = DB::table('askep_penyebab_diagnosa_penghuni')
      ->upsert($data, ['id_diagnosa_penghuni', 'id_penyebab'], ['updated_at']);
  }

  public static function update_intervensi_penghuni($id_diagnosa_penghuni, $intervensis = null, $id_diagnosa = null, $old_data = [], $id_pegawai = null)
  {
    $data = [];

    foreach ($intervensis as $intervensi) {
      if (!is_numeric($intervensi)) {
        $id_intervensi = DB::table('askep_intervensi_diagnosa')
          ->insertGetId([
            'id_diagnosa' => $id_diagnosa,
            'intervensi' => $intervensi
          ]);
        $intervensi = $id_intervensi;
      }

      $delete = DB::table('askep_intervensi_diagnosa_penghuni')
        ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
        ->delete();

      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_intervensi' => $intervensi,
        'id_pegawai' => $id_pegawai,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $new = collect($data)->pluck('id_intervensi');
    $old = DB::table('askep_intervensi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_intervensi');
    $diff = $old->diff($new)->all();
    $delete = DB::table('askep_intervensi_diagnosa_penghuni')
      ->whereIn('id_intervensi', $diff)
      ->delete();


    $ins = DB::table('askep_intervensi_diagnosa_penghuni')
      ->upsert($data, ['id_diagnosa_penghuni', 'id_intervensi'], ['updated_at']);
  }

  public static function update_implementasi_penghuni($id_diagnosa_penghuni, $implementasis = null, $old_data = [], $id_pegawai = null)
  {
    $data = [];

    foreach ($implementasis as $implementasi) {
      if (!is_numeric($implementasi)) {
        $id_implementasi = DB::table('askep_implementasi')
          ->insertGetId([
            'implementasi' => $implementasi
          ]);
        $implementasi = $id_implementasi;
      }

      $delete = DB::table('askep_implementasi_diagnosa_penghuni')
        ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
        ->delete();

      $data[] = [
        'id_diagnosa_penghuni' => $id_diagnosa_penghuni,
        'id_implementasi' => $implementasi,
        'id_pegawai' => $id_pegawai,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    };

    $new = collect($data)->pluck('id_implementasi');
    $old = DB::table('askep_implementasi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_implementasi');
    $diff = $old->diff($new)->all();
    $delete = DB::table('askep_implementasi_diagnosa_penghuni')
      ->whereIn('id_implementasi', $diff)
      ->delete();


    $ins = DB::table('askep_implementasi_diagnosa_penghuni')
      ->upsert($data, ['id_diagnosa_penghuni', 'id_implementasi'], ['updated_at']);
  }
}
