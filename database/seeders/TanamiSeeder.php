<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TanamiSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Users
        DB::table('users')->insertOrIgnore([
            ['id' => 1, 'nama' => 'Bos Tani', 'email' => 'tanami@bt.com', 'password' => '$2y$12$nMtafcFo2pzjfLZwNrVOROb..zDbtwevc3USMuBG/QgMOI/N6/0jW', 'token' => null, 'email_verified_at' => '2026-01-15 00:00:00', 'created_at' => '2026-01-15 00:00:00', 'updated_at' => '2026-07-23 23:09:21'],
            ['id' => 2, 'nama' => 'Admin Tanami', 'email' => 'admin@tanami.id', 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'token' => null, 'email_verified_at' => '2026-01-15 00:00:00', 'created_at' => '2026-01-15 00:00:00', 'updated_at' => '2026-01-15 00:00:00'],
            ['id' => 3, 'nama' => 'Test User 2', 'email' => 'test2@example.com', 'password' => '$2y$10$iFIdaDE2zznyiPbjMsud5.6Jldh1zytYC1TYZAKH9V0P3Dvk7SjPy', 'token' => null, 'email_verified_at' => null, 'created_at' => '2026-01-15 13:55:58', 'updated_at' => '2026-01-15 13:55:58'],
            ['id' => 4, 'nama' => 'Bos', 'email' => 'tanami@bos.com', 'password' => '$2y$10$yqecwxHFGP7kZ8dGzjTpNOxYA94QgWQCjDIhw7CDfFcWz6gP.lTDy', 'token' => null, 'email_verified_at' => null, 'created_at' => '2026-01-15 14:02:52', 'updated_at' => '2026-07-27 11:20:25'],
            ['id' => 5, 'nama' => 'Aliev', 'email' => 'aliev@pengguna.com', 'password' => '$2y$10$T/9nVicOnq0oIWkpKPk/4u0rbhj8X9MQAmg.jjmKnyJ8Z.bHi3UOW', 'token' => null, 'email_verified_at' => null, 'created_at' => '2026-01-15 14:09:37', 'updated_at' => '2026-01-15 14:09:37'],
            ['id' => 6, 'nama' => 'joya perdana', 'email' => 'joya@dev.id', 'password' => '$2y$10$iVsJ9ojSuLU6nHSt9jINQO5AIVOn4BhiklvtE1ovdogP0W24JsVTS', 'token' => null, 'email_verified_at' => null, 'created_at' => '2026-06-28 02:49:25', 'updated_at' => '2026-06-28 02:49:25'],
        ]);

        // 2. Seed Kategori
        DB::table('kategori')->insertOrIgnore([
            ['id' => 1, 'nama_kategori' => 'Sayuran', 'deskripsi' => 'Tanaman sayur-sayuran untuk konsumsi', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nama_kategori' => 'Tanaman Hias', 'deskripsi' => 'Tanaman untuk dekorasi dan keindahan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nama_kategori' => 'Buah', 'deskripsi' => 'Tanaman buah-buahan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nama_kategori' => 'Herbal', 'deskripsi' => 'Tanaman obat dan rempah', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 3. Seed Tanaman
        DB::table('tanaman')->insertOrIgnore([
            ['id' => 1, 'nama_umum' => 'Cabai', 'nama_latin' => 'Capsicum annum', 'deskripsi' => 'Tanaman cabai merah yang populer untuk bumbu masakan Indonesia', 'gambar_url' => 'images/cabai.jpg', 'kategori_id' => 1, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:07:47'],
            ['id' => 2, 'nama_umum' => 'Mawar', 'nama_latin' => 'Rosa villosa', 'deskripsi' => 'Bunga mawar merah yang cantik untuk taman', 'gambar_url' => 'images/mawar.jpg', 'kategori_id' => 2, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:07:50'],
            ['id' => 3, 'nama_umum' => 'Jagung', 'nama_latin' => 'Zea mays', 'deskripsi' => 'Tanaman jagung untuk pangan dan pakan ternak', 'gambar_url' => 'images/jagung.jpg', 'kategori_id' => 1, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:07:51'],
            ['id' => 4, 'nama_umum' => 'Anggrek', 'nama_latin' => 'Orchidaceae', 'deskripsi' => 'Tanaman hias anggrek dengan bunga cantik', 'gambar_url' => 'images/anggrek.jpg', 'kategori_id' => 2, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:07:52'],
            ['id' => 5, 'nama_umum' => 'Tomat', 'nama_latin' => 'Solanum lycopersicum', 'deskripsi' => 'Tanaman tomat untuk sayuran dan bumbu', 'gambar_url' => 'images/tomat.jpg', 'kategori_id' => 1, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:07:49'],
            ['id' => 6, 'nama_umum' => 'Kentang', 'nama_latin' => 'Solanum tuberosum', 'deskripsi' => 'Tanaman umbi kentang untuk konsumsi', 'gambar_url' => 'images/kentang.jpg', 'kategori_id' => 1, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:08:05'],
            ['id' => 7, 'nama_umum' => 'Bayam', 'nama_latin' => 'Amaranthus sp.', 'deskripsi' => 'Sayuran hijau kaya nutrisi', 'gambar_url' => 'images/bayam.jpg', 'kategori_id' => 1, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:07:53'],
            ['id' => 8, 'nama_umum' => 'Terong Ungu', 'nama_latin' => 'Solanum melongena L', 'deskripsi' => 'Sayuran terong berwarna ungu', 'gambar_url' => 'images/terong.jpg', 'kategori_id' => 1, 'created_at' => '2025-10-19 12:09:33', 'updated_at' => '2025-11-02 22:07:53'],
        ]);

        // 4. Seed Bibit Media
        DB::table('bibit_media')->insertOrIgnore([
            ['id' => 1, 'tanaman_id' => 1, 'jenis_bibit' => 'Biji cabai', 'sumber_bibit' => 'Gunakan biji cabai dari buah matang atau bibit siap tanam', 'jenis_media' => 'Campuran tanah subur, kompos, sekam bakar', 'rasio_media' => '2:1:1', 'drainase' => 'Drainase baik', 'ukuran_pot' => 'Diameter minimum 20-30 cm', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'tanaman_id' => 2, 'jenis_bibit' => 'Stek batang', 'sumber_bibit' => 'Stek batang mawar yang sehat', 'jenis_media' => 'Tanah gembur, kompos, pasir', 'rasio_media' => '2:1:1', 'drainase' => 'Drainase baik', 'ukuran_pot' => 'Diameter minimum 25 cm', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'tanaman_id' => 3, 'jenis_bibit' => 'Biji jagung', 'sumber_bibit' => 'Biji jagung hibrida berkualitas', 'jenis_media' => 'Tanah subur, pupuk kandang', 'rasio_media' => '3:1', 'drainase' => 'Drainase sedang', 'ukuran_pot' => 'Langsung di lahan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'tanaman_id' => 4, 'jenis_bibit' => 'Anakan anggrek', 'sumber_bibit' => 'Anakan atau bibit dari induk', 'jenis_media' => 'Media pakis, arang, sabut kelapa', 'rasio_media' => '1:1:1', 'drainase' => 'Drainase sangat baik', 'ukuran_pot' => 'Pot khusus anggrek', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'tanaman_id' => 5, 'jenis_bibit' => 'Biji atau bibit', 'sumber_bibit' => 'Biji tomat atau bibit siap tanam', 'jenis_media' => 'Tanah subur, kompos, sekam', 'rasio_media' => '2:1:1', 'drainase' => 'Drainase baik', 'ukuran_pot' => 'Diameter 30 cm', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'tanaman_id' => 6, 'jenis_bibit' => 'Umbi bibit', 'sumber_bibit' => 'Umbi kentang dengan mata tunas', 'jenis_media' => 'Tanah gembur, kompos', 'rasio_media' => '2:1', 'drainase' => 'Drainase baik', 'ukuran_pot' => 'Polybag besar atau lahan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'tanaman_id' => 7, 'jenis_bibit' => 'Biji bayam', 'sumber_bibit' => 'Biji bayam berkualitas', 'jenis_media' => 'Tanah subur, pupuk kandang', 'rasio_media' => '2:1', 'drainase' => 'Drainase sedang', 'ukuran_pot' => 'Polybag atau langsung', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'tanaman_id' => 8, 'jenis_bibit' => 'Biji atau bibit', 'sumber_bibit' => 'Biji terong atau bibit siap tanam', 'jenis_media' => 'Tanah subur, kompos, sekam', 'rasio_media' => '2:1:1', 'drainase' => 'Drainase baik', 'ukuran_pot' => 'Diameter 25-30 cm', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 5. Seed Penyiraman
        DB::table('penyiraman')->insertOrIgnore([
            ['id' => 1, 'tanaman_id' => 1, 'frekuensi' => '1-2 kali sehari saat media kering', 'waktu_penyiraman' => 'Siram secukupnya', 'cara_penyiraman' => 'Siram pada bagian tanah, hindari genangan', 'kondisi_khusus' => 'Kurangi saat musim hujan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'tanaman_id' => 2, 'frekuensi' => '1 kali sehari', 'waktu_penyiraman' => 'Pagi atau sore hari', 'cara_penyiraman' => 'Siram pada media tanam, jangan sampai menggenang', 'kondisi_khusus' => 'Perhatikan kelembaban udara', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'tanaman_id' => 3, 'frekuensi' => '2-3 kali seminggu', 'waktu_penyiraman' => 'Pagi hari', 'cara_penyiraman' => 'Siram merata pada area tanam', 'kondisi_khusus' => 'Butuh air lebih saat fase pembungaan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'tanaman_id' => 4, 'frekuensi' => '2-3 kali seminggu', 'waktu_penyiraman' => 'Pagi hari dengan semprotan halus', 'cara_penyiraman' => 'Semprot pada akar dan media', 'kondisi_khusus' => 'Hindari air berlebih pada daun', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'tanaman_id' => 5, 'frekuensi' => '1-2 kali sehari', 'waktu_penyiraman' => 'Pagi dan sore', 'cara_penyiraman' => 'Siram merata pada tanah', 'kondisi_khusus' => 'Jaga kelembaban tanah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'tanaman_id' => 6, 'frekuensi' => 'Sesuai kebutuhan', 'waktu_penyiraman' => 'Pagi hari', 'cara_penyiraman' => 'Siram saat tanah mulai kering', 'kondisi_khusus' => 'Hindari genangan air', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'tanaman_id' => 7, 'frekuensi' => '1-2 kali sehari', 'waktu_penyiraman' => 'Pagi dan sore', 'cara_penyiraman' => 'Siram dengan gembor halus', 'kondisi_khusus' => 'Jaga tanah tetap lembab', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'tanaman_id' => 8, 'frekuensi' => '1-2 kali sehari', 'waktu_penyiraman' => 'Pagi dan sore', 'cara_penyiraman' => 'Siram merata pada area perakaran', 'kondisi_khusus' => 'Kurangi saat mendekati panen', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 6. Seed Pemupukan
        DB::table('pemupukan')->insertOrIgnore([
            ['id' => 1, 'tanaman_id' => 1, 'jenis_pupuk' => 'Pupuk kandang/kompos', 'dosis' => 'Secukupnya sebagai dasar', 'frekuensi' => 'Saat penanaman', 'cara_aplikasi' => 'Campur dengan media tanam', 'catatan' => 'Tambahkan pupuk NPK saat berbunga', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'tanaman_id' => 1, 'jenis_pupuk' => 'NPK', 'dosis' => '1 sendok makan per tanaman', 'frekuensi' => 'Setiap 2-3 minggu', 'cara_aplikasi' => 'Taburkan di sekitar tanaman', 'catatan' => 'Untuk meningkatkan produktivitas buah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'tanaman_id' => 2, 'jenis_pupuk' => 'Pupuk kandang', 'dosis' => 'Secukupnya', 'frekuensi' => 'Setiap 1 bulan', 'cara_aplikasi' => 'Campur dengan tanah di sekitar pangkal', 'catatan' => 'Gunakan pupuk organik', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'tanaman_id' => 3, 'jenis_pupuk' => 'Pupuk kandang', 'dosis' => '2-3 kg per m2', 'frekuensi' => 'Saat pengolahan lahan', 'cara_aplikasi' => 'Campurkan ke tanah', 'catatan' => 'Tambah NPK saat tanaman berumur 3-4 minggu', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'tanaman_id' => 4, 'jenis_pupuk' => 'Pupuk NPK khusus anggrek', 'dosis' => 'Sesuai petunjuk kemasan', 'frekuensi' => 'Setiap 2 minggu', 'cara_aplikasi' => 'Semprotkan pada akar dan daun', 'catatan' => 'Gunakan dosis rendah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'tanaman_id' => 5, 'jenis_pupuk' => 'Pupuk kandang/kompos', 'dosis' => 'Secukupnya', 'frekuensi' => 'Saat penanaman', 'cara_aplikasi' => 'Campur dengan media', 'catatan' => 'NPK setiap 2-3 minggu setelah tanam', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'tanaman_id' => 6, 'jenis_pupuk' => 'Pupuk kandang', 'dosis' => '2-3 kg per m2', 'frekuensi' => 'Saat pengolahan lahan', 'cara_aplikasi' => 'Aduk rata dengan tanah', 'catatan' => 'Tambah NPK saat tanaman tumbuh', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'tanaman_id' => 7, 'jenis_pupuk' => 'Pupuk kompos', 'dosis' => 'Secukupnya', 'frekuensi' => 'Setiap 2 minggu', 'cara_aplikasi' => 'Taburkan di sekitar tanaman', 'catatan' => 'Bisa dengan pupuk cair', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'tanaman_id' => 8, 'jenis_pupuk' => 'Pupuk kandang', 'dosis' => 'Secukupnya', 'frekuensi' => 'Saat penanaman', 'cara_aplikasi' => 'Campur dengan media', 'catatan' => 'NPK setiap 2-3 minggu', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 7. Seed Perawatan
        DB::table('perawatan')->insertOrIgnore([
            ['id' => 1, 'tanaman_id' => 1, 'jenis_perawatan' => 'Penyiangan gulma', 'frekuensi' => 'Sesuai kebutuhan', 'cara_perawatan' => 'Cabut gulma yang tumbuh di sekitar tanaman', 'waktu_pelaksanaan' => 'Kapan saja saat ada gulma', 'peralatan' => 'Tangan atau cangkul kecil', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'tanaman_id' => 1, 'jenis_perawatan' => 'Pemangkasan', 'frekuensi' => 'Saat diperlukan', 'cara_perawatan' => 'Pangkas daun tua atau cabang tidak produktif', 'waktu_pelaksanaan' => 'Saat tanaman dewasa', 'peralatan' => 'Gunting tanaman', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'tanaman_id' => 2, 'jenis_perawatan' => 'Pemangkasan', 'frekuensi' => 'Rutin', 'cara_perawatan' => 'Pangkas daun kering dan ranting mati', 'waktu_pelaksanaan' => 'Setiap 2-3 minggu', 'peralatan' => 'Gunting stek steril', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'tanaman_id' => 2, 'jenis_perawatan' => 'Pengendalian hama', 'frekuensi' => 'Saat terlihat hama', 'cara_perawatan' => 'Semprotkan pestisida organik', 'waktu_pelaksanaan' => 'Pagi atau sore hari', 'peralatan' => 'Sprayer', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'tanaman_id' => 3, 'jenis_perawatan' => 'Pembumbunan', 'frekuensi' => '2 kali', 'cara_perawatan' => 'Timbun pangkal batang dengan tanah', 'waktu_pelaksanaan' => 'Umur 3-4 minggu dan 6-7 minggu', 'peralatan' => 'Cangkul', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'tanaman_id' => 4, 'jenis_perawatan' => 'Pemangkasan akar udara', 'frekuensi' => 'Sesuai kebutuhan', 'cara_perawatan' => 'Pangkas akar udara yang rusak', 'waktu_pelaksanaan' => 'Kapan saja', 'peralatan' => 'Gunting steril', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'tanaman_id' => 5, 'jenis_perawatan' => 'Pewiwilan', 'frekuensi' => 'Rutin', 'cara_perawatan' => 'Buang tunas air di ketiak daun', 'waktu_pelaksanaan' => 'Setiap minggu', 'peralatan' => 'Tangan atau gunting', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'tanaman_id' => 6, 'jenis_perawatan' => 'Pembumbunan', 'frekuensi' => '1-2 kali', 'cara_perawatan' => 'Timbun pangkal batang', 'waktu_pelaksanaan' => 'Saat tanaman 30-40 hari', 'peralatan' => 'Cangkul kecil', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'tanaman_id' => 7, 'jenis_perawatan' => 'Penyiangan', 'frekuensi' => 'Sesuai kebutuhan', 'cara_perawatan' => 'Cabut gulma di sekitar tanaman', 'waktu_pelaksanaan' => 'Kapan saja', 'peralatan' => 'Tangan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'tanaman_id' => 8, 'jenis_perawatan' => 'Pemangkasan', 'frekuensi' => 'Saat perlu', 'cara_perawatan' => 'Pangkas tunas air dan daun tua', 'waktu_pelaksanaan' => 'Setiap 2 minggu', 'peralatan' => 'Gunting tanaman', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 8. Seed Masa Panen
        DB::table('masa_panen')->insertOrIgnore([
            ['id' => 1, 'tanaman_id' => 1, 'durasi_tanam' => '90-120 hari setelah tanam', 'ciri_siap_panen' => 'Cabai berwarna merah penuh dan keras', 'cara_panen' => 'Petik dengan tangkai menggunakan gunting atau tangan', 'frekuensi_panen' => 'Dapat dipanen berkali-kali setiap 3-5 hari', 'hasil_panen' => 'Bervariasi tergantung perawatan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'tanaman_id' => 2, 'durasi_tanam' => '60-90 hari setelah tanam', 'ciri_siap_panen' => 'Kuncup bunga mekar sempurna', 'cara_panen' => 'Potong dengan gunting di pagi hari', 'frekuensi_panen' => 'Terus menerus saat berbunga', 'hasil_panen' => 'Tergantung ukuran tanaman', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'tanaman_id' => 3, 'durasi_tanam' => '90-120 hari', 'ciri_siap_panen' => 'Tongkol berwarna cokelat, biji keras', 'cara_panen' => 'Patahkan tongkol dari batang', 'frekuensi_panen' => 'Sekali panen', 'hasil_panen' => '2-3 tongkol per tanaman', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'tanaman_id' => 4, 'durasi_tanam' => '6-12 bulan (tergantung jenis)', 'ciri_siap_panen' => 'Bunga mekar sempurna', 'cara_panen' => 'Potong tangkai bunga dengan gunting steril', 'frekuensi_panen' => 'Sesuai masa berbunga', 'hasil_panen' => 'Tergantung jenis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'tanaman_id' => 5, 'durasi_tanam' => '60-90 hari', 'ciri_siap_panen' => 'Buah berwarna merah penuh', 'cara_panen' => 'Petik dengan memutar buah', 'frekuensi_panen' => 'Berkala setiap 3-5 hari', 'hasil_panen' => '2-5 kg per tanaman', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'tanaman_id' => 6, 'durasi_tanam' => '90-120 hari', 'ciri_siap_panen' => 'Daun mulai menguning dan layu', 'cara_panen' => 'Gali umbi dengan hati-hati', 'frekuensi_panen' => 'Sekali panen', 'hasil_panen' => '0.5-1 kg per tanaman', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'tanaman_id' => 7, 'durasi_tanam' => '30-45 hari', 'ciri_siap_panen' => 'Daun cukup lebat', 'cara_panen' => 'Petik daun atau cabut seluruh tanaman', 'frekuensi_panen' => 'Bisa beberapa kali', 'hasil_panen' => 'Tergantung cara panen', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'tanaman_id' => 8, 'durasi_tanam' => '70-90 hari', 'ciri_siap_panen' => 'Buah ukuran penuh dengan warna mengkilap', 'cara_panen' => 'Potong dengan gunting beserta tangkainya', 'frekuensi_panen' => 'Berkala setiap 3-5 hari', 'hasil_panen' => '3-5 buah per tanaman per panen', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 9. Seed Activity Logs
        DB::table('activity_logs')->insertOrIgnore([
            ['id' => 1, 'user_id' => 4, 'judul' => 'Penyiraman Manual', 'jam' => '18:44', 'tanggal' => '27 Juli 2026', 'tipe' => 'MANUAL', 'created_at' => '2026-07-27 11:44:18', 'updated_at' => '2026-07-27 11:44:18'],
            ['id' => 2, 'user_id' => 4, 'judul' => 'Penyiraman Manual', 'jam' => '18:53', 'tanggal' => '27 Juli 2026', 'tipe' => 'MANUAL', 'created_at' => '2026-07-27 11:53:34', 'updated_at' => '2026-07-27 11:53:34'],
        ]);

        // 10. Seed TanamCare History
        DB::table('tanamcare_history')->insertOrIgnore([
            [
                'id' => 1,
                'user_id' => 4,
                'title' => 'Hama Pengunyah Daun 🐛🌿',
                'date' => '2026-07-27 13:39:39',
                'explanation' => 'Wah, daun tanaman kesayanganmu ini kayaknya lagi jadi santapan lezat para tamu tak diundang nih! 🙈 Lihat deh, banyak lubang-lubang bolong dan gerigi di daunnya? Itu tandanya ada hama-hama kecil seperti ulat, belalang, atau siput yang lagi asyik berpesta pora mengunyah daun-daunmu.',
                'solution' => "1. Detektif Daun 🕵️‍♀️: Coba cek di pagi atau sore hari. Cari tahu siapa pelakunya!\n2. Ramuan Ajaib Alami ✨: Semprotkan larutan sabun atau neem oil.\n3. Jaga Kebersihan Lingkungan 🧹: Pastikan area tanaman bersih dari gulma.",
                'image_path' => 'uploads/tanamcare/6a675f9b7118e.jpg',
                'created_at' => '2026-07-27 13:39:39',
                'updated_at' => '2026-07-27 13:39:39',
            ]
        ]);
    }
}
