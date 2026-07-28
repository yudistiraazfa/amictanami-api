# 🚀 ULTIMATE PITCH DECK TANAMI V2.0 (METODE H.A.P.I + DATA DOKUMEN PROPOSAL & HARDWARE)
### *"Pitching Material Berbasis Data Hardware Presisi, Finansial Rill, & Arsitektur Cloud-AI"*

> **Tagline Utama:**  
> *"Menanam Tumbuhan, Menyiram Harapan, Menumbuhkan Masa Depan"*

---

## 🎯 STRUKTUR PITCHING METODE H.A.P.I

---

### 🎣 H — HOOK (KAITAN MEMUKAU DARI DETIK PERTAMA)
* **Tujuan**: Menghentikan perhatian audiens/juri secara instan dengan fakta mengejutkan & data validasi.
* **Durasi**: 30 Detik Pertama.

> 🎤 **Naskah Verbal Pitcher:**  
> *"Bapak/Ibu Juri yang terhormat... Tahukah Anda bahwa **73% kegagalan urban farming** di perkotaan bukan karena pemiliknya malas, melainkan karena **kesalahan estimasi penyiraman** (*overwatering*) yang membuat akar tanaman busuk tanpa mereka sadari?*  
>  
> *Banyak dari kita bersemangat membeli tanaman hias atau sayuran di rumah. Namun ketika ditinggal tugas luar kota atau mudik beberapa hari, kita pulang menyambut tanaman yang sudah layu dan mati.*  
>  
> *Bagaimana jika setiap tanaman di rumah Anda bisa 'berbicara' saat mereka haus, menyiram dirinya sendiri dengan presisi sensorik, dan memiliki dokter AI pribadi di saku Anda?"*

---

### 👤 A — ANDA SIAPA (KREDIBILITAS & RELEVANSI TIM)
* **Tujuan**: Membangun kepercayaan juri tentang siapa di balik proyek ini dan mengapa tim ini kompeten.
* **Durasi**: 30 Detik.

> 🎤 **Naskah Verbal Pitcher:**  
> *"Saya **[Nama Anda]**, mewakili **Tim TANAMI Universe**. Kami adalah tim inovator muda yang menggabungkan keahlian di bidang **Embedded System (ESP32), Mobile Software Engineering (Kotlin), dan Applied Generative AI**.*  
>  
> *Melalui riset mendalam dan pengujian hardware secara intensif, kami menghadirkan **TANAMI V2.0**: Ekosistem Smart Urban Farming yang mengintegrasikan otomatisasi irigasi sensorik presisi dengan diagnosis kesehatan tanaman berbasis AI."*

---

### 📢 P — PAPARAN (BODY / CORE SYSTEM, HARDWARE & FINANCIAL)
* **Tujuan**: Penjelasan runtut inti masalah, komponen hardware rill, arsitektur data, matriks pesaing, dan proyeksi finansial presisi dari dokumen proposal.
* **Durasi**: 3 Menit.

#### 1. Inti Masalah & Penyebab (Root Causes)
1. **Inefisiensi Irigasi & Pembusukan Akar (Root Rot)**
   * Penyiraman manual/timer biasa menyiram secara statis tanpa melihat kelembaban tanah rill. Akibatnya timbul *hypoxia* akar dan pembusukan.
2. **Keterbatasan Remote Farming (Jaringan LAN Tradisional)**
   * 90% alat IoT DIY di pasaran menggunakan jaringan lokal (WiFi rumahan/mDNS/NSD) yang membuat alat tidak dapat diakses saat pengguna berada di luar kota.
3. **Kebutaan Penyakit & Hama Tanaman**
   * Pengguna pemula tidak memiliki akses informasi medis tanaman saat daun menguning atau bercak hitam, berujung pada kematian tanaman.

#### 2. Solusi & Spesifikasi Komponen Hardware TANAMI V2.0 (Dokumen Resmi IoT Node)
* 🧠 **Mikrokontroler Utama**: **ESP32 DevKit V1** (Dual-Core 2.4GHz WiFi & Bluetooth 4.2 BLE, 30-pin) sebagai unit pemrosesan tepi (*Edge Computing*).
* 💧 **Sensor Kelembaban Tanah Presisi**: **Capacitive Soil Moisture Sensor v1.2** (Signal Analog 600 [Sangat Basah] – 2900 [Sangat Kering]). High-durability & 100% tahan korosi elektrolisis.
* 🌡️ **Sensor Mikroklimat**: **DHT11 / DHT22** (Pengukuran Suhu Lingkungan -40°C–80°C & Kelembaban Udara RH).
* ⚡ **Aktuator & Power Management**: Modul **Relay 5VDC 2-Channel** (Optocoupler Isolated, Active Low) + **Pompa DC Mini Centrifugal 5V (100L/h)** + **Step-Down LM2596** (Konversi Catu Daya Tunggal 12V ke 5V/3.3V) + Enclosure Case **Waterproof IP54**.
* 🌐 **Konektivitas Cloud WAN & Local Auto-Discovery**: Menggabungkan **Cloud MQTT Protocol (`broker.emqx.io`)** untuk akses WAN jarak jauh (Sub-100ms Latency) dan **mDNS/NSD (`_http._tcp`)** untuk *Zero-Config Device ID Pairing*.
* 🤖 **Generative AI Crop Doctor (TanamCare)**: Integrasi **Google Gemini Multimodal AI API** pada aplikasi Android Kotlin untuk mendiagnosa penyakit visual dari foto daun.

#### 3. Arsitektur Komputasi & Logika Fail-Safe
```text
 ┌─────────────────────────┐         ┌──────────────────────────┐         ┌─────────────────────────┐
 │     ESP32 IoT NODE      │         │     MQTT CLOUD BROKER    │         │   ANDROID KOTLIN APP    │
 │  (Edge Processing)      │         │     (broker.emqx.io)     │         │   (HiveMQ Async Client) │
 │                         │         │                          │         │                         │
 │ • Capacitive Soil Sensor│─JSON───>│ • Topic Status           │─JSON───>│ • Realtime Dashboard UI │
 │ • DHT11 Temp & Humidity │         │ • Topic Control & Mode   │         │ • Race-Condition Proof  │
 │ • EEPROM Fail-Safe Loop │<──Cmd───│ • Sub-100ms Latency      │<──Cmd───│ • Auto Reconnect        │
 └────────────┬────────────┘         └──────────────────────────┘         └────────────┬────────────┘
              │                                                                        │
              │ Direct Hardware Trigger                                                │ REST API & AI
              ▼                                                                        ▼
 ┌─────────────────────────┐                                              ┌─────────────────────────┐
 │  RELAY 2CH & DC PUMP    │                                              │  LARAVEL API & GEMINI   │
 └─────────────────────────┘                                              └─────────────────────────┘
```
* **Offline Closed-Loop Fallback**: Jika koneksi WiFi rumah terputus, ESP32 **tetap menyiram otomatis** karena nilai *Threshold* (contoh: 40%) tersimpan di memori EEPROM internal ESP32.
* **Race-Condition Free**: Android client menggunakan `subscribeAndThen()` untuk menjamin 0% data telemetry hilang saat startup.

#### 4. Matriks Pesaing (Competitive Matrix)

| Parameter | Xiaomi Flower Care | Tuya Smart Plug | IoT DIY Standard | **TANAMI V2.0** |
|---|:---:|:---:|:---:|:---:|
| **Metode Penyiraman** | Manual Check | Timer Jam Statis | Sensor Resistif Murah | **Capacitive Sensor Presisi** |
| **Jangkauan Akses** | ❌ Bluetooth (<10m) | ✅ Cloud WAN | ❌ Lokal WiFi LAN | **🌐 Global WAN (Cloud MQTT)** |
| **Ketahanan Sensor** | ❌ Karatan | ❌ Tanpa Sensor | ❌ Korosi Elektroda | **✅ Capacitive Anti-Corrosion** |
| **Diagnosa AI Daun** | ❌ Tidak Ada | ❌ Tidak Ada | ❌ Tidak Ada | **🤖 Multimodal AI (TanamCare)** |
| **Offline Fail-Safe** | ❌ Tidak Ada | ⚠️ Tergantung Cloud | ❌ Error jika disconnect | **⚡ Edge Processing EEPROM** |
| **Harga Unit** | Rp 250.000 | Rp 200.000 | Rp 350.000 | **💎 Rp 549.000 (Full Set + AI)** |

#### 5. Financial Breakdown & Pricing Strategy (Dokumen Resmi Rincian Biaya)
* **Biaya Prototipe (BOM Prototype)**: **Rp 242.000** / unit.
* **Biaya Produksi Komersial (HPP Production)**:
  * Subtotal Komponen Komersial (ESP32, Sensor Kapasitif Stainless, DHT22, PCB Custom, Step-Down LM2596, Adaptor 12V 1A, Box IP54, Selang/Fitting): **Rp 319.000**.
  * Perakitan, Soldering & Quality Control (QC): **Rp 50.000**.
  * Total HPP Unit Siap Jual + Overhead Kemasan: **Rp 389.000** / unit.
* **Harga Jual Ritel (MSRP)**: **Rp 549.000** / unit.
* **Margin Kotor**: **~29% (Rp 160.000 / unit)** $\rightarrow$ Diakumulasikan untuk pemeliharaan server Cloud MQTT, kuota API Gemini AI, dan biaya pemasaran.
* **Target Sales (SOM Tahun ke-1)**: **15.000 Unit** adopsi awal di kota-kota besar.

---

### 🌟 I — IMPACT (DAMPAK NYATA & VISIONARY CLOSING)
* **Tujuan**: Menutup presentasi dengan bukti dampak positif bagi masyarakat, lingkungan, dan pesan penutup yang membekas di hati juri.
* **Durasi**: 1 Menit.

> 🎤 **Naskah Verbal Pitcher:**  
> *"Bapak/Ibu Juri yang terhormat... Dampak dari TANAMI V2.0 bukan sekadar angka di atas kertas, melainkan manfaat nyata bagi bumi dan masyarakat:*  
>  
> 1. 💧 **Efisiensi Air hingga 40%**: Mengeliminasi pemborosan air akibat penyiraman berlebihan (*sensor-driven closed-loop*).  
> 2. 🥦 **Ketahanan Pangan Perkotaan (Food Security)**: Meningkatkan rasio keberhasilan panen urban farming hingga **85%**, memungkinkan setiap rumah tangga memanen sayuran segar mandiri.  
> 3. 🌿 **Edukasi Generasi Muda**: Memudahkan anak muda bercocok tanam tanpa rasa takut gagal dengan bantuan Dokter AI TanamCare.  
>  
> *Masa depan pertanian tidak lagi diukur dari seberapa luas lahan yang kita miliki, melainkan seberapa cerdas kita mengelola setiap tetes air dan setiap lembar daun.*  
>  
> *Mari wujudkan Smart Urban Farming Indonesia bersama **TANAMI**:*  
> **Menanam Tumbuhan, Menyiram Harapan, Menumbuhkan Masa Depan.**  
> *Terima kasih!"*

---

---

# 🛡️ BENTENG PERTAHANAN Q&A (AIRTIGHT DEFENSE MATRIX)

Gunakan jawaban presisi dari proposal ini saat sesi tanya jawab dengan juri:

1. **Juri Cyber Security & Network (Keamanan Broker Public EMQX)**:  
   *"Sistem kami menggunakan Client ID UUID Random unik, Topic Namespace Isolation per Device ID, dan di backend Laravel kami memverifikasi kepemilikan Device ID. Untuk skala komersial, kami bermigrasi ke Private EMQX Broker berenkripsi TLS/SSL (Port 8883)."*

2. **Juri Hardware & Sensor (Masalah Korosi & Drift Sensor)**:  
   *"Kami menggunakan Capacitive Soil Moisture Sensor v1.2. Sensor kapasitif bekerja mengukur konstanta dielektrik tanah tanpa kontak logam terbuka dengan air, sehingga 100% bebas dari korosi elektrolisis. Firmware ESP32 kami juga menerapkan Software Auto-Calibration (range analog ADC 600–2900)."*

3. **Juri Internet Offline (WiFi Rumah Mati)**:  
   *"Sistem menerapkan Edge Autonomous Fail-Safe. Ambang batas kelembaban tersimpan di memori EEPROM ESP32. Jika WiFi terputus, ESP32 tetap menyiram secara otomatis secara offline. Ketika WiFi kembali menyala, data log akan disinkronkan ke cloud."*

4. **Juri AI & Machine Learning (Halusinasi AI)**:  
   *"Kami mengunci Gemini AI dengan Prompt Boundary System & JSON Output Structuring yang membatasi diagnosa hanya pada foto daun tanaman dan menyertakan Confidence Score. Langkah penanganan dibatasi pada metode organik aman (pemangkasan, larutan sabun organik/neem oil) yang 100% tidak merusak tanaman."*

5. **Juri Financial & Monetisasi (Struktur HPP & Harga Jual)**:  
   *"HPP produksi komersial kami adalah Rp 389.000 (termasuk PCB custom, casing IP54 waterproof, adaptor 12V, dan QC). Kami menjual seharga Rp 549.000 dengan margin kotor ~29% (Rp 160.000/unit) untuk menjamin keberlanjutan pemeliharaan Cloud Broker dan API Gemini AI."*
