<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Director;
use App\Models\Gallery;

class AboutAndGallerySeeder extends Seeder
{
    public function run()
    {
        // 1. Settings Tentang Kami
        $aboutSettings = [
            'about_motto' => 'Melayani Sepenuh Hati dengan Kasih Bunda',
            'about_vision' => 'Menjadi Rumah Sakit Ibu dan Anak terdepan, unggul, dan terpercaya di Provinsi Lampung dengan standar pelayanan medis modern bernuansa kekeluargaan.',
            'about_mission' => '<p>RSIA Restu Bunda berkomitmen menjalankan misi:</p><ul><li>Memberikan pelayanan kesehatan ibu, bayi, dan anak yang profesional, komprehensif, dan berorientasi pada keselamatan pasien (patient safety).</li><li>Mengembangkan fasilitas medis modern berbasis teknologi terdepan seperti USG 4D Fetomaternal dan metode persalinan minim rasa nyeri (ERACS).</li><li>Mewujudkan lingkungan rumah sakit yang ramah anak, nyaman, asri, dan menenangkan bagi seluruh keluarga.</li><li>Meningkatkan kompetensi tenaga medis, dokter spesialis, bidan, dan perawat secara berkesinambungan.</li></ul>',
            'about_history' => '<p><strong>RSIA Restu Bunda</strong> berawal dari sebuah Rumah Bersalin sederhana yang didirikan dengan niat tulus memberikan tempat persalinan yang aman, nyaman, dan penuh kehangatan bagi para ibu di Kota Bandar Lampung.</p><p>Seiring tingginya kepercayaan keluarga dan dedikasi tim medis, pada tahun 2015 institusi ini bertransformasi menjadi <strong>Rumah Sakit Khusus Ibu dan Anak (RSIA)</strong> dengan peningkatan sarana, poliklinik spesialis anak, kebidanan &amp; kandungan, instalasi gawat darurat (IGD) 24 jam, serta ruang perawatan intensif bayi (NICU/Perinatologi).</p><p>Hingga kini, RSIA Restu Bunda telah mengantongi akreditasi <strong>Paripurna</strong> dan terus berinovasi mengawal kesehatan buah hati sejak masa kehamilan hingga tumbuh kembang optimal.</p>',
            'about_history_image' => 'hero.jpg',
            'about_core_values' => '<p>Nilai utama yang kami junjung tinggi:</p><ul><li><strong>Kasih (Care)</strong>: Melayani setiap pasien selayaknya anggota keluarga sendiri.</li><li><strong>Profesional (Professional)</strong>: Bekerja sesuai standar medis tertinggi dan etika profesi kedokteran.</li><li><strong>Integritas (Integrity)</strong>: Transparansi, kejujuran, dan tanggung jawab dalam setiap tindakan medis.</li><li><strong>Empati (Empathy)</strong>: Memahami kekhawatiran orang tua dan memberikan ketenangan hati.</li></ul>',
        ];

        foreach ($aboutSettings as $key => $val) {
            Setting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'about']);
        }

        // 2. Sample Directors (Jajaran Direksi & Manajemen)
        $directors = [
            [
                'name' => 'dr. Amanda Putri, Sp.A, M.Kes',
                'position' => 'Direktur Utama (Direktur Eksekutif)',
                'photo' => 'doctor_amanda.jpg',
                'bio' => '<p>Berdedikasi lebih dari 15 tahun dalam manajemen kesehatan anak dan pengembangan standar keselamatan pasien di rumah sakit ibu dan anak.</p>',
                'order_num' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'dr. Basyir Ahmad, Sp.OG(K)',
                'position' => 'Direktur Pelayanan Medis & Keperawatan',
                'photo' => 'doctor_basyir.jpg',
                'bio' => '<p>Pakar fetomaternal dan pelopor metode persalinan modern minim nyeri (ERACS) yang ramah dan menenangkan bagi ibu melahirkan.</p>',
                'order_num' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'dr. Citra Lestari, M.M., MARS',
                'position' => 'Direktur Umum, SDM & Keuangan',
                'photo' => 'doctor_citra.jpg',
                'bio' => '<p>Fokus pada tata kelola rumah sakit modern, digitalisasi pelayanan antrian pasien, dan kenyamanan lingkungan rumah sakit bagi keluarga.</p>',
                'order_num' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($directors as $dir) {
            Director::updateOrCreate(['name' => $dir['name']], $dir);
        }

        // 3. Sample Galleries
        $galleries = [
            [
                'title' => 'Senam Hamil Sehat Bersama Bidan Profesional',
                'category' => 'Kegiatan & Edukasi',
                'image' => 'article_2.jpg',
                'description' => '<p>Kelas persiapan persalinan alami, latihan pernapasan, dan edukasi relaksasi bagi ibu hamil trimester ketiga.</p>',
                'event_date' => now()->subDays(5)->format('Y-m-d'),
                'order_num' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pelayanan Poliklinik Spesialis Anak & Tumbuh Kembang',
                'category' => 'Pelayanan Medis',
                'image' => 'article_1.jpg',
                'description' => '<p>Pemeriksaan rutin bayi dan anak dengan pendekatan ramah, menyenangkan, dan minim trauma bagi si kecil.</p>',
                'event_date' => now()->subDays(12)->format('Y-m-d'),
                'order_num' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Fasilitas Kamar Perawatan VIP yang Nyaman & Asri',
                'category' => 'Fasilitas & Kamar',
                'image' => 'facility_vip.jpg',
                'description' => '<p>Kamar rawat inap dengan pencahayaan alami, fasilitas pendukung keluarga lengkap, dan suasana tenang untuk pemulihan pasca persalinan.</p>',
                'event_date' => now()->subDays(20)->format('Y-m-d'),
                'order_num' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Pojok Laktasi & Konseling Menyusui Eksklusif',
                'category' => 'Kegiatan & Edukasi',
                'image' => 'facility_lactation.jpg',
                'description' => '<p>Pendampingan ibu menyusui oleh konselor laktasi bersertifikasi untuk memastikan keberhasilan ASI eksklusif sejak hari pertama.</p>',
                'event_date' => now()->subDays(25)->format('Y-m-d'),
                'order_num' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Ruang Bermain Ceria Ramah Anak (Kids Playground)',
                'category' => 'Fasilitas & Kamar',
                'image' => 'facility_playground.jpg',
                'description' => '<p>Area tunggu bermain edukatif yang bersih dan aman agar anak-anak betah dan terhibur saat menunggu giliran konsultasi.</p>',
                'event_date' => now()->subDays(30)->format('Y-m-d'),
                'order_num' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Pemeriksaan USG 4D Fetomaternal Janin Beresolusi Tinggi',
                'category' => 'Pelayanan Medis',
                'image' => 'article_3.jpg',
                'description' => '<p>Melihat senyum pertama dan detail pertumbuhan fisik buah hati di dalam kandungan dengan teknologi pencitraan 4D termutakhir.</p>',
                'event_date' => now()->subDays(35)->format('Y-m-d'),
                'order_num' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gal) {
            Gallery::updateOrCreate(['title' => $gal['title']], $gal);
        }
    }
}
