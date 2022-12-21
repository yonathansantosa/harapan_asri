<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AskepIntervensiDiagnosaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('askep_intervensi_diagnosa')) {
            DB::table('askep_intervensi_diagnosa')->truncate();
        }

        $intervensi = [
            [
                "Menolak melakukan perawatandiri",
                "Tidak mampu mandi/mengenakan pakaian/berhias/makan/ke toilet secara mandiri",
                "Penurunan minat dalam perawatan diri",
            ],
            [
                "Bantu memandikan pasien dengan menggunakan cara yang tepat atau sesuai",
                "Cuci rambut sesuai dengan kebutuhan / keinginan",
                "Mandi dg air dg suhu nyaman",
                "Gunakan teknik mandi yang menyenangkan",
                "Bantu dalam hal perawatan perineal jika memang diperlukan",
                "Berikan fasilitas merendam kaki, sesuai dg kebutuhan",
                "Berikan lubrikan dan krim pada area kulit yang kering",
                "Berikan bedak kering pada lipatan kulit yang dalam",
                "Monitor kondisi kulit saat mandi",
                "Monitor fungsi kemampuan saat mandi",
            ],
            [
                "Bantu pasien untuk menggunakan alas kaki yang memfasilitasi pasien untuk berjalan dan mencegah cedera",
                "Konsultasikan pada ahli terapi fisik mengenai rencana ambulasi,sesuai kebutuhan",
                "Terapkan atau sediakan alat bantu (tongkat,walker,atau kursi roda )",
                "Bantu pasien dengan ambulasi awal dan jika diperukan",
                "Monitor penggunaaan kruk pasien atau alat bantu berjalan lainnya",
            ],
            [
                "Bantu pasien untuk menggunakan alas kaki yang memfasilitasi pasien untuk berjalan dan mencegah cedera",
                "Konsultasikan pada ahli terapi fisik mengenai rencana ambulasi,sesuai kebutuhan",
                "Terapkan atau sediakan alat bantu (tongkat,walker,atau kursi roda )",
                "Bantu pasien dengan ambulasi awal dan jika diperlukan",
                "Monitor penggunaaan kruk pasien atau alat bantu berjalan lainnya",
            ],
            [
                "Lakukan pengkajian nyeri komprehensif yg meliputi lokasi, karakteristik, onset/durasi, frekuensi, kualitas, intensitas atau beratnya nyeri dan faktor pencetus",
                "Observasi adanya petunjuk nonverbal mengenai ketidaknyamanan terutama pada mereka yg tidak dapat berkomunikasi secara efektif",
                "Pastikan perawatan analgesik bagi pasien dilakukan dengan pemantauan yg ketat",
                "Bantu pasien dengan ambulasi awal dan jika diperukan",
                "Lakukan pengkajian nyeri komprehensif yg meliputi lokasi",
                "karakteristik",
                "onset/durasi",
                "frekuensi",
                "kualitas",
                "intensitas atau beratnya nyeri dan faktor pencetus",
            ],
            [
                "Lakukan pengkajian nyeri komprehensif yg meliputi lokasi, karakteristik, onset/durasi, frekuensi, kualitas, intensitas atau beratnya nyeri dan faktor pencetus",
                "Observasi adanya petunjuk nonverbal mengenai ketidaknyamanan terutama pada mereka yg tidak dapat berkomunikasi secara efektif",
                "Pastikan perawatan analgesik bagi pasien dilakukan dengan pemantauan yg ketat",
                "Bantu pasien dengan ambulasi awal dan jika diperukan",
                "Monitor penggunaaan kruk pasien atau alat bantu berjalan lainnya",
            ],
            [
                "Jaga kelembaban kulit",
                "Monitor karakteristik gatal",
                "Cegah terjadinya alergi",
                "Cegah terjadinya inflamasi pada area gatal",
                "Jaga kebersihan kulit",
                "Kolaborasi dengan dokter pemberian obat / salp / talk",
            ],
            [
                "Identifikasi kekurangan baik kognitif atupun fisik dari pasien yang mungkin potensi jatuh pada lingkungan tertentu",
                "Identifikasi perilaku dan faktor yang mempengaruhi risiko  jatuh",
                "Kaji ulang riwayat jatuh bersama pasien dan keluarga",
                "Identifikasi karakteristik dari lingkungan yang mungkin meningkatkan potensi jatuh ( lantai licin tangga terbuka)",
                "Monitor gaya berjalan (terutama kecepatan)",
                "keseimbangan dan tingkat ambulasi",
                "Bantu ambulasi individu yng memiliki ketidakseimbangan",
                "Lakukan progam latihan fisik rutin yang meliputi berjalan",
                "Sarankan menggunakan alas kaki yang aman",
                "Berkolaborasi dengan anggota tim kesehatan lain untuk meminimalkan efek samping dengan pengobatan yang berkontribui risiko jatuh",
            ],
            [
                "Kaji tingkat pengetahuan pasien terkait dengan proses penyakit yang spesifik",
                "Jelaskan patofisiologi penyakit dan bagaimana hubungannya dengan anatomi fisiologi, sesuai kebutuhan",
                "Review pengetahuan mengenai kondisinya",
                "Kenali pengetahuan pasien mengenai kondisinya",
                "Jelaskan tanda dan gejala yang umum dari penyakit sesuai kebutuhan",
                "Eksplorasi bersama pasien apakan dia telah melakukan managemen gejala",
                "Jelaskan mengenai proses penyakit sesuai kebutuhan",
                "Monitor tekanan darah, nadi, suhu, dan status pernafasan dengan tepat.",
                "Menjelaskan terapi alternatif pengobatan hipertensi yaitu teknik relaksasi otot progresif,Senam hipertensi dan Pijat Hipertensi.",
                "Kolaborasi dengan dokter pemberian obat anti hipertensi.",
                "monitor GDS/GDP pasien",
                "Monitor tanda dan gejala hiperglikemi / hipoglikemi",
                "Monitor keadaan umum pasien",
                "Kolaborasi dengan tenaga medis lain",
            ],
            [
                "Monitor diet dan asupan kalori.",
                "Timbang berat badan klien.",
                "Lakukan pengukuran antropometrik pada komposisi tubuh (misalnya, indeks massa tubuh, pengukuran pinggang, dan lipatan kulit)",
                "Identifikasi perubahan berat badan terakhir.",
                "Identifikasi perubahan nafsu makan dan aktivitas akhir-akhir ini",
                "Kolaborasi dengan ahli gizi tentang menu seimbang",
            ],
            [
                "Tawarkan kepada klien stimulasi lingkungan melalui kontak dengan banyak personil",
                "Orientasikan kepada klien terhadap waktu, tempat dan orang",
                "Stimulasi perkembangan klien dengan melibatkan aktivitas untuk meningkatkan pencapaian dan pembelajaran dengan memenuhi kebutuhan klien",
                "Ajarkan senam otak",
                "Gunakan alat bantu memori: ceklis, jadwal, dan catatan peringatan",
                "Kolaborasi dengan medis",
            ],
            [
                "Monitor keadaan umum pasien",
                "Monitor GDS / GDP",
                "Monitor tanda dan gejala hiperglikemi (kadar gula darah lebih dari 115 mg/dl, kulit dingin, lembab dan pucat, takikardi,peka terhadap rangsang, tidak sadar, tidak terkoordinasi, bingung, mudah mengantuk).",
                "Ajarkan senam kaki DM",
                "Kolaborasi dengan medis",
            ],
            [
                "Kaji tanda - tanda infeksi",
                "Cuci tangan setiap sebelum dan sesudah tindakan keperawatan",
                "Pertahankan lingkungan aseptik selama pemasangan alat",
                "Kolaborasi dengan medis",
                "Tingkatkan intake nutrisi",
            ],
            [
                "Moniter pernafasan pasien",
                "Monitor status oksigen pasien",
                "Berikan O<sup>2</sup> sesuai advis dokter",
                "Posisikan pasien untuk memaksimalkan ventilasi",
                "Lakukan fisiotherapi dada jika perlu",
                "Keluarkan sekret menggunakan suction",
                "Auskultasi suara nafas, catat jika adanya suara tambahan",
                "Kolaborasi dengan advis dokter",
                "monitor batuk",
                "Auskultasi suara nafas",
                "catat jika adanya suara tambahan",
            ],
            [
                "Monitor TD, Nadi, Suhu, dan RR",
                "Posisikan pasien untuk memaksimalkan ventilasi",
                "Monitor kecemasan pasien terhadap oksigenasi",
                "Monitor frekuensi dan irama pernafasan",
                "Monitor suara paru",
                "Monitor pola nafas abnormal",
                "monitor sianosis perifer",
                "Kolaboradi advis dokter",
            ],
            [
                "Monitor tingkat kesadaran, reflek batuk dan kemampuan menelan",
                "Monitor status paru pelihara jalan nafas",
                "Hindari makan kalau residu masih banyak",
                "Potong kecil-kecil makanan / haluskan makanan",
                "Haluskan obat seebelum pemberian posisikan tegak 90 derajat",
                "Lakukan suction jika di perlukan",
            ],
            [
                "Monitor adanya nyeri dada (intensitas, lokasi, durasi)",
                "Catat adanya disritmia jantung",
                "Catat adanya tanda dan gejala penurunan cardiac output",
                "Monitor status kardiovaskuler",
                "Monitor status pernafasan",
                "Monitor adanya perubahan tekanan darah",
                "Monitor respon pasien terhadap pengobatan antiaritmia",
                "Monitor toleransi aktivitas",
            ],
            [
                "Evaluasi intake makanan yang masuk",
                "Monitor tanda dan gejala diare",
                "Monitor jumlah, warna,  frekuensi dan konsistensi feses",
                "Ajarkan pasien untuk menggunakan obat antidiare",
                "Evaluasi eveksamping pengobatan terhadap gastrointestinal",
                "Observasi tugor kulis secara rutin",
                "Identifikasi faktor penyebab diare",
                "Hubungi dokter jika ada kenaikan bising usus",
                "Intruksikan pasien makan rendah serat, tinggi protein, dan tinggi kalori",
                "Monitor persiapan makanan yang aman",
                "Monitor jumlah",
                "warna",
                "frekuensi dan konsistensi feses",
            ],
            [
                "Monitor tanda dan gejala konstipasi",
                "Monitor bising usus",
                "Identifikasi faktor penyebab konstipasi",
                "Kolaborasikan pemberian laksatif",
                "Pantau tanda gejala konstipasi",
                "Anjurkan pasien untuk diet tinggi serat",
                "Anjurkan pasien menggunakan obat pencahat yang tepat",
                "Lakukan tinja manual",
                "Lakukan pemberian gliserin",
            ],
            [
                "Lakukan penilaian kemih yang komprehensif berfokus pada inkontinensia ( output urin, pola berkemih, fungsi kognitif, dan masalah kencing praeksistrn)",
                "Sediakan waktu untuk pengosongan kandung kemih (10 menit)",
                "Lakukan rangsangan kandung kemih dengan menerapkan kompes air dingin / es",
                "Masukan kateter kemih",
                "Sunakan spirit wintergreen di pispot atau urinal",
                "Bantu toileting secara berkala",
            ],
            [
                "Anjurkan pasien memakai pampers",
                "Anjurkan pasien kencing menggunakan urinal / pispot",
                "Bantu toileting secara berkala",
                "Anjurkan waktu berkemih kurang lebih 10 menit",
            ],
            [
                "Monitor intake dan output",
                "Monitor penggunaan obat antikolionergik",
                "Ajarkan konpres dingin pada abdomen",
                "Catat output urin",
                "Kateterisasi jika perlu",
                "Monitor tanda gejala ISK (panas, hematutia, perubahan bau, dan konsistensi urin)",
            ],
            [
                "Jelaskan efek-efek medikasi terhadap pola tidur",
                "Jelaskan pentingnya tidur yang adekuat",
                "Ciptakan lingkungan yang nyaman untuk tidur",
                "Intruksikan untuk memonitor tidur pasien",
                "Monitor waktu makan dan minum dengan waktu tidur",
                "Monitor kebutuhan tidur pasien setiap hari dan jam",
            ],
            [
                "Kolaborasikan dengan tenaga rehabilitas medik dalam merencanakan program therapi yang tepat",
                "Bantu klien untuk memilih aktivitas",
                "Bantu klien untuk mengidentifikasi aktivitas yang mampu dilakukan",
                "Bantu untuk menggunakan alat bantu aktivitas",
                "Beri jadwal klien untuk melakukan latihan aktivitas",
                "Bantu untuk mengidentifikasi aktifitas yang di sukai",
            ],
            [
                "Identifikasi pola biasa dari perilaku berkeliaran",
                "Siapkan untuk interaksi menggunakan kontak mata dan sentuhan",
                "Gunakan simbol untuk membantu pasien menentukan ruangan kamar)",
                "Monitor obat, efeksamping dan efek terapi yang diinginkan.",
                "Dorong aktifitas fisik di waktu siang hari",
            ],
            [
                "Tanyakan pasien penyebab mual",
                "Observasi asupan makanan dan cairan",
                "Anjurkan pasien untuk menghindari makanan yang menusuk hudung / bau tak sedap",
                "Berikan obat anti mual sesuai advis dokter",
                "Anjurkan pasien makan sedikit tapi sering",
            ],
            [
                "Monitor Suhu, TD,  Nadi dan RR",
                "Monitor suhu tiap 2 jam",
                "Monitor warna kulit",
                "Berikan anti piretik sesuai advis dokter",
                "Monitor intake dan output",
                "Kompres air hangat",
                "Anjurkan minum banyak",
                "Anjurkan pakai baju tipis",
            ],
            [
                "Monitor Suhu, TD, Nadi, R",
                "Monitor suhu tiap 2 jam",
                "Monitor warna kulit",
                "Kompres air hangat",
                "Beri selimut tebal",
                "Beri oles-oles penghangat tubuh",
            ],
            [
                "Pertahanan intake dan output yg adekuat",
                "Monitor status hidrasi",
                "Monitor TTV",
                "Monitor status nutrisi",
                "Monitor respon terhadap penanambahan cairan",
                "Monitor berat badan",
            ],
            [
                "Jauhkan barang-barang di sekitar klien untuk menghindari perlukaan",
                "Berikan alas  empuk dibawah kepala  jika memungkinkan",
                "Pertahankan kepatenan jalan nafas / Miringkan klien untuk membebaskan jalan nafas",
                "Berikan therapy O2 4 lpm",
                "Kolaborasi dengan dokter dalam pemberian therapy obat",
                "Monitor TTV",
                "Dampingi selama periode kejang",
                "Catat durasi kejang",
            ],
            [
                "Angkat balutan dan pelster perekat",
                "Monitor karakterisktik luka,termasuk drainase, warna, ukuran, dan bau",
                "Ukur luas luka yang sesuai",
                "Monitor tanda infeksi",
                "Lakukan teknik perawatan luka dentan steril",
                "Pertahankan teknik balutan steril ketika melakukan perawatan luka yang tepat",
                "Periksa luka setiap kali perubahan balutan",
                "Bandingkan dan catat setiap perubahan luka",
                "Reposisi pasien setidaknya setiap 2 jam dengan tepat",
                "Rujuk pada praktisiostomy dengan tepat",
                "Rujuk pada ahli diet dengan tepat",
                "Dokumentasikan lokasi luka,ukuran,dan tampilan",
                "Kolaborasi dengan dokter pemberian obat",
            ]
        ];

        for ($i = 0; $i < sizeof($intervensi); $i++) {
            if (sizeof($intervensi[$i]) > 0) {
                foreach ($intervensi[$i] as $d) {
                    DB::table('askep_intervensi_diagnosa')->insert([
                        'id_diagnosa' => $i,
                        'intervensi' => $d
                    ]);
                }
            }
        }
    }
}
