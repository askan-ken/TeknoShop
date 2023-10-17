Cara menggunakan 
1. clone repositori
2. buka terminal di dalam folder yang sudah di clone
3. ketikkan "coposer update" lalu tunggu sampai selesai
4. setelah selesai buka .env di dalam folder TeknoShop
5. ubah DB_DATABASE = laravel menjadi DB_DATABASE = TeknoShop
6. buka aplikasi xampp dan nyalakan Apache dan MySql
7. buka terminal lagi dan ketikkan php artisan migrate
8. jika muncul " The database 'TeknoShop' does not exist on the 'mysql' connection. Would you like to create it? (yes/no)" ketikkan saja yes
9. setelah itu tunggu hingga selesai
10. setelah selesai program sudah bisa di jalankan dengan mengetikkan perintah "php artisan serve" di terminal
