# Laravel Todo List App

แอป Todo List ที่พัฒนาด้วย Laravel, Livewire, Bootstrap, Tailwind และ Flux UI  
รองรับการเพิ่ม ลบ แก้ไข เช็กสถานะ และคอมเมนต์ได้แบบเรียลไทม์ โดยไม่ต้องรีเฟรชหน้า  
รองรับการแนบรูปภาพในคอมเมนต์ และระบบผู้ใช้หลายคน

---

## 🔧 วิธีติดตั้ง (Installation)

1. **โคลนโปรเจกต์**

```bash
git clone https://github.com/your-username/todo-list-app.git
cd todo-list-app
```

2. **ติดตั้ง dependencies**

```bash
composer install
npm install
```

3. **สร้าง application key**

```bash
php artisan key:generate
```

4. **คัดลอกไฟล์ .env และตั้งค่า**

```bash
copy .env.example .env
```

การตั้งค่า .env
uncomment ในส่วนนี้ของ file .env

```
 DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=your_database_name
# DB_USERNAME=root
# DB_PASSWORD=
```

แล้วตั้งค่าเป็น Database ที่ใช้สำหรับ Connect (โดยเป็น Database ที่ได้สร้างไว้แล้ว)

5. **รัน migration**
   เพื่อสร้างตารางที่จำเป็นสำหรับ Todo List App ใน Database ของคุณ
   และได้ทำการสร้าง User เริ่มต้น

```bash
php artisan migrate --seed
```
6. **Link storage**
เพื่อให้ใน localhost สารามถแสดงรุปภาพได้

```bash
php artisan storage:link
```

7. **รัน Application**

```bash
composer run dev
```

เปิดเบราว์เซอร์ที่ http://127.0.0.1:8000
ในหน้า Login สามารถใช้ email และ password ของบัญชีทดสอบได้

```
email : demo@example.com
password : password
```

หากไม่ต้องการใช้บัญชีทดสอบสามารถไปยังหน้า Register ที่ปุ่ม Sign up ในหน้า Login
หรือ ปุ่ม Register ในหน้า Welcome เพื่อเพิ่มบัญชีของตนเองได้

## 🧩 คุณสมบัติ (Features)

✅ CRUD รายการ Todo

✅ ติ๊กเช็กว่าทำเสร็จหรือยัง

✅ แก้ไขเฉพาะรายการที่ตนเองสร้าง

✅ คอมเมนต์รายการ Todo ได้ (แนบรูปได้)

✅ อัปเดตแบบเรียลไทม์ (Livewire, no-refresh)

✅ รองรับผู้ใช้หลายคน

## 💡 เทคโนโลยีที่ใช้

Laravel 12

Livewire 3

Bootstrap

Flux UI

Tailwind CSS

MySQL
