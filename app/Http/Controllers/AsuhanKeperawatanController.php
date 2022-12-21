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

  public function data_penghuni(Request $request)
  {
    $columns = array(
      0 => 'id',
      1 => 'nama',
      2 => 'tgl_lahir',
      3 => 'ruang',
      4 => 'status',
      5 => 'action'
    );

    $totalData = Penghuni::count();
    $totalFiltered = $totalData;
    $limit = $request->input('length');

    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');
    if (empty($request->input('search.value'))) {
      $penghuni = $this->Penghuni->daftar_penghuni('', $start, $limit, $order, $dir);
    } else {
      $search = $request->input('search.value');
      $penghuni = $this->Penghuni->daftar_penghuni($search, $start, $limit, $order, $dir);
    }
    $data = array();

    foreach ($penghuni as $key => $p) {
      $row['id'] = $start + $key + 1;
      $row['nama'] = $p->nama;
      $row['ruang'] = $p->ruang;
      $row['status'] = $p->meninggal == 0 || $p->keluar == 0 ?
        '<span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm">Active</span>' :
        '<span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm">Inactive</span>';
      $row['action'] =
        '<a href="' . route('askep.penghuni', ['id' => $p->id]) . '" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg> <p class="pl-3">Asuhan Keperawatan</p>
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

  public function askep_penghuni($id_penghuni)
  {
    $data['id_penghuni'] = $id_penghuni;

    return view('askep.penghuni')->with($data);
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

  public function detail_askep_penghuni($id_penghuni)
  {
    $data['id_penghuni'] = $id_penghuni;

    return view('askep.detail_penghuni')->with($data);
  }

  public function tambah_askep()
  {
    $data['diagnosa'] = $this->AskepPenghuni->data_diagnosa();
    $data['gejala'] = $this->AskepPenghuni->data_askep_gejala();
    $data['intervensi'] = $this->AskepPenghuni->data_askep_intervensi();
    $data['penyebab'] = $this->AskepPenghuni->data_askep_penyebab();
    $data['penghuni'] = $this->Penghuni->get();

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

  public function form_gejala(Request $request)
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
