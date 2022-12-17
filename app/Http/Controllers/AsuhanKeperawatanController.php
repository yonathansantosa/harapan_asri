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
      $gejala = $this->AskepPenghuni->data_askep_gejala(explode(',', $p->id_gejalas));
      $intervensi = $this->AskepPenghuni->data_askep_intervensi(explode(',', $p->id_intervensis));
      $penyebab = $this->AskepPenghuni->data_askep_penyebab(explode(',', $p->id_penyebabs));
      $row['timestamp'] = $p->created_at;
      $row['gejala'] = '<ol class="list-disc list-inside">';
      foreach ($gejala as $key => $value) {
        $row['gejala'] .= "<li class='overflow-hidden'>" . $value . "</li>";
      }
      $row['gejala'] .= '</ol>';
      $row['penyebab'] = '<ol class="list-disc list-inside">';
      foreach ($penyebab as $key => $value) {
        $row['penyebab'] .= "<li class='overflow-hidden'>" . $value . "</li>";
      }
      $row['penyebab'] .= '</ol>';
      $row['intervensi'] = '<ol class="list-disc list-inside">';
      foreach ($intervensi as $key => $value) {
        $row['intervensi'] .= "<li class='overflow-hidden'>" . $value . "</li>";
      }
      $row['intervensi'] .= '</ol>';
      $row['diagnosa'] = $p->diagnosa;
      $row['action'] =
        '<a href="' . route('askep.penghuni', ['id' => $p->id]) . '" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg> <p class="pl-3">Detail</p>
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
}
