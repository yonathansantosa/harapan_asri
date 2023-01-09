<?php

namespace App\Http\Controllers;

use App\Models\AskepPenghuni;
use App\Models\User;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsuhanKeperawatanController extends Controller
{
  public function __construct()
  {
    $this->User = new User();
    $this->Penghuni = new Penghuni();
    $this->AskepPenghuni = new AskepPenghuni();
  }

  public function penghuni()
  {
    // $data['user'] = $this->Penghuni->daftar_penghuni();
    return view('askep.penghuni');
  }

  public function detail_askep($id_askep)
  {
    $data['askep'] = AskepPenghuni::data_askep_penghuni($id_askep);
    $data['id_penghuni'] = $data['askep']->id_penghuni;
    $data['penghuni'] = $this->Penghuni->detail_penghuni($data['id_penghuni']);

    $data['diagnosa'] = AskepPenghuni::data_diagnosa([$data['askep']->id_diagnosa]);
    $data['gejala'] = AskepPenghuni::detail_gejala_penghuni($data['askep']->id);
    $data['penyebab'] = AskepPenghuni::detail_penyebab_penghuni($data['askep']->id);
    $data['intervensi'] = AskepPenghuni::detail_intervensi_penghuni($data['askep']->id);
    $data['implementasi'] = AskepPenghuni::detail_implementasi_penghuni($data['askep']->id);

    // dd($data['diagnosa']);

    return view('askep.detail')->with($data);
  }

  public function data_askep_penghuni(Request $request)
  {
    $columns = array(
      0 => 'askep_diagnosa_penghuni.id',
      1 => 'penghuni.nama',
      2 => 'askep_diagnosa_penghuni.created_at',
      3 => 'diagnosa',
      4 => 'gejala',
      5 => 'penyebab',
      6 => 'intervensi',
      7 => 'action',
    );

    $limit = $request->input('length');

    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    $id_penghuni = $request->input(('id_penghuni'));

    $totalData = AskepPenghuni::data_askep_count();
    $totalFiltered = $totalData;

    // dd($limit);

    if (empty($request->input('search.value'))) {
      $askep_penghuni = AskepPenghuni::data_askep('', $start, $limit, $order, $dir);
    } else {
      $search = $request->input('search.value');
      $askep_penghuni = AskepPenghuni::data_askep($search, $start, $limit, $order, $dir);
    }

    // dd($askep_penghuni);
    $data = array();

    foreach ($askep_penghuni as $key => $p) {
      $row['id'] = $start + $key + 1;
      $row['penghuni'] = $p->nama;
      $gejala = $p->id_gejalas != null ? AskepPenghuni::data_askep_gejala(explode(',', $p->id_gejalas)) : [];
      $intervensi = $p->id_intervensis != null ? AskepPenghuni::data_askep_intervensi(explode(',', $p->id_intervensis)) : [];
      $penyebab = $p->id_penyebabs != null ? AskepPenghuni::data_askep_penyebab(explode(',', $p->id_penyebabs)) : [];
      $row['timestamp'] = $p->created_at;

      $row['gejala'] = '<ul class="ml-5 list-outside list-disc">';
      if (!empty($gejala)) {
        foreach ($gejala as $key => $value) {
          $row['gejala'] .= "<li class='break-words'>" . $value . "</li>";
        }
      };
      $row['gejala'] .= '</ul>';

      $row['penyebab'] = '<ul class="ml-5 list-outside list-disc">';
      if (!empty($penyebab)) {
        foreach ($penyebab as $key => $value) {
          $row['penyebab'] .= "<li class='break-words'>" . $value . "</li>";
        }
      }
      $row['penyebab'] .= '</ul>';

      $row['intervensi'] = '<ul class="ml-5 list-outside list-disc">';
      if (!empty($intervensi)) {
        foreach ($intervensi as $key => $value) {
          $row['intervensi'] .= "<li class='break-words'>" . $value . "</li>";
        }
      }
      $row['intervensi'] .= '</ul>';

      $row['diagnosa'] = $p->diagnosa;

      $row['action'] =
        '<a href="' . route('askep.detail', ['id_askep' => $p->id]) . '" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                        <i class="bi bi-search"></i> <p class="pl-3">Detail</p>
                    </a>';
      $row['action'] .=
        '<a href="' . route('askep.edit', ['id_diagnosa_penghuni' => $p->id, 'index' => 1]) . '" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                        <i class="bi bi-pencil-fill"></i> <p class="pl-3">Edit</p>
                    </a>';
      $row['action'] .=
        '<a href="' . route('askep.delete', ['id_diagnosa_penghuni' => $p->id]) . '" class="flex flex-nowrap items-center text-red-400 font-medium text-lg hover:text-red-900 transition duration-200">
                        <i class="bi bi-trash-fill"></i> <p class="pl-3">Delete</p>
                    </a>';

      $data[] = $row;
    }

    $json_data = array(
      "draw"            => intval($request->input('draw')),
      "recordsTotal"    => intval($totalData),
      "recordsFiltered" => intval($totalFiltered),
      "data"            => $data
    );

    echo json_encode($json_data);
  }

  public function detail_askep_penghuni($id_penghuni)
  {
    $data['id_penghuni'] = $id_penghuni;

    return view('askep.detail_penghuni')->with($data);
  }

  public function tambah_askep()
  {
    $data['diagnosa'] = AskepPenghuni::data_diagnosa();
    $data['gejala'] = AskepPenghuni::data_askep_gejala();
    $data['intervensi'] = AskepPenghuni::data_askep_intervensi();
    $data['penyebab'] = AskepPenghuni::data_askep_penyebab();
    $data['penghuni'] = $this->Penghuni->get();
    $data['pegawai'] = $this->User->get_user();

    return view('askep.tambah', $data);
  }

  public function proses_tambah_askep(Request $request)
  {
    $id_penghuni = $request->input('penghuni') ?? null;
    $id_pegawai = $request->input('pegawai') ?? null;
    $id_diagnosa = $request->input('diagnosa') ?? null;
    $id_pj_1 = $request->input('id_pj_1') ?? null;
    $id_pj_2 = $request->input('id_pj_2') ?? null;
    $id_pj_3 = $request->input('id_pj_3') ?? null;

    $implementasi = [];
    $implementasi_key = [];
    foreach ($request->except(['_token', 'penghuni', 'pegawai', 'diagnosa', 'id_pj_1', 'id_pj_2', 'id_pj_3', 'gejala', 'penyebab', 'intervensi']) as $id => $value) {
      if ($value) {
        $implementasi[$id] = $value;
        $implementasi_key[] = $id;
      }
    }

    $request->session()->flash('implementasi_key', $implementasi_key);

    $validated = $request->validate([
      'penghuni' => 'required',
      'pegawai' => 'required',
      'diagnosa' => 'required',
    ]);

    $gejala = $request->input('gejala');
    $penyebab = $request->input('penyebab');
    $intervensi = $request->input('intervensi');

    $id_diagnosa_penghuni = AskepPenghuni::insert_diagnosa_penghuni($id_penghuni, $id_diagnosa, $id_pegawai, $id_pj_1, $id_pj_2, $id_pj_3);

    if (!empty($implementasi)) {
      AskepPenghuni::insert_implementasi_penghuni($id_diagnosa_penghuni, $implementasi, $id_pegawai);
    }
    if (!empty($gejala)) {
      AskepPenghuni::insert_gejala_penghuni($id_diagnosa_penghuni, $gejala, $id_diagnosa, $id_pegawai);
    };
    if (!empty($intervensi)) {
      AskepPenghuni::insert_intervensi_penghuni($id_diagnosa_penghuni, $intervensi, $id_diagnosa, $id_pegawai);
    };
    if (!empty($penyebab)) {
      AskepPenghuni::insert_penyebab_penghuni($id_diagnosa_penghuni, $penyebab, $id_diagnosa, $id_pegawai);
    };

    return redirect(route('askep.index'));
  }

  public function proses_edit_askep(Request $request)
  {
    $old_data = json_decode($request->input('old_data'));
    $id_diagnosa_penghuni = $request->input('id_diagnosa_penghuni');
    $id_penghuni = $old_data->id_penghuni;
    $id_diagnosa = $old_data->id_diagnosa;
    $id_pegawai = $request->input('pegawai');
    $gejala = $request->input('gejala') ?? [];
    $penyebab = $request->input('penyebab') ?? [];
    $intervensi = $request->input('intervensi') ?? [];
    $id_pj_1 = $request->input('id_pj_1') ?? null;
    $id_pj_2 = $request->input('id_pj_2') ?? null;
    $id_pj_3 = $request->input('id_pj_3') ?? null;

    $implementasi = [];
    $implementasi_key = [];

    // dd($penyebab);
    foreach ($request->except(['_token', 'id_diagnosa_penghuni', 'pegawai', 'old_data', 'id_pj_1', 'id_pj_2', 'id_pj_3', 'gejala', 'penyebab', 'intervensi']) as $id => $value) {
      if ($value) {
        $implementasi[$id] = $value;
        $implementasi_key[] = $id;
      }
    }

    $request->session()->flash('implementasi_key', $implementasi_key);

    $validated = $request->validate([
      'pegawai' => 'required',
    ]);

    // AskepPenghuni::update_diagnosa_penghuni($id_diagnosa_penghuni, $id_penghuni, $id_diagnosa);
    AskepPenghuni::update_gejala_penghuni($id_diagnosa_penghuni, $gejala, $id_diagnosa, $old_data->gejala, $id_pegawai);
    AskepPenghuni::update_intervensi_penghuni($id_diagnosa_penghuni, $intervensi, $id_diagnosa, $old_data->intervensi, $id_pegawai);
    AskepPenghuni::update_penyebab_penghuni($id_diagnosa_penghuni, $penyebab, $id_diagnosa, $old_data->penyebab, $id_pegawai);
    AskepPenghuni::update_implementasi_penghuni($id_diagnosa_penghuni, $implementasi, $old_data->implementasi, $id_pegawai);

    return redirect(route('askep.index'));
  }

  public function form_gejala(Request $request)
  {
    $id_diagnosa = $request->input('id_diagnosa');

    $gejala = AskepPenghuni::data_askep_gejala(null, $id_diagnosa);
    $penyebab = AskepPenghuni::data_askep_penyebab(null, $id_diagnosa);
    $intervensi = AskepPenghuni::data_askep_intervensi(null, $id_diagnosa);
    $implementasi = AskepPenghuni::data_askep_implementasi(null);

    $data = [
      'gejala' => $gejala,
      'penyebab' => $penyebab,
      'intervensi' => $intervensi,
      'implementasi' => $implementasi,
    ];


    // return "<option value='" . $request->input('id_diagnosa') . "'>" . $request->input('id_diagnosa') . "</option>";
    echo json_encode($data);
  }

  public function edit($id_diagnosa_penghuni, $index = null)
  {
    $diagnosa = DB::table('askep_diagnosa_penghuni')
      ->where('id', $id_diagnosa_penghuni)
      ->select('id_diagnosa', 'id_penghuni')
      ->first();

    $gejala = DB::table('askep_gejala_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_gejala');

    $penyebab = DB::table('askep_penyebab_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_penyebab');

    $intervensi = DB::table('askep_intervensi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_intervensi');

    $implementasi = DB::table('askep_implementasi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_implementasi');

    $data['json'] = json_encode([
      'id_penghuni' => $diagnosa->id_penghuni,
      'gejala' => $gejala,
      'penyebab' => $penyebab,
      'intervensi' => $intervensi,
      'implementasi' => $implementasi,
      'id_diagnosa' => $diagnosa->id_diagnosa
    ]);

    $data['pegawai'] = $this->User->get_user();
    $data['diagnosa'] = AskepPenghuni::data_diagnosa();
    $data['penghuni'] = $this->Penghuni->get();
    $data['id_diagnosa_penghuni'] = (int) $id_diagnosa_penghuni;
    $data['prev'] = $index ? route('askep.index') : route('askep.detail', ['id_askep' => $id_diagnosa_penghuni]);

    return view('askep.edit', $data);
  }

  public function delete($id_diagnosa_penghuni)
  {
    AskepPenghuni::delete_penyebab_penghuni($id_diagnosa_penghuni);
    AskepPenghuni::delete_gejala_penghuni($id_diagnosa_penghuni);
    AskepPenghuni::delete_intervensi_penghuni($id_diagnosa_penghuni);
    AskepPenghuni::delete_implementasi_penghuni($id_diagnosa_penghuni);
    AskepPenghuni::delete_diagnosa_penghuni($id_diagnosa_penghuni);

    return redirect(route('askep.index'));
  }
}
