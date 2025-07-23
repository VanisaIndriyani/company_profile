# Checkout System Features

## Overview
Sistem checkout yang telah diperbarui dengan fitur pembedaan alur checkout berdasarkan kategori produk (Kopi vs Vape).

## Fitur Utama

### 1. Pembedaan Alur Checkout Berdasarkan Kategori

#### **Produk Kopi (Coffee)**
- ✅ **Wajib mengisi nomor meja** - Untuk pengiriman ke meja pelanggan
- ✅ **Pilihan pembayaran**: Cash atau QRIS
- ✅ **Pesan sukses**: "Pesanan kopi berhasil! Silakan tunggu di meja [nomor]"

#### **Produk Vape**
- ✅ **Tidak perlu nomor meja** - Langsung ke pembayaran
- ✅ **Pilihan pembayaran**: Cash atau QRIS  
- ✅ **Pesan sukses**: "Pesanan vape berhasil! Silakan ambil di counter"

#### **Pesanan Campuran (Kopi + Vape)**
- ✅ **Nomor meja wajib diisi** (untuk produk kopi)
- ✅ **Pilihan pembayaran**: Cash atau QRIS
- ✅ **Pesan sukses**: Mengikuti alur kopi

### 2. Tampilan yang Ditingkatkan

#### **Halaman Checkout**
- 📱 **Responsive design** dengan layout 2 kolom
- 🎨 **Visual indicators** untuk kategori produk (badge dengan icon)
- 📊 **Detail pesanan** yang lengkap dengan gambar produk
- 💳 **Form pembayaran** yang user-friendly
- ℹ️ **Informasi kontekstual** berdasarkan jenis pesanan

#### **Keranjang Belanja**
- 🛒 **Tabel keranjang** yang informatif dengan gambar produk
- 🏷️ **Badge kategori** dengan warna dan icon yang berbeda
- 📝 **Peringatan jenis pesanan** (Kopi/Vape/Campuran)
- 🗑️ **Tombol hapus item** untuk setiap produk

### 3. Validasi dan Keamanan

#### **Validasi Input**
- ✅ **Nomor meja wajib** untuk pesanan kopi
- ✅ **Metode pembayaran wajib** dipilih
- ✅ **Validasi stok** sebelum checkout
- ✅ **Nama pelanggan wajib** diisi

#### **Penanganan Error**
- ⚠️ **Pesan error yang jelas** untuk setiap validasi
- 🔄 **Redirect yang tepat** saat terjadi error
- 📱 **Responsive error messages**

### 4. Alur Penggunaan

#### **Untuk Pelanggan Kopi:**
1. Pilih produk kopi dari katalog
2. Tambahkan ke keranjang
3. Klik "Lanjut ke Checkout"
4. Isi nama dan nomor meja
5. Pilih metode pembayaran (Cash/QRIS)
6. Klik "Proses Pesanan"
7. Tunggu konfirmasi dan pesanan diantar ke meja

#### **Untuk Pelanggan Vape:**
1. Pilih produk vape dari katalog
2. Tambahkan ke keranjang
3. Klik "Lanjut ke Checkout"
4. Isi nama (nomor meja otomatis "N/A")
5. Pilih metode pembayaran (Cash/QRIS)
6. Klik "Proses Pesanan"
7. Ambil pesanan di counter

## File yang Dimodifikasi

### Backend (PHP/Laravel)
- `app/Http/Controllers/OrderController.php` - Logika checkout dan validasi
- `database/seeders/CatalogSeeder.php` - Data produk contoh

### Frontend (Blade Templates)
- `resources/views/user/checkout.blade.php` - Halaman checkout utama
- `resources/views/user/component/cart_table.blade.php` - Tabel keranjang

## Database Structure

### Tabel `catalogs`
```sql
- id (primary key)
- name (nama produk)
- description (deskripsi produk)
- image (gambar produk)
- price (harga)
- stock (stok)
- category (kategori: 'Coffee' atau 'Vape')
- created_at, updated_at
```

### Tabel `orders`
```sql
- id (primary key)
- nama (nama pelanggan)
- no_meja (nomor meja, "N/A" untuk vape)
- payment_method (cash/qris)
- status (pending/accepted/rejected)
- items (JSON detail keranjang)
- created_at, updated_at
```

## Testing

### Skenario Test yang Disarankan:

1. **Test Pesanan Kopi Murni**
   - Tambah produk kopi ke keranjang
   - Verifikasi field nomor meja muncul
   - Test tanpa isi nomor meja (harus error)
   - Test dengan nomor meja (harus sukses)

2. **Test Pesanan Vape Murni**
   - Tambah produk vape ke keranjang
   - Verifikasi field nomor meja tidak muncul
   - Test checkout langsung (harus sukses)

3. **Test Pesanan Campuran**
   - Tambah produk kopi + vape
   - Verifikasi field nomor meja muncul
   - Test validasi nomor meja

4. **Test Pembayaran QRIS**
   - Pilih metode QRIS
   - Verifikasi gambar QRIS muncul

## Catatan Penting

- Sistem menggunakan kategori string sederhana ('Coffee', 'Vape')
- Validasi case-insensitive untuk kategori
- Stok dikurangi saat checkout, bukan saat add to cart
- Session cart menyimpan informasi kategori produk
- Responsive design untuk mobile dan desktop 