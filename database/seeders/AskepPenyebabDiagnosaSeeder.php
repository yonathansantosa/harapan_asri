<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AskepPenyebabDiagnosaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('askep_penyebab_diagnosa')) {
            DB::table('askep_penyebab_diagnosa')->truncate();
        }

        $penyebab = [
            [
                "Gangguan musculoskeletal",
                "Gangguan neuromuscular",
                "Kelemahan",
                "Gangguan psikologis atau psikotik",
                "Penurunan motivasi/minat",
            ],
            [
                "Gangguan keseimbangan",
                "Gangguan kognitif",
                "Gangguan mood",
                "Gangguan muskuloskeletal",
                "Gangguan neuromuskular",
                "Gangguan penglihatan",
                "Kekuatan otot tidak memadai",
                "Kendala lingkungan ( Tangga, jalan menanjak atau menurun, permukaan tidak rata, rintangan, jarak, tidak adanya alat bantu)",
                "Nyeri",
                "Obesitas",
                "Kurang pengetahuan tentang strategi mobilisasi",
                "Takut jatuh",
            ],
            [
                "Kerusakan integritas tulang",
                "Perubahan metabolisme",
                "Ketidakbugaran fisik",
                "Penurunan massa otot",
                "Penurunan kekuatan otot",
                "Kekakuan sendi",
                "Malnutrisi",
                "Kontraktur",
                "Efek agen farmakologis",
                "Program pembatasan pergerakan",
                "Nyeri",
                "Kecemasan",
            ],
            [
                "Agen pencedera fisiologis (iskemia, inflamasi, neoplasma)",
                "Agen pencedera kimiawi (terbakar, bahan kimia iritan)",
                "Agen pencedera fisik (abses, trauma, prosedur operasi, latihan fisik berlebihan, terbakar)"
            ],
            [
                "Kondisi kronis (Arthritis reumatoid)",
                "Infeksi",
                "Cedera medula spinalis",
                "Kondisi pasca trauma",
                "Tumor",
            ],
            [
                "Hipertermia atau hipotermia",
                "Substansi kimia",
                "Kelembaban",
                "Faktor mekanik (alat yang menimbulkan luka, tekanan, restraint)",
                "Imobilitas fisik",
                "Radiasi",
                "Perubahan status metabolik",
                "Perubahan status nutrisi",
                "Perubahan status cairan",
                "Perubahan sirkulasi",
                "Perubahan pigmentasi",
                "Defisit imunologi",
            ],
            // Resiko Jatuh
            [
                "Usia (lebih dari 65 tahun atau kurang dari 2 tahun)",
                "Riwayat jatuh",
                "Penggunaan alat bantu jalan",
                "Penurunan tingkat kesadaran",
                "Perubahan fungsi kognitif",
                "Kondisi pasca operasi",
                "Lingkungan tidak aman (licin, gelap, lingkungan asing)",
                "Hipotensi ortostatik",
                "Perubahan kadar glukosa dalam darah",
                "Kekuatan otot menurun",
                "Anemia",
                "Gangguan keseimbangan",
                "Gangguan pendengaran",
                "Gangguan penglihatan",
                "Neuropati",
                "Efek agen farmakologis (mis; sedasi, alkohol, anastesi umum)",
            ],
            [
                "Hiperglikemia",
                "Penurunan konsentrasi hemoglobin",
                "Hipertensi",
                "Kekurangan volume cairan",
                "Kurang terpapar informasi tentang faktor pemberat (mis; merokok, gaya hidup monoton, obesitas, trauma, asupan garam, imobilitas)",
                "Kurang terpapar informasi tentang proses penyakit (mis; DM, Hipertensi, hiperlipidemia)",
                "Kurang aktifitas fisik",
            ],
            [],
            [
                "Delirium",
                "Demensia",
                "Fluktuasi siklus tidur-bangun",
                "Usia lebih dari 60 tahun",
                "Penyalahgunaan zat",
            ],
            [
                "Diabetes melitus",
                "Penggunaan insulin atau obat glikemik oral",
                "Kurang terpapar informasi tentang manajemen diabetes",
                "Ketidaktepatan pemantauan glukosa darah",
                "Kurang patuh pada rencana manajemen diabetes",
                "Stres berlebihan",
                "Penambahan berat badan",
            ],
            [
                "Penyakit kronis (mis. Diabetes melitus)",
                "Efek prosedur invasif",
                "Malnutrisi",
                "Peningkatan paparan organisme patogen lingkungan",
                "Ketidakadekuatan pertahanan tubuh primer (mis. Gangguan peristaltik, kerusakan integritas kulit, merokok)",
                "Ketidakadekuatan pertahanan tubuh sekunder (mis. Penurunan HB, supresi respon inflamasi, imunosupresi)",
            ],
            [
                "Fisiologis",
                "Spasma jalan nafas",
                "Hipersekresi cairan jalan nafas",
                "Ketidakmampuan otot dan saraf pernafasan",
                "Benda asing dalam jalan nafas",
                "Adanya jalan nafas buatan (ETT)",
                "Sekresi yang tertahan",
                "Respon alergi",
                "Proses infeksi",
                "Merokok pasif",
                "Merokok aktif",
                "Terpajan polutan",
            ],
            [
                "Hambatan upaya saat bernafas (nyeri saat bernafas, kelemahan otot pernafasan)",
                "Pembengkakan dinding dada",
                "Gangguan neuromuscular",
                "Gangguan neurologis (kejang)",
                "Penurunan energi",
                "Obesitas",
                "Kecemasan",
                "Cedera kepala atau tulang belakang (medulla spinalis)",
                "Posisi tubuh",
            ],
            [
                "Penurunan tingkat kesadaran",
                "Penurunan reflex muntah dan atau batuk",
                "Gangguan menelan",
                "Disfagia",
                "Kerusakan mobilitas fisik",
                "Terpasang selang nasigastrik",
                "Terpasang trakeostomi atau endotracheal tube",
                "Trauma pembedahan leher, mulut/wajah",
            ],
            [
                "Perubahan afterload dan/atau preload",
                "Perubahan frekuensi jantung",
                "Perubahan irama jantung",
                "Perubahan kontraktilitas",
                "Aritmia",
            ],
            [
                "Inflamasi gastrointestinal",
                "Iritasi gastrointestinal",
                "Proses infeksi",
                "Malabsorbsi",
                "Kecemasan",
                "Tingkat stres tinggi",
                "Terpapar kontaminan",
                "Terpapar toksin",
                "Penyalahgunaan laksatif",
                "Penyalahgunaan zat",
                "Program pengobatan (agen tiroid, analgesik, pelunak feses, antasida)",
                "Perubahan air dan makanan",
                "Bakteri pada air",
            ],
            [
                "Penurunan motilitas gastrointestinal",
                "Ketidakcukupan diet",
                "Ketidakcukupan asupan serat",
                "Ketidakcukupan asupan cairan",
                "Kelemahan otot abdomen",
                "Gangguan emosional (mis. Konfusi, depresi)",
                "Perubahan kebiasaan makan",
                "Aktivitas fisik harian kurang",
                "Penyalahgunaan laksatif",
                "Efek agen farmakologis",
                "Ketidakaturan kebiasaan defekasi",
                "Kebiasaan menahan dorongan defekasi",
                "Perubahan lingkungan",
            ],
            [
                "Penurunan kapasitas kandung kemih",
                "Iritasi kandung kemih",
                "Efek tindakan medis dan diagnostik (mis. Operasi ginjal, operasi saluran kemih, anastesi, dan obat-obatan)",
                "Kelemahan otot pelvis",
                "Imobilisasi",
                "Hambatan lingkungan",
                "Ketidakmampuan mengkomunikasikan kebutuhan eliminasi",
            ],
            [
                "Ketidakmampuan atau penurunan mengenali tanda-tanda berkemih",
                "Penurunan tonus kandung kemih",
                "Hambatan mobilisasi",
                "Faktor psikologis (depresi, bingung, delirium)",
                "Hambatan lingkungan (toilet jauh, tempat tidur terlalu tinggi, lingkungan baru)",
                "Kehilangan sensorik dan motorik",
                "Gangguan penglihatan",
            ],
            [
                "Peningkatan tekanan uretra",
                "Kerusakan alkus refleks",
                "Blok spingter",
                "Disfungsi neurologis (mis. Trauma, penyakit saraf)",
                "Efek agen farmakologis (mis. Atropine, belladona, psikotropik, antihistamin, opiate)",
            ],
            [
                "Hambatan lingkungan (mis. Kelembaban lingkungan sekitar, suhu lingkungan, pencahayaan, kebisingan, bau tidak sedap)",
                "Kurang kontrol tidur",
                "Kurang privasi",
                "Restrain fisik",
                "Ketiadaan teman tidur",
                "Tidak familiar dengan peralatan tidur",
            ],
            [
                "Ketidakseimbaangan antara suplai dan kebutuhan oksigen",
                "Tirah baring",
                "Kelemahan",
                "Imobilitas",
                "Gaya hidup monoton",
            ],
            [
                "Ketidakadekuatan stimulasi intelektual",
                "Gangguan sirkulasi ke otak",
                "Gangguan volume cairan dan/atau elektrolit",
                "Proses penuaan",
                "Hipoksia",
                "Gangguan neurologis (mis. EEG positif, cedera kepala, gangguan kejang)",
                "Efek agen farmakologis",
                "Penyalahgunaan zat",
                "Faktor psikologis (mis. Kecemasan, depresi, stres berlebihan, berduka, gangguan tidur)",
                "Distraksi lingkungan",
            ],
            [
                "Gangguan biokimiawi (mis. Uremia, ketoasidosis diabetik)",
                "Gangguan esofagus",
                "Distensi lambung",
                "Iritasi lambung",
                "Peningkatan tekanan intraabdominal/intrakranial/intraorbital (mis. Glaukoma)",
                "Mabuk perjalanan",
                "Aroma tidak sedap",
                "Rasa makanan/minuman tidak enak",
                "Faktor psikologis (mis. Kecemasan, ketakutan, stres)",
                "Efek agen farmakologis",
                "Efek toksin"
            ],
            [
                "Dehidrasi",
                "Terpapar lingkungan panas",
                "Proses penyakit",
                "Ketidaksesuain pakaian dengan suhu lingkungan",
                "Peningkatan laju metabolisme",
                "Respon trauma",
                "Aktivitas berlebihan",
                "Penggunaan inkubator",
            ],
            [
                "Kerusakan hipotalamus",
                "Konsumsi alkohol",
                "Berat badan ekstrem",
                "Kekurangan lemak subkutan",
                "Terpapar suhu lingkungan rendah",
                "Malnutrisi",
                "Penurunan laju metabolisme",
                "Tidak beraktivitas",
                "Trauma",
                "Proses penuaan",
                "Efek agen farmakologis",
            ],
            [],
            [
                "Dehidrasi",
                "Status Nutrisi",
                "Intake dan output"
            ],
            [
                "Demam",
                "Efek produk toksik dari mikroorganisme",
                "Respon alergi",
                "Perubahan keseimbangan cairan dan elektrolit",
                "Cedera kepala, meningitis, stroke",
            ],
            [
                "Integritas kulit",
                "Kerusakan jaringan",
                "kuku jari kaki tengah dipaksa dilepas",
            ]
        ];

        for ($i = 0; $i < sizeof($penyebab); $i++) {
            if (sizeof($penyebab[$i]) > 0) {
                foreach ($penyebab[$i] as $d) {
                    DB::table('askep_penyebab_diagnosa')->insert([
                        'id_diagnosa' => $i,
                        'penyebab' => $d
                    ]);
                }
            }
        }
    }
}
