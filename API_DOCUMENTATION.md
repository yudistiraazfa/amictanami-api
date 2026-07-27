# 📱 Tanami API Documentation (for Android Studio)

Dokumentasi lengkap REST API **Tanami** untuk konsumsi aplikasi **Android Studio (Kotlin / Java)**.

---

## 🌐 Base URL

- **Development (Emulator Android Studio)**: `http://10.0.2.2:8000/api/`
- **Development (Device Fisik)**: `http://<IP_LOKAL_LAPTOP>:8000/api/`
- **Production (Railway)**: `https://amictanami-api-production.up.railway.app/api/`

---

## ⚙️ Kode Kotlin Retrofit Interface (`ApiService.kt`)

Anda dapat menyalin langsung interface Retrofit berikut ke proyek Android Studio Anda:

```kotlin
import retrofit2.Call
import retrofit2.http.*

interface ApiService {

    // === AUTENTIKASI & AKUN ===

    @POST("register.php")
    fun register(@Body request: RegisterRequest): Call<BaseResponse<UserData>>

    @POST("login.php")
    fun login(@Body request: LoginRequest): Call<BaseResponse<UserData>>

    @POST("forgot_password.php")
    fun forgotPassword(@Body request: ForgotPasswordRequest): Call<BaseResponse<CodeData>>

    @POST("verify_code.php")
    fun verifyCode(@Body request: VerifyCodeRequest): Call<VerifyCodeResponse>

    @POST("reset_password.php")
    fun resetPassword(@Body request: ResetPasswordRequest): Call<BaseResponse<Nothing>>

    @POST("get_profile.php")
    fun getProfile(@Body request: UserDbIdRequest): Call<BaseResponse<UserData>>

    @POST("update_profile.php")
    fun updateProfile(@Body request: UpdateProfileRequest): Call<BaseResponse<Nothing>>


    // === KATALOG & PANDUAN TANAMAN ===

    @GET("get_all_tanaman.php")
    fun getAllTanaman(): Call<BaseResponse<List<TanamanItem>>>

    @GET("get_tanaman_by_id.php")
    fun getTanamanById(@Query("id") id: Int): Call<BaseResponse<TanamanItem>>

    @GET("get_tanaman_by_kategori.php")
    fun getTanamanByKategori(@Query("kategori_id") kategoriId: Int): Call<BaseResponse<List<TanamanItem>>>

    @GET("search_tanaman.php")
    fun searchTanaman(@Query("query") query: String): Call<BaseResponse<List<TanamanItem>>>

    @GET("get_detail_tanaman.php")
    fun getDetailTanaman(@Query("id") id: Int): Call<BaseResponse<PlantDetailData>>


    // === LOG AKTIVITAS & TANAMCARE ===

    @POST("add_log.php")
    fun addLog(@Body request: AddLogRequest): Call<BaseResponse<Nothing>>

    @POST("get_logs.php")
    fun getLogs(@Body request: UserDbIdRequest): Call<BaseResponse<List<LogItem>>>

    @POST("add_tanamcare_history.php")
    fun addTanamCareHistory(@Body request: AddTanamCareRequest): Call<BaseResponse<Nothing>>

    @POST("get_tanamcare_history.php")
    fun getTanamCareHistory(@Body request: UserDbIdRequest): Call<BaseResponse<List<TanamCareItem>>>
}
```

---

## 📑 Detailed Endpoint Reference

### 1. Register User
- **URL**: `POST /api/register.php`
- **Request Body**:
```json
{
  "nama": "Bos Tani",
  "email": "bostani@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```
- **Response**:
```json
{
  "success": true,
  "message": "User was created.",
  "data": {
    "id": 1,
    "nama": "Bos Tani",
    "email": "bostani@example.com"
  }
}
```

---

### 2. Login User
- **URL**: `POST /api/login.php`
- **Request Body**:
```json
{
  "email": "bostani@example.com",
  "password": "password123"
}
```
- **Response**:
```json
{
  "success": true,
  "message": "Login successful.",
  "data": {
    "id": 1,
    "nama": "Bos Tani",
    "email": "bostani@example.com",
    "token": "3f8b1c4e..."
  }
}
```

---

### 3. Lupa Password (Minta Kode OTP)
- **URL**: `POST /api/forgot_password.php`
- **Request Body**:
```json
{
  "email": "bostani@example.com"
}
```
- **Response**:
```json
{
  "success": true,
  "message": "Verification code generated.",
  "data": {
    "code": "847291"
  }
}
```

---

### 4. Verifikasi Kode OTP
- **URL**: `POST /api/verify_code.php`
- **Request Body**:
```json
{
  "email": "bostani@example.com",
  "code": "847291"
}
```
- **Response**:
```json
{
  "success": true,
  "message": "Code verified.",
  "reset_token": "9a0b1c2d3e4f..."
}
```

---

### 5. Reset Password Baru
- **URL**: `POST /api/reset_password.php`
- **Request Body**:
```json
{
  "email": "bostani@example.com",
  "reset_token": "9a0b1c2d3e4f...",
  "password": "newpassword123",
  "password_confirmation": "newpassword123"
}
```
- **Response**:
```json
{
  "success": true,
  "message": "Password has been reset."
}
```

---

### 6. Ambil Profil User
- **URL**: `POST /api/get_profile.php`
- **Request Body**:
```json
{
  "id": 1
}
```
- **Response**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nama": "Bos Tani",
    "email": "bostani@example.com",
    "created_at": "2026-01-15T00:00:00.000000Z"
  }
}
```

---

### 7. Update Profil User
- **URL**: `POST /api/update_profile.php`
- **Request Body**:
```json
{
  "id": 1,
  "nama": "Bos Tani Terbaru",
  "email": "bostaninew@example.com",
  "password": "optional_new_password"
}
```
- **Response**:
```json
{
  "success": true,
  "message": "Profil berhasil diperbarui"
}
```

---

### 8. Ambil Semua Tanaman
- **URL**: `GET /api/get_all_tanaman.php`
- **Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nama_umum": "Cabai",
      "nama_latin": "Capsicum annum",
      "deskripsi": "Tanaman cabai merah yang populer...",
      "gambar_url": "images/cabai.jpg",
      "kategori_id": 1,
      "nama_kategori": "Sayuran"
    }
  ]
}
```

---

### 9. Detail Lengkap Panduan Tanaman
- **URL**: `GET /api/get_detail_tanaman.php?id=1`
- **Response**:
```json
{
  "success": true,
  "data": {
    "tanaman": {
      "id": 1,
      "nama_umum": "Cabai",
      "nama_latin": "Capsicum annum",
      "deskripsi": "Tanaman cabai merah...",
      "gambar_url": "images/cabai.jpg",
      "kategori_id": 1,
      "nama_kategori": "Sayuran"
    },
    "bibit_media": {
      "jenis_bibit": "Biji cabai",
      "sumber_bibit": "Gunakan biji cabai dari buah matang",
      "jenis_media": "Campuran tanah subur, kompos, sekam bakar",
      "rasio_media": "2:1:1",
      "drainase": "Drainase baik",
      "ukuran_pot": "Diameter minimum 20-30 cm"
    },
    "penyiraman": {
      "frekuensi": "1-2 kali sehari saat media kering",
      "waktu_penyiraman": "Siram secukupnya",
      "cara_penyiraman": "Siram pada bagian tanah",
      "kondisi_khusus": "Kurangi saat musim hujan"
    },
    "pemupukan": {
      "jenis_pupuk": "Pupuk kandang/kompos",
      "dosis": "Secukupnya sebagai dasar",
      "frekuensi": "Saat penanaman",
      "cara_aplikasi": "Campur dengan media tanam",
      "catatan": "Tambahkan pupuk NPK saat berbunga"
    },
    "perawatan": [
      {
        "jenis_perawatan": "Penyiangan gulma",
        "frekuensi": "Sesuai kebutuhan",
        "cara_perawatan": "Cabut gulma di sekitar tanaman",
        "waktu_pelaksanaan": "Kapan saja",
        "peralatan": "Tangan atau cangkul kecil"
      }
    ],
    "masa_panen": {
      "durasi_tanam": "90-120 hari setelah tanam",
      "ciri_siap_panen": "Cabai berwarna merah penuh",
      "cara_panen": "Petik dengan tangkai",
      "frekuensi_panen": "Setiap 3-5 hari",
      "hasil_panen": "Bervariasi"
    }
  }
}
```

---

### 10. Tambah Log Aktivitas
- **URL**: `POST /api/add_log.php`
- **Request Body**:
```json
{
  "user_id": 1,
  "judul": "Penyiraman Manual",
  "jam": "18:44",
  "tanggal": "27 Juli 2026",
  "tipe": "MANUAL"
}
```
- **Response**:
```json
{
  "success": true,
  "message": "Log aktivitas berhasil ditambahkan."
}
```

---

### 11. Ambil Log Aktivitas User
- **URL**: `POST /api/get_logs.php`
- **Request Body**:
```json
{
  "user_id": 1
}
```
- **Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "judul": "Penyiraman Manual",
      "jam": "18:44",
      "tanggal": "27 Juli 2026",
      "tipe": "MANUAL"
    }
  ]
}
```

---

### 12. Simpan Riwayat TanamCare (AI Diagnosa)
- **URL**: `POST /api/add_tanamcare_history.php`
- **Request Body**:
```json
{
  "user_id": 1,
  "title": "Hama Pengunyah Daun 🐛🌿",
  "date": "2026-07-27 13:39:39",
  "explanation": "Banyak lubang pada daun...",
  "solution": "1. Bersihkan hama\n2. Semprot neem oil",
  "image_base64": "data:image/jpeg;base64,/9j/4AAQSkZJRg..."
}
```
- **Response**:
```json
{
  "success": true,
  "message": "History saved successfully."
}
```

---

### 13. Ambil Riwayat TanamCare
- **URL**: `POST /api/get_tanamcare_history.php`
- **Request Body**:
```json
{
  "user_id": 1
}
```
- **Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Hama Pengunyah Daun 🐛🌿",
      "date": "2026-07-27 13:39:39",
      "explanation": "Banyak lubang pada daun...",
      "solution": "1. Bersihkan hama...",
      "image_path": "uploads/tanamcare/6a675f9b7118e.jpg",
      "image_url": "http://10.0.2.2:8000/uploads/tanamcare/6a675f9b7118e.jpg"
    }
  ]
}
```
