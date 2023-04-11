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

    $totalData = $this->AskepPenghuni->data_askep_count();
    $totalFiltered = $totalData;

    // dd($limit);

    if (empty($request->input('search.value'))) {
      $askep_penghuni = $this->AskepPenghuni->data_askep('', $start, $limit, $order, $dir);
    } else {
      $search = $request->input('search.value');
      $askep_penghuni = $this->AskepPenghuni->data_askep($search, $start, $limit, $order, $dir);
    }

    // dd($askep_penghuni);
    $data = array();

    foreach ($askep_penghuni as $key => $p) {
      $row['id'] = $start + $key + 1;
      $row['penghuni'] = $p->nama;
      $gejala = $p->id_gejalas != null ? $this->AskepPenghuni->data_askep_gejala(explode(',', $p->id_gejalas)) : [];
      $intervensi = $p->id_intervensis != null ? $this->AskepPenghuni->data_askep_intervensi(explode(',', $p->id_intervensis)) : [];
      $penyebab = $p->id_penyebabs != null ? $this->AskepPenghuni->data_askep_penyebab(explode(',', $p->id_penyebabs)) : [];
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
        '<a href="' . route('askep.detail_askep', ['id_diagnosa_penghuni' => $p->id]) . '" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                        <i class="bi bi-search"></i> <p class="pl-3">Detail</p>
                    </a>';
      $row['action'] .=
        '<a href="' . route('askep.edit', ['id_diagnosa_penghuni' => $p->id]) . '" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
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

  public function detail_askep_penghuni($id_diagnosa_penghuni)
  {
    $data['diagnosa'] = $this->AskepPenghuni->data_askep_diagnosa($id_diagnosa_penghuni);

    $data['gejala'] = $this->AskepPenghuni->data_askep_gejala_penghuni($id_diagnosa_penghuni);
    $data['penyebab'] = $this->AskepPenghuni->data_askep_penyebab_penghuni($id_diagnosa_penghuni);
    $data['intervensi'] = $this->AskepPenghuni->data_askep_intervensi_penghuni($id_diagnosa_penghuni);

    $data['data_diagnosa'] = $this->AskepPenghuni->data_diagnosa([$data['diagnosa'][0]->id_diagnosa]);
    $data['data_gejala'] = $this->AskepPenghuni->data_askep_gejala(collect($data['gejala'])->pluck('id_gejala'));
    $data['data_penyebab'] = $this->AskepPenghuni->data_askep_penyebab(collect($data['penyebab'])->pluck('id_penyebab'));
    $data['data_intervensi'] = $this->AskepPenghuni->data_askep_intervensi(collect($data['intervensi'])->pluck('id_intervensi'));

    $data['penghuni'] = $this->Penghuni->detail_penghuni($data['diagnosa'][0]->id_penghuni);

    $data['id_diagnosa_penghuni'] = $id_diagnosa_penghuni;

    return view('askep.detail')->with($data);
  }

  public function tambah_askep()
  {
    $data['diagnosa'] = $this->AskepPenghuni->data_diagnosa();
    $data['gejala'] = $this->AskepPenghuni->data_askep_gejala();
    $data['intervensi'] = $this->AskepPenghuni->data_askep_intervensi();
    $data['penyebab'] = $this->AskepPenghuni->data_askep_penyebab();
    $data['penghuni'] = $this->Penghuni->get();
    $data['user'] = $this->User->get_user();

    return view('askep.tambah', $data);
  }

  public function proses_tambah_askep(Request $request)
  {
    $id_penghuni = $request->input('penghuni');
    $id_diagnosa = $request->input('diagnosa');
    $gejala = $request->input('gejala');
    $penyebab = $request->input('penyebab');
    $intervensi = $request->input('intervensi');

    $id_diagnosa_penghuni = $this->AskepPenghuni->insert_diagnosa_penghuni($id_penghuni, $id_diagnosa);

    if (!empty($gejala)) {
      $this->AskepPenghuni->insert_gejala_penghuni($id_diagnosa_penghuni, $gejala, $id_diagnosa);
    };
    if (!empty($intervensi)) {
      $this->AskepPenghuni->insert_intervensi_penghuni($id_diagnosa_penghuni, $intervensi, $id_diagnosa);
    };
    if (!empty($penyebab)) {
      $this->AskepPenghuni->insert_penyebab_penghuni($id_diagnosa_penghuni, $penyebab, $id_diagnosa);
    };

    return redirect(route('askep.index'));
  }

  public function proses_edit_askep(Request $request)
  {
    $id_diagnosa_penghuni = $request->input('id_diagnosa_penghuni');
    $id_penghuni = $request->input('penghuni');
    $id_diagnosa = $request->input('diagnosa');
    $gejala = $request->input('gejala');
    $penyebab = $request->input('penyebab');
    $intervensi = $request->input('intervensi');

    $this->AskepPenghuni->update_diagnosa_penghuni($id_diagnosa_penghuni, $id_penghuni, $id_diagnosa);

    if (!empty($gejala)) {
      $this->AskepPenghuni->update_gejala_penghuni($id_diagnosa_penghuni, $gejala, $id_diagnosa);
    };
    if (!empty($intervensi)) {
      $this->AskepPenghuni->update_intervensi_penghuni($id_diagnosa_penghuni, $intervensi, $id_diagnosa);
    };
    if (!empty($penyebab)) {
      $this->AskepPenghuni->update_penyebab_penghuni($id_diagnosa_penghuni, $penyebab, $id_diagnosa);
    };

    return redirect(route('askep.index'));
  }

  public function form_askep(Request $request)
  {
    $id_diagnosa = $request->input('id_diagnosa');

    $gejala = $this->AskepPenghuni->data_askep_gejala(null, $id_diagnosa);
    $penyebab = $this->AskepPenghuni->data_askep_penyebab(null, $id_diagnosa);
    $intervensi = $this->AskepPenghuni->data_askep_intervensi(null, $id_diagnosa);

    $data = [
      'gejala' => $gejala,
      'penyebab' => $penyebab,
      'intervensi' => $intervensi,
    ];


    // return "<option value='" . $request->input('id_diagnosa') . "'>" . $request->input('id_diagnosa') . "</option>";
    echo json_encode($data);
  }

  public function edit($id_diagnosa_penghuni)
  {
    $diagnosa = DB::table('askep_diagnosa_penghuni')
      ->where('id', $id_diagnosa_penghuni)
      ->pluck('id_diagnosa');

    $gejala = DB::table('askep_gejala_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_gejala');

    $penyebab = DB::table('askep_penyebab_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_penyebab');

    $intervensi = DB::table('askep_intervensi_diagnosa_penghuni')
      ->where('id_diagnosa_penghuni', $id_diagnosa_penghuni)
      ->pluck('id_intervensi');

    $data['json'] = json_encode([
      'gejala' => $gejala,
      'penyebab' => $penyebab,
      'intervensi' => $intervensi,
      'id_diagnosa' => $diagnosa[0]
    ]);

    $data['diagnosa'] = $this->AskepPenghuni->data_diagnosa();
    $data['penghuni'] = $this->Penghuni->get();
    $data['id_diagnosa_penghuni'] = (int) $id_diagnosa_penghuni;

    return view('askep.edit', $data);
  }

  public function delete($id_diagnosa_penghuni)
  {
    $this->AskepPenghuni->delete_diagnosa_penghuni($id_diagnosa_penghuni);
    $this->AskepPenghuni->delete_penyebab_penghuni($id_diagnosa_penghuni);
    $this->AskepPenghuni->delete_gejala_penghuni($id_diagnosa_penghuni);
    $this->AskepPenghuni->delete_intervensi_penghuni($id_diagnosa_penghuni);

    return redirect(route('askep.index'));
  }
}
