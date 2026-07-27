# Rencana Implementasi: Perombakan UI & Integrasi Database

Dokumen ini merangkum rencana untuk mengubah tampilan halaman Tambah Perangkat menjadi form input asli, serta menyambungkan Profile, Dashboard, dan History TanamCare ke *database* via Retrofit (API PHP).

## ⚠️ User Review Required (Perlu Persetujuan Anda)

> [!WARNING]  
> **Ketergantungan Backend (Tugas Aswad):** 
> Karena kita akan mengintegrasikan Profile dan History TanamCare ke database, saya akan membuatkan "jalur" (Endpoint Retrofit) di aplikasi Android. **Namun, Aswad harus membuatkan script PHP-nya di server** (`get_profile.php` dan `get_tanamcare_history.php`) agar aplikasi tidak error saat menarik data. Apakah Aswad sudah membuat script tersebut, atau haruskah saya siapkan struktur *request/response*-nya saja agar nanti Aswad tinggal menyesuaikan PHP-nya?

## Open Questions

1. **History TanamCare:** Saat ini disimpan secara lokal di memori HP. Jika kita pindahkan ke *database*, apakah kita perlu membuat fungsi untuk sinkronisasi (mengirim history lokal lama ke server), atau langsung membaca 100% murni dari *database* (riwayat lama di HP akan hilang)?
2. **Dashboard Greeting:** Saat ini nama diambil dari `SessionManager` ketika login. Apakah cukup menggunakan nama dari *Session*, atau harus men-download ulang nama dari `get_profile.php` setiap kali Dashboard dibuka?

---

## Proposed Changes (Perubahan yang Akan Dilakukan)

### 1. Perombakan Tampilan Tambah Perangkat

Mengganti konsep "Switch Pindai" menjadi Form Input ID yang elegan dan modern.

#### [MODIFY] [tambahperangkat.xml](file:///C:/Users/adams/StudioProjects/tanami/app/src/main/res/layout/tambahperangkat.xml)
- Menghapus `scan_device_switch`, `scan_device_title`, dan `progress_scan`.
- Menambahkan `TextInputLayout` dan `TextInputEditText` bertuliskan "Masukkan ID Perangkat (Cth: TNM-001)".
- Menambahkan tombol `MaterialButton` ("Tambahkan").

#### [MODIFY] [TambahPerangkat.kt](file:///C:/Users/adams/StudioProjects/tanami/app/src/main/java/com/example/tanami/TambahPerangkat.kt)
- Menghapus logika `AlertDialog` yang sebelumnya muncul saat switch ditekan.
- Menggantinya dengan logika membaca teks dari `EditText` lalu memanggil fungsi `saveAndConnect()`.

---

### 2. Integrasi Database (Retrofit)

#### [MODIFY] [ApiService.kt](file:///C:/Users/adams/StudioProjects/tanami/app/src/main/java/com/example/tanami/network/ApiService.kt)
Menambahkan definisi *endpoint* baru untuk berkomunikasi dengan server PHP Aswad:
- `get_profile.php`: Untuk mengambil profil dinamis user.
- `get_tanamcare_history.php`: Untuk mengambil riwayat diagnosa tanaman.

#### [NEW] Data Models (Models.kt)
- Membuat struktur `ProfileResponse` dan `HistoryResponse` agar data JSON dari PHP bisa dibaca oleh Android.

#### [MODIFY] [Profile.kt](file:///C:/Users/adams/StudioProjects/tanami/app/src/main/java/com/example/tanami/Profile.kt)
- Menambahkan pemanggilan Retrofit `getProfile` untuk memperbarui tampilan nama secara dinamis dari database, bukan hanya dari *cache/session* lokal.

#### [MODIFY] [TanamCareHistory.kt](file:///C:/Users/adams/StudioProjects/tanami/app/src/main/java/com/example/tanami/TanamCareHistory.kt)
- Mengganti sumber data dari `HistoryManager` (Lokal) menjadi Retrofit (Cloud/Database).
- Menampilkan indikator *Loading* saat men-download riwayat.

---

## Verification Plan (Rencana Pengujian)

### Manual Verification
1. Anda perlu membuka halaman Tambah Perangkat dan memastikan form input teks berjalan normal dan bisa menyimpan perangkat.
2. Anda/Aswad perlu memastikan *script* PHP di server sudah siap menerima *request* dari aplikasi, lalu menguji login dan membuka halaman Profil & History untuk melihat apakah data dari server berhasil masuk ke Android.
