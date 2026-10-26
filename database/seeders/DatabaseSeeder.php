<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Facility;
use App\Models\Article;
use App\Models\Appointment;
use App\Models\Testimonial;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@restubunda.co.id'],
            [
                'name' => 'Administrator RSIA Restu Bunda',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Doctors
        $doc1 = Doctor::updateOrCreate(
            ['name' => 'dr. Amanda, Sp.A'],
            [
                'specialty' => 'Spesialis Anak & Tumbuh Kembang',
                'category' => 'anak',
                'experience' => '10+ Tahun',
                'bio' => 'Berpengalaman lebih dari 10 tahun mendampingi tumbuh kembang buah hati dengan pendekatan holistik dan penuh kelembutan.',
                'schedule_days' => 'Senin - Kamis',
                'schedule_hours' => '08.00 - 14.00 WIB',
                'photo' => 'doctor_amanda.jpg',
                'sip_number' => '446/SIP.D-A/01/2020',
                'is_active' => true,
                'order_num' => 1,
            ]
        );

        $doc2 = Doctor::updateOrCreate(
            ['name' => 'dr. Basyir, Sp.OG'],
            [
                'specialty' => 'Spesialis Kebidanan & Kandungan',
                'category' => 'kebidanan',
                'experience' => '15+ Tahun',
                'bio' => 'Ahli penanganan kehamilan risiko tinggi, USG 4D fetomaternal, dan proses persalinan minim rasa nyeri (metode ERACS).',
                'schedule_days' => 'Senin - Sabtu',
                'schedule_hours' => '13.00 - 19.00 WIB',
                'photo' => 'doctor_basyir.jpg',
                'sip_number' => '446/SIP.D-OG/02/2018',
                'is_active' => true,
                'order_num' => 2,
            ]
        );

        $doc3 = Doctor::updateOrCreate(
            ['name' => 'dr. Citra, Sp.A, M.Kes'],
            [
                'specialty' => 'Spesialis Anak & Neonatologi',
                'category' => 'anak',
                'experience' => '8+ Tahun',
                'bio' => 'Fokus perawatan intensif bayi baru lahir (NICU/PICU), resusitasi neonatus, dan tata laksana gizi serta alergi pada anak.',
                'schedule_days' => 'Selasa, Kamis, Sabtu',
                'schedule_hours' => '09.00 - 15.00 WIB',
                'photo' => 'doctor_citra.jpg',
                'sip_number' => '446/SIP.D-A/03/2022',
                'is_active' => true,
                'order_num' => 3,
            ]
        );

        // 3. Services
        $services = [
            [
                'title' => 'Kandungan & Kebidanan',
                'slug' => 'kandungan-kebidanan',
                'icon' => 'flower',
                'badge' => 'Unggulan',
                'description' => 'Pelayanan komprehensif mulai dari masa prakonsepsi, pemeriksaan kehamilan terpadu (ANC), hingga persalinan normal dan caesar metode ERACS minim nyeri.',
                'details' => 'Dikelola oleh dokter spesialis obstetri & ginekologi berpengalaman dengan alat penunjang canggih serta bidan pendamping 24 jam.',
                'order_num' => 1,
            ],
            [
                'title' => 'Spesialis Anak (Pediatrik)',
                'slug' => 'spesialis-anak-pediatrik',
                'icon' => 'baby',
                'badge' => '24 Jam',
                'description' => 'Perawatan menyeluruh kesehatan bayi dan anak, penanganan infeksi pediatrik, imunisasi dasar & lanjutan, serta konsultasi nutrisi tumbuh kembang.',
                'details' => 'Poliklinik anak ramah dengan ruang periksa tematik dan dokter spesialis anak yang berdedikasi tinggi.',
                'order_num' => 2,
            ],
            [
                'title' => 'Ruang Persalinan Nyaman',
                'slug' => 'ruang-persalinan-nyaman',
                'icon' => 'home-heart',
                'badge' => 'Modern',
                'description' => 'Delivery suite privat dan higienis berstandar internasional dengan fasilitas pendukung lengkap, didampingi tim bidan dan dokter spesialis ramah.',
                'details' => 'Menghadirkan suasana tenang bernuansa hangat untuk mendukung proses persalinan yang menyenangkan dan aman bagi ibu dan buah hati.',
                'order_num' => 3,
            ],
            [
                'title' => 'USG 4D & Laboratorium',
                'slug' => 'usg-4d-laboratorium',
                'icon' => 'screen-scan',
                'badge' => 'Canggih',
                'description' => 'Teknologi USG 4 Dimensi terkini untuk melihat perkembangan janin dengan jelas serta laboratorium klinis terakreditasi 24 jam.',
                'details' => 'Hasil pencitraan janin real-time resolusi tinggi dan cetak foto warna dengan diagnosa akurat dari dokter konsultan fetomaternal.',
                'order_num' => 4,
            ],
            [
                'title' => 'Klinik Vaksinasi Anak & Ibu',
                'slug' => 'klinik-vaksinasi-anak-ibu',
                'icon' => 'shield-check',
                'badge' => 'IDAI & WHO',
                'description' => 'Layanan imunisasi wajib & tambahan sesuai rekomendasi IDAI dan WHO dengan rantai dingin vaksin yang terjamin mutunya.',
                'details' => 'Tersedia kartu jadwal imunisasi digital dan konsultasi dokter sebelum tindakan imunisasi.',
                'order_num' => 5,
            ],
            [
                'title' => 'Pusat Tumbuh Kembang Anak',
                'slug' => 'pusat-tumbuh-kembang-anak',
                'icon' => 'growth',
                'badge' => 'Terpadu',
                'description' => 'Layanan stimulasi, deteksi dini tumbuh kembang (SDIDTK), terapi wicara, sensori integrasi, okupasi, dan psikologi anak.',
                'details' => 'Fasilitas terpadu dengan terapis profesional dan dokter spesialis anak tumbuh kembang (Sp.A(K)).',
                'order_num' => 6,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        // 4. Facilities
        $facilities = [
            [
                'title' => 'Kamar Rawat Inap VIP',
                'description' => 'Ruang rawat inap eksklusif dengan privasi maksimal, sofa penunggu nyaman, smart TV, pantry pribadi, kulkas, dan kamar mandi air hangat modern.',
                'photo' => 'facility_vip.jpg',
                'badge' => 'Privat & Nyaman',
                'order_num' => 1,
            ],
            [
                'title' => 'Playground Anak Menyenangkan',
                'description' => 'Area bermain anak yang bersih, higienis, aman, dan edukatif untuk mengurangi kecemasan serta kejenuhan si kecil saat berkunjung ke rumah sakit.',
                'photo' => 'facility_playground.jpg',
                'badge' => 'Ramah Anak',
                'order_num' => 2,
            ],
            [
                'title' => 'Ruang Laktasi Tenang',
                'description' => 'Pojok laktasi nyaman dan higienis dilengkapi fasilitas sterilisasi perlengkapan bayi, pendingin ASIP, dan konseling menyusui bersama tim laktasi.',
                'photo' => 'facility_lactation.jpg',
                'badge' => 'Higienis & Tenang',
                'order_num' => 3,
            ],
        ];

        foreach ($facilities as $fac) {
            Facility::updateOrCreate(['title' => $fac['title']], $fac);
        }

        // 5. Testimonials
        $testimonials = [
            [
                'name' => 'Mama Alice',
                'patient_info' => 'Ibu dari Baby Arfa (2 thn)',
                'content' => 'Pengalaman melahirkan di RSIA Restu Bunda luar biasa tenang dan nyaman. Dokter dan susternya sangat sabar memandu saya saat proses inisiasi menyusu dini (IMD) hingga menyusui lancar tanpa stres.',
                'rating' => 5,
                'avatar' => 'avatar_alice.jpg',
                'order_num' => 1,
            ],
            [
                'name' => 'Ibu Dian',
                'patient_info' => 'Bunda dari Kenzo (4 thn)',
                'content' => 'Ruang tunggu anak sangat menyenangkan, ada area bermain sehingga anak tidak takut lagi ke dokter. Dokter spesialisnya menjelaskan kondisi kesehatan dengan sangat detail dan solutif.',
                'rating' => 5,
                'avatar' => 'avatar_dian.jpg',
                'order_num' => 2,
            ],
            [
                'name' => 'Mama Shinta',
                'patient_info' => 'Ibu dari Twins Kian & Kiana',
                'content' => 'Penanganan kelahiran kembar dengan metode ERACS benar-benar membuat proses pemulihan jauh lebih cepat. Dalam 24 jam saya sudah bisa mobilisasi dan menggendong bayi sendiri.',
                'rating' => 5,
                'avatar' => 'avatar_alice.jpg',
                'order_num' => 3,
            ],
        ];

        foreach ($testimonials as $testi) {
            Testimonial::updateOrCreate(['name' => $testi['name']], $testi);
        }

        // 6. Articles
        $articles = [
            [
                'title' => 'Pentingnya Nutrisi Asam Folat di Trimester Pertama Kehamilan',
                'slug' => 'pentingnya-nutrisi-asam-folat-di-trimester-pertama',
                'category' => 'Kehamilan',
                'author' => 'dr. Basyir, Sp.OG',
                'published_at' => now()->subDays(3),
                'excerpt' => 'Panduan nutrisi penting bagi calon ibu untuk mendukung perkembangan tabung saraf dan otak janin secara optimal sejak awal kehamilan.',
                'content' => '<p>Asam folat merupakan salah satu nutrisi paling krusial yang dibutuhkan oleh ibu hamil, terutama pada trimester pertama kehamilan (minggu ke-1 hingga ke-12). Konsumsi asam folat yang cukup dapat mengurangi risiko kelainan tabung saraf janin (neural tube defects) hingga lebih dari 70%.</p><p>Para dokter spesialis obstetri menganjurkan konsumsi minimal 400 hingga 600 mikrogram asam folat per hari yang dapat diperoleh dari sayuran hijau pekat, alpukat, telur, serta suplemen kehamilan yang diresepkan oleh dokter.</p>',
                'image' => 'article_1.jpg',
                'views' => 142,
            ],
            [
                'title' => 'Mengenal Periode Emas Gizi: Panduan Dokter Spesialis Anak',
                'slug' => 'mengenal-periode-emas-gizi-panduan-dokter-anak',
                'category' => 'Tumbuh Kembang',
                'author' => 'dr. Amanda, Sp.A',
                'published_at' => now()->subDays(6),
                'excerpt' => '1000 Hari Pertama Kehidupan (HPK) adalah masa emas tumbuh kembang otak anak. Simak tips menyusun pola gizi seimbang untuk mencegah risiko stunting.',
                'content' => '<p>Periode 1000 Hari Pertama Kehidupan dimulai sejak pembuahan dalam kandungan hingga usia anak mencapai 2 tahun. Pada fase ini, 80% volume otak manusia berkembang.</p><p>Nutrisi kaya protein hewani seperti ikan laut, telur, dan daging sapi memegang peranan krusial dalam pembentukan jaringan saraf dan pencegahan stunting. Jangan ragu untuk berkonsultasi secara berkala dengan dokter spesialis anak mengenai kurva pertumbuhan anak.</p>',
                'image' => 'article_2.jpg',
                'views' => 289,
            ],
            [
                'title' => 'Waspada Flu & Batuk pada Bayi: Kapan Harus ke Dokter?',
                'slug' => 'waspada-flu-batuk-pada-bayi-kapan-harus-ke-dokter',
                'category' => 'Kesehatan Anak',
                'author' => 'dr. Citra, Sp.A, M.Kes',
                'published_at' => now()->subDays(10),
                'excerpt' => 'Tanda-tanda bahaya infeksi pernapasan pada bayi dan pertolongan pertama yang aman di rumah sebelum memutuskan membawa ke IGD rumah sakit.',
                'content' => '<p>Bayi memiliki saluran pernapasan yang relatif sempit dan sistem kekebalan tubuh yang masih berkembang. Ketika flu atau batuk melanda, orang tua seringkali merasa cemas.</p><p>Perhatikan tanda bahaya seperti napas cepat, tarikan dinding dada ke dalam (retraksi), demam di atas 38.5 derajat Celsius yang tidak turun, serta bayi yang enggan menyusu. Jika tanda tersebut muncul, segera bawa ke instalasi gawat darurat atau poliklinik spesialis anak terdekat.</p>',
                'image' => 'article_3.jpg',
                'views' => 315,
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }

        // 7. Settings
        $settings = [
            'hospital_name' => 'RSIA Restu Bunda',
            'tagline' => 'Rumah Sakit Ibu & Anak Terpercaya',
            'badge_city' => 'Rumah Sakit Ibu & Anak Pilihan di Bandar Lampung',
            'phone_emergency' => '0811-7234-5678',
            'phone_callcenter' => '(0721) 789-0123',
            'whatsapp' => '081172345678',
            'address' => 'Jl. Raden Intan No. 88, Tanjung Karang Pusat, Kota Bandar Lampung, Lampung 35117',
            'email' => 'info@restubunda.co.id',
            'stat_doctors' => '35+',
            'stat_patients' => '15k+',
            'stat_service_hours' => '24 Jam',
            'stat_accreditation' => 'A-Grade',
            'operating_hours' => 'Senin - Sabtu: 08.00 - 21.00 WIB | IGD & Ruang Bersalin: 24 Jam Nonstop',
        ];

        foreach ($settings as $k => $v) {
            Setting::updateOrCreate(['key' => $k], ['value' => $v, 'group' => 'general']);
        }

        // 8. Sample Appointments
        $appointments = [
            [
                'booking_code' => 'RB-' . date('Ym') . '-0001',
                'patient_name' => 'Baby Arfa Rizqi',
                'parent_name' => 'Mama Alice',
                'phone' => '081234567890',
                'email' => 'alice@example.com',
                'doctor_id' => $doc1->id,
                'service_category' => 'Spesialis Anak (Pediatrik)',
                'appointment_date' => now()->addDays(1)->format('Y-m-d'),
                'appointment_time' => '09:00 - 10:00 WIB',
                'complaint' => 'Pemeriksaan rutin tumbuh kembang 2 tahun & vaksinasi PCV booster.',
                'status' => 'confirmed',
                'admin_note' => 'Pasien telah dikonfirmasi via WhatsApp, datang 15 menit sebelum jadwal.',
            ],
            [
                'booking_code' => 'RB-' . date('Ym') . '-0002',
                'patient_name' => 'Ibu Nabila Putri',
                'parent_name' => 'Bpk. Fajar Ramadhan',
                'phone' => '082198765432',
                'email' => 'nabila@example.com',
                'doctor_id' => $doc2->id,
                'service_category' => 'Kandungan & Kebidanan',
                'appointment_date' => now()->addDays(2)->format('Y-m-d'),
                'appointment_time' => '14:00 - 15:00 WIB',
                'complaint' => 'Kontrol kehamilan trimester kedua (usia 24 minggu) dan permintaan USG 4D janin.',
                'status' => 'pending',
                'admin_note' => 'Menunggu verifikasi jadwal dokter Basyir di ruang USG 4D.',
            ],
            [
                'booking_code' => 'RB-' . date('Ym') . '-0003',
                'patient_name' => 'Kenzo Abimana (4 thn)',
                'parent_name' => 'Ibu Dian',
                'phone' => '081377889900',
                'email' => 'dian@example.com',
                'doctor_id' => $doc3->id,
                'service_category' => 'Spesialis Anak & Neonatologi',
                'appointment_date' => now()->subDays(2)->format('Y-m-d'),
                'appointment_time' => '10:00 - 11:00 WIB',
                'complaint' => 'Konsultasi alergi susu sapi dan pemantauan pernapasan anak.',
                'status' => 'completed',
                'admin_note' => 'Selesai konsultasi. Resep obat antialergi dan jadwal kontrol 2 minggu lagi.',
            ],
            [
                'booking_code' => 'RB-' . date('Ym') . '-0004',
                'patient_name' => 'Ibu Sarah Amelia',
                'parent_name' => 'Bpk. Hendra Wijaya',
                'phone' => '085211223344',
                'email' => 'sarah@example.com',
                'doctor_id' => $doc2->id,
                'service_category' => 'Ruang Persalinan Nyaman',
                'appointment_date' => now()->addDays(4)->format('Y-m-d'),
                'appointment_time' => '16:00 - 17:00 WIB',
                'complaint' => 'Konsultasi persiapan persalinan ERACS dan booking kamar VIP.',
                'status' => 'confirmed',
                'admin_note' => 'Kamar VIP 201 sudah dipre-booking untuk HPL akhir bulan.',
            ],
        ];

        foreach ($appointments as $apt) {
            Appointment::updateOrCreate(['booking_code' => $apt['booking_code']], $apt);
        }

        $this->call(AboutAndGallerySeeder::class);
    }
}
