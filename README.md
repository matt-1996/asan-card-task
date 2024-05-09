
## Instalation

- composer i
- npm i


## Usage

### Run Below Commands
- cp .env.example .env
- php artisan migrate
- npm run build
- npm run dev
- redis-server
- php artisan reverb:start
- php artisan schedule:work
- php artisan queue:work
- php artisan queue:work --queue=NYTimes redis
- php artisan queue:work --queue=NewsApi redis

## Notes

- جهت اتصال به NYTimes اطمینان حاصل کنید که http proxy روی پورت 2080 باشد
- پروژه میتونست DRY تر باشد اما تصمیم گرفتم بیشتر روی جداسازی کلاس ها و DX تمرکز کنم
- داکر تست نشده به دلیل تحریم نتونستم ایمیج ها رو دریافت کنم با shecan DNS هم نشد
- بهتره پروژه روی سرویس Valet و بر روی پروتکل http اجرا شود تا https در صورتی که روی https اجرا شود نمیتوان از laravel Echo استفاده کرد
- چنانچه سوالی دارید توسط ایمیل ادرسی که در انتها صفحه گذاشتم باهام در تماس باشید
- in Order to use Swagger just hit {site.test}/api/documentation in browser
- Telescope Implemented
 
اگر نوشته های فارسی این فایل بهم ریخته است و نمیتوانید بخونید ایمیل بزنید متن راست چین شده را بفرستم

### Email: [matinnasirlahijani@gmail.com](mailto:matinnasirlahijani@gmail.com)
