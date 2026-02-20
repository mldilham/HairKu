# TODO - CRUD Services & Review & Rating

## Completed ✅

### Barber Services CRUD:

- [x] Tambah layanan - ServiceController + create.blade.php
- [x] Edit layanan - ServiceController + edit.blade.php
- [x] Hapus layanan - ServiceController::destroy()
- [x] List layanan miliknya saja - ServiceController::index() dengan filter barber_id
- [x] Validasi harga & durasi - Validasi di store() dan update()

### Booking System:

- [x] Barber: Booking management (accept, reject, onTheWay, complete)
- [x] User: Create booking, cancel booking, view bookings
- [x] Fix route method (PATCH instead of POST)

### Review & Rating:

- [x] User hanya bisa review jika status completed
- [x] Simpan rating (1-5) dengan comment opsional
- [x] Hitung rata-rata rating barber (getAverageRating)
- [x] Hitung total review (getReviewCount)
- [x] Tampilkan rating di detail barber (barbers/show.blade.php)
- [x] Tampilkan rating di daftar barber (barbers/index.blade.php)
- [x] Form review dengan star rating (user/reviews/create.blade.php)

## Files Created:

- app/Http/Controllers/User/ReviewController.php
- app/Http/Controllers/User/BarberController.php
- resources/views/user/reviews/create.blade.php
- resources/views/barbers/index.blade.php (updated)
- resources/views/barbers/show.blade.php (updated)

## Files Modified:

- app/Models/Barber.php - added getAverageRating() and getReviewCount()
- routes/web.php - added review routes
- resources/views/user/bookings/index.blade.php - added review button
- resources/views/barber/bookings/index.blade.php - fixed PATCH method
