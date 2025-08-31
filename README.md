### วิธีติดตั้ง
1. เปิด `cmd` หรือ `terminal` เพื่อ clone project
   ```git clone https://github.com/nirusduddin/borrow-app.git```
2. เมื่อ clone เสร็จแล้วให้เข้าไป folder project คลิกขวา เลือก Git Bash Here
3. รันคำสั่ง ```composer update```
4. ให้สร้างฐานข้อมูลชื่อ borrow_db ผ่าน phpMyAdmin หรือ อื่นๆ ที่สามารถสร้างฐานข้อมูลได้
5. รันคำสั่ง ```copy .env.example .env``` ***Windows หรือ ```cp .env.example .env```
6. รันคำสั่ง ```php artisan migrate``` เพื่อสร้างตารางข้อมูล หรือ ```php artisan migrate:refresh``` สำหรับคนที่ใช้ฐานข้อมูลเดิม
7. รันคำสั่ง ```php artisan db:seed``` เพื่อสร้างตัวอย่างข้อมูล
8. รันคำสั่ง ```php artisan storage:link``` เพื่อสร้าง symlink
9. รันคำสั่ง ```php artisan serve```
10. เรียก http://localhost:8000

### Admin
Username: `admin@example.com`
Password: `admin`

### User (Viewer)
Username: `user@example.com`
Password: `user`