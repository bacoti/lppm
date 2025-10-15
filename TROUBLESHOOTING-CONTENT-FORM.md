# TROUBLESHOOTING GUIDE - Content Form Submit Issue

## Langkah-langkah debugging yang telah dilakukan:

### 1. File yang telah diperbaiki:
- ✅ `ContentController@store` - Ditambahkan logging dan error handling
- ✅ `create.blade.php` - Diperbaiki JavaScript dan TinyMCE initialization
- ✅ `create-simple.blade.php` - Versi sederhana tanpa TinyMCE untuk testing
- ✅ `layouts/admin.blade.php` - Ditambahkan CSRF meta token
- ✅ `routes/web.php` - Ditambahkan test routes untuk debugging

### 2. Routes yang tersedia:
- `/admin/contents/create` - Form asli dengan TinyMCE
- `/admin/contents/create-simple` - Form sederhana untuk testing
- `POST /admin/contents` - Route untuk menyimpan content
- `POST /admin/contents/test-store` - Route test untuk debugging

### 3. Debugging tools yang ditambahkan:
- Console logging di JavaScript
- Button "Test Form" untuk debugging
- Button "Debug Info" di simple form
- Laravel logging di ContentController
- Authentication status check

## Cara menggunakan debugging tools:

### A. Test Simple Form (Recommended):
1. Login ke admin panel
2. Pergi ke `/admin/contents`
3. Klik button "Simple Form (Debug)" 
4. Isi form dengan data test
5. Klik "Debug Info" untuk melihat status auth dan form data
6. Coba submit form - jika berhasil, masalah ada di TinyMCE

### B. Test Original Form:
1. Login ke admin panel
2. Pergi ke `/admin/contents/create`
3. Isi form dengan data test
4. Klik "Test Form" untuk debugging
5. Coba submit form normal

### C. Check Laravel Logs:
```bash
tail -f storage/logs/laravel.log
```

## Kemungkinan masalah dan solusi:

### 1. Session Expired / Auth Issue:
**Symptoms:** Form tidak submit, redirect ke login
**Solution:** Login ulang, check session config

### 2. CSRF Token Issue:
**Symptoms:** 419 error, token mismatch
**Solution:** Refresh page, check meta CSRF token

### 3. TinyMCE Conflict:
**Symptoms:** Form asli tidak submit, simple form berhasil
**Solution:** Gunakan simple form atau fix TinyMCE init

### 4. JavaScript Error:
**Symptoms:** Form tidak response, console error
**Solution:** Check browser console, fix JS errors

### 5. Validation Error:
**Symptoms:** Form submit tapi kembali ke form dengan error
**Solution:** Check field requirements, fix validation

### 6. Database Issue:
**Symptoms:** Internal server error
**Solution:** Check database connection, migration

## Test Commands untuk Terminal:

### Test Database Connection:
```bash
php artisan tinker --execute="
\$content = new App\Models\Content();
\$content->title = 'Test';
\$content->slug = 'test';
\$content->body = 'Test body';
echo \$content->save() ? 'DB OK' : 'DB Error';
"
```

### Check Routes:
```bash
php artisan route:list | grep content
```

### Clear Cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Langkah Selanjutnya:

1. **Test Simple Form dulu** - Jika simple form berhasil, masalah ada di TinyMCE
2. **Check Console Log** - Lihat error JavaScript di browser
3. **Check Laravel Log** - Lihat error server di storage/logs/laravel.log
4. **Test Authentication** - Pastikan user masih login
5. **Check CSRF** - Pastikan token CSRF ada dan valid

## Jika masih tidak berhasil:

1. Try clear browser cache
2. Try different browser
3. Check web server error logs
4. Check PHP error logs
5. Test dengan data minimal (title, slug, body saja)

## Contact untuk bantuan teknis:
- Check error di browser console (F12)
- Check Laravel log di storage/logs/laravel.log
- Gunakan simple form untuk isolate masalah