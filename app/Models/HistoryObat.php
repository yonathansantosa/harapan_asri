<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Obat;
use Illuminate\Support\Carbon;

class HistoryObat extends Model
{
    use HasFactory;
    protected $table = 'tb_history_obat';

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    public static function simpan($data, $cond)
    {
        HistoryObat::upsert($data, $cond);
    }

    public static function deletes($id)
    {
        HistoryObat::where('id', '=', $id)->delete();
    }

    public static function search_data($request, $id)
    {
        $fromDate = Carbon::createFromFormat('d-m-Y', $request['from'])->format('Y-m-d');
        $untilDate = Carbon::createFromFormat('d-m-Y', $request['until'])->format('Y-m-d');
        $query = str_replace(" ", "%", $request['query']);
        return HistoryObat::where('keterangan', 'like', '%' . $query . '%')
            ->where('id_obat', $id)
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $untilDate)
            ->orderBy('updated_at', 'desc')
            ->paginate(7);
    }

    public static function search_transaksi($request)
    {
        $fromDate = Carbon::createFromFormat('d-m-Y', $request['from'])->format('Y-m-d');
        $untilDate = Carbon::createFromFormat('d-m-Y', $request['until'])->format('Y-m-d');
        $query = str_replace(" ", "%", $request['query']);

        return HistoryObat::join('tb_obat', 'tb_obat.id', '=', 'tb_history_obat.id_obat')
            ->select('tb_history_obat.*', 'tb_obat.namaobat', 'tb_obat.kode_slug')
            ->where('tb_history_obat.keterangan', 'like', '%' . $query . '%')
            ->orWhere('tb_history_obat.id_obat', 'like', '%' . $query . '%')
            ->orWhere('tb_obat.namaobat', 'like', '%' . $query . '%')
            ->orWhere('tb_obat.kode_slug', 'like', '%' . $query . '%')
            ->whereDate('tb_history_obat.created_at', '>=', $fromDate)
            ->whereDate('tb_history_obat.created_at', '<=', $untilDate)
            ->orderBy('tb_history_obat.updated_at', 'desc')
            ->paginate(7);
    }

    public static function stok_obat($id)
    {
        $data = HistoryObat::where('id_obat', $id)
            ->where('deleted', 0)
            ->sum('stokobat');

        return $data;
    }

    public static function histori($query, $id_obat, $start, $limit, $order, $dir, $startDate = '', $endDate = '')
    {
        if ($query != '') {
            if ($startDate != '' & $endDate != '') {
                $data = HistoryObat::where('id_obat', $id_obat)
                    ->where('deleted', 0)
                    ->where('keterangan', 'like', "%" . $query . "%")
                    ->where('created_at', '>=', $startDate)
                    ->where('created_at', '<=', $endDate)
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $data = HistoryObat::where('id_obat', $id_obat)
                    ->where('deleted', 0)
                    ->where('keterangan', 'like', "%" . $query . "%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
        } else {
            if ($startDate != '' & $endDate != '') {
                $data = HistoryObat::where('id_obat', $id_obat)
                    ->where('deleted', 0)
                    ->where('created_at', '>=', $startDate)
                    ->where('created_at', '<=', $endDate)
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $data = HistoryObat::where('id_obat', $id_obat)
                    ->where('deleted', 0)
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
        }

        return $data;
    }

    public static function detail_histori($id_history)
    {
        $data = HistoryObat::where('id', $id_history)->first();
        return $data;
    }

    public static function histori_count($query, $id_obat)
    {
        if ($query != '') {
            $data = DB::table('tb_history_obat')
                ->selectRaw('count(id_obat) as total')
                ->where('id_obat', $id_obat)
                ->where('keterangan', 'like', "%" . $query . "%")
                ->first();
        } else {
            $data = DB::table('tb_history_obat')
                ->selectRaw('count(id_obat) as total')
                ->where('id_obat', $id_obat)
                ->first();
        }
        return $data;
    }

    public static function delete_transaksi($id)
    {
        HistoryObat::where('id', $id)->update(['deleted' => 1]);
    }
}
