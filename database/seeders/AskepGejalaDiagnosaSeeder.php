<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AskepGejalaDiagnosaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('askep_gejala_diagnosa')) {
            DB::table('askep_gejala_diagnosa')->truncate();
        }

        $gejala = [
            [
                "Menolak melakukan perawatandiri",
                "Tidak mampu mandi/mengenakan pakaian/berhias/makan/ke toilet secara mandiri",
                "Penurunan minat dalam perawatan diri"
            ],
            [
                "Hambatan kemampuan berjalan di jalan menanjak",
                "Hambatan kemampuan berjalan di jalan menurun",
                "Hambatan kemampuan berjalan di permukaan yang tidak rata",
                "Hambatan kemampuan menaiki tangga",
                "Hambatan kemampuan berjalan dalam jarak tertentu"
            ],
            [
                "Nyeri saat digerakkan",
                "Ruang gerak (ROM) menurun",
                "Kekuatan otot menurun",
                "Fisik lemah",
                "Gerakan terbatas",
                "Sendi kaku",
                "Gerakan tidak terkoordinasi",
            ],
            [
                "Gelisah",
                "Frekuensi nadi meningkat",
                "Sulit tidur",
                "Bersikap protektif (waspada, posisi menghindari nyeri)",
                "Berfokus pada diri sendiri",
                "Diaforesis",
                "Tekanan darah meningkat",
                "Pola nafas berubah",
                "Nafsu makan berubah",
                "Menarik diri",
                "Raut wajah meringis kesakitan",
                "Bersikap protektif (waspada",
                "posisi menghindari nyeri)",
            ],
            [
                "Gelisah",
                "Respon simpatis (suhu dingin, perubahan posisi tubuh, hipersensitif)",
                "Tidak mampu menuntaskan aktivitas",
                "Pola tidur menyempit",
                "Bersikap protektif (waspada, posisi menghindari nyeri)",
                "Berfokus pada diri sendiri",
                "Fokus menyempit",
                "Anoreksia",
                "Raut wajah meringis kesakitan",
            ],
            [
                "Kerusakan lapisan kulit",
                "Kulit kering",
                "Kemerahan",
                "Kulit bersisik",
                "gatal",
            ],
            [],
            [
                "Pengisian kapiler &gt;3 detik",
                "Nadi perifer menurun atau tidak teraba",
                "Akral teraba dingin",
                "Kulit pucat",
                "Turgor kulit menurun",
                "Edema",
                "Penyembuhan luka lambat",
                "Keringat Dingin",
            ],
            [
                "Makan teratur dan adekuat",
                "Mengekspresikan keinginan untuk meningkatkan nutrisi",
                "Mengekspresikan pengetahuan tentang pilihan makanan dan cairan yang sehat",
                "Mengikuti standart asupan nutrisi yang tepat",
            ],
            [
                "Fluktuasi fungsi kognitif",
                "Fluktuasi tingkat kesadaran",
                "Fluktuasi aktivitas psikomotorik",
                "Halusinasi",
                "Gelisah",
            ],
            [
                "Keringat Dingin"
            ],
            [],
            [
                "Sesak nafas (dyspnea)",
                "Sulit bicara",
                "Gelisah",
                "Sianosis (kebiruan)",
                "Batuk tidak efektif",
                "Tidak mampu batuk",
                "Obstruksi (sumbatan) jalan nafas",
                "Suara Mengi, Wheezing atau ronkhi",
                "Bunyi nafas menurun",
                "Frekuensi nafas berubah",
                "Pola Nafas berubah",
                "Ada secret yang tertahan di jalan nafas",
                "Batuk berdahak",
                "Flu",
                "Gatal ditenggorokan",
                "Suara Mengi",
                "Wheezing atau ronkhi",
            ],
            [
                "Dispnea/sesak nafas",
                "Penggunaan otot bantu nafas",
                "Pola nafas tidak normal (Takipnea, bradipnea)",
                "Pernafasan cuping hidung",
                "Pernafasan pursed lip",
            ],
            [],
            [
                "Sesak nafas",
                "akral bagian bawah teraba dingin",
            ],
            [
                "Defekasi &gt;3x dalam 24 jam",
                "Feses lembek atau cair",
                "Frekuensi peristaltik meningkat",
                "Bising usus hiperaktif",
            ],
            [
                "Defekasi kurang dari 2 kali seminggu",
                "Feses keras",
                "Peristaltik usus menurun",
                "Distensi abdomen",
                "Kelemahan umum",
                "Teraba massa pada rektal",
                "Pengeluaran feses lama dan sulit",
            ],
            [
                "Distensi kandung kemih",
                "Berkemih tidak tuntas",
                "Volume residu urine meningkat",
                "Mengompol",
                "Urin menetes",
                "Desakan berkemih",
                "Nikturia",
                "Sering buang air kecil",
            ],
            [
                "Mengompol sebelum mencapai atau selama usaha mencapai toilet"
            ],
            [
                "Disuria/anuria",
                "Distensi kandung kemih",
                "Inkontinensia berlebih",
                "Residu urin 150 ml atau lebih",
                "Sensasi penuh  pada kandung kemih",
            ],
            [
                "Mengeluh sulit tidur",
                "Mengeluh sering terjaga",
                "Mengeluh tidak puas tidur",
                "Mengeluh pola tidur berubah",
                "Mengeluh istirahat tidak cukup",
                "Mengeluh kemampuan aktivitas menurun",
            ],
            [
                "Frekuensi jantung meningkat dari kondisi istirahat",
                "Tekanan darah berubah dari kondisi istirahat",
                "Gambaran EKG menunjukkan aritmia saat/setelah aktivitas",
                "Gambaran EKG menunjukkan iskemia",
                "Sianosis",
                "Lemah",
                "Mengeluh lelah",
                "Dispnea saat/setelah aktivitas",
            ],
            [
                "Tidak mampu melakukan kemampuan yang dipelajari sebelumnya",
                "Tidak mampu mempelajari keterampilan baru",
                "Tidak mampu mengingat informasi faktual",
                "Tidak mampu mengingat perilaku tertentu yang pernah dilakukan",
                "Tidak mampu mengingat peristiwa",
                "Merasa mudah lupa",
                "Lupa melakukan perilaku pada waktu yang telah dijadwalkan",
            ],
            [
                "Mengeluh mual",
                "Nafsu makan menurun",
                "Saliva meningkat",
                "Pucat",
                "Diaforesis (keringat dingin)",
                "Takikardia",
                "Pupil dilatasi",
            ],
            [
                "Suhu tubuh diatas nilai normal",
                "Kulit merah",
                "Kejang",
                "Takikardi",
                "Takipnea",
                "Kulit terasa hangat",
            ],
            [
                "Suhu tubuh diatas nilai normal",
                "Kulit terasa dingin",
                "Menggigil",
                "Akrosianosis",
                "Bradikardi",
                "Dasar kuku sianotik",
                "Hipoglikemia",
                "Hipoksia",
                "Pengisian kapiler &gt;3 detik",
                "Konsumsi oksigen meningkat",
                "Ventilasi menurun",
                "Vasokontriksi perifer",
            ],
            [],
            [
                "Penurunan tugas kulit",
                "Penurunan tugas lidah",
                "Penurunan haluan urine",
                "Penurunan TTV",
                "Kelemahan",
                "Haus",
                "Peningkatan suhu tubuh",
            ],
            [
                "Tegang di seluruh tubuh",
                "Penururnan kesadaran",
                "Kontraksi otot yg tdk tekendali",
                "Sulit bernafas",
                "Mengalami gerakan sama yang berulang",
            ],
            [
                "Terdapat kerusakan jaringan membran mukosa",
                "Hambatan mobilitas fisik",
                "Kelebihan cairan",
                "Terdapat kerusakan jaringan kulit",
                "kemerehan",
                "berdarah",
                "kuku jari kaki kanan tengah terlepas",
            ]
        ];

        for ($i = 0; $i < sizeof($gejala); $i++) {
            if (sizeof($gejala[$i]) > 0) {
                foreach ($gejala[$i] as $d) {
                    DB::table('askep_gejala_diagnosa')->insert([
                        'id_diagnosa' => $i,
                        'gejala' => $d
                    ]);
                }
            }
        }
    }
}
