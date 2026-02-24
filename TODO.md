# TODO - Validasi & Keamanan Booking

## Checklist - COMPLETED ✅

- [x]   1. User tidak bisa booking dirinya sendiri
- [x]   2. Barber tidak bisa booking
- [x]   3. Barber hanya bisa lihat booking miliknya (sudah diimplementasikan sebelumnya)
- [x]   4. User hanya bisa lihat booking miliknya (sudah diimplementasikan sebelumnya)
- [x]   5. Prevent double booking di jam yang sama

## File yang Diedit

- `app/Http/Controllers/User/BookingController.php`

## Detail Implementasi

### 1. User tidak bisa booking dirinya sendiri

- Ditambahkan validasi di method `store()` untuk memeriksa `barber->user_id === auth()->id()`
- Jika user mencoba booking dirinya sendiri, akan muncul error: "Anda tidak bisa booking jasa barber sendiri!"

### 2. Barber tidak bisa booking

- Ditambahkan constructor dengan pengecekan `auth()->user()->isBarber()`
- Jika barber mencoba mengakses route booking, akan muncul error 403: "Barber cannot make bookings. Please use the barber dashboard."

### 3. Barber hanya bisa lihat booking miliknya

- Sudah diimplementasikan di `Barber/BookingController.php::index()` - difilter oleh `barber_id`

### 4. User hanya bisa lihat booking miliknya

- Sudah diimplementasikan di `User/BookingController.php::index()` - difilter oleh `user_id`

### 5. Prevent double booking di jam yang sama

- Ditambahkan pengecekan di method `store()` untuk memeriksa booking yang sudah ada
- Pengecekan: barber_id, booking_date, booking_time, dan status != 'cancelled'
- Jika sudah ada booking, akan muncul error: "Maaf, jam tersebut sudah dibooking oleh customer lain. Silakan pilih jam lain."

## Status: COMPLETED ✅
