<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AskepDiagnosaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('askep_diagnosa')) {
            DB::table('askep_diagnosa')->truncate();
        }

        $diagnosa = [
            "Defisit Perawatan Diri",
            "Hambatan Berjalan",
            "Gangguan Mobilitas Fisik",
            "Nyeri Akut",
            "Nyeri Kronis",
            "Kerusakan Integritas Kulit",
            "Resiko Jatuh",
            "Resiko Ketidakefektifan Perfusi Jaringan Perifer",
            "Kesiapan Meningkatkan Nutrisi",
            "Konfusi Akut",
            "Resiko Ketidakstabilan Kadar Glukosa Darah",
            "Resiko Infeksi",
            "Bersihan Jalan Nafas Tidak Efektif",
            "Pola Nafas Tidak Efektif",
            "Resiko Aspirasi",
            "Resiko Penurunan Curah Jantung",
            "Diare",
            "Konstipasi",
            "Gangguan Eliminasi Urine",
            "Inkontinensia Urin",
            "Retensi Urin",
            "Gangguan Pola Tidur",
            "Intoleransi Aktivitas",
            "Gangguan Memori",
            "Nausea",
            "Hipertermia",
            "Hipotermia",
            "Berduka",
            "Defisit Volume Cairan",
            "Kejang",
            "Kerusakan Integritas Jaringan",
        ];

        foreach ($diagnosa as $d) {
            DB::table('askep_diagnosa')->insert([
                'diagnosa' => $d,
            ]);
        }
    }
}
