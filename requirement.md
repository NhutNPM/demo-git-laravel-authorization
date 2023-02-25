1. Danh sách module:
- Quản lý người dùng                    
- Quản lý nhóm người dùng
- Quản lý bài viết

2. Phân quyền
- Tạo 1 nhóm người dùng => Phân quyền cho nhóm
- Thêm user cho nhóm => user đó sẽ có quyền trong nhóm đó

- Các quyền CURD: (Ràng buộc về dữ liệu & Quyền hạn)

01: POST - Module bài viết
+ Xem danh sách bài viết: Bài viết của ai thì hiển thị của người đó
+ Thêm bài viết
+ Sửa bài viết: Bài viết của ai thì sửa của người đó
+ Xóa bài viết: Bài viết của ai thì xóa của người đó

02: GROUP - Module nhóm người dùng
+ Xem danh sách nhóm
+ Thêm nhóm
+ Sửa nhóm 
+ Xóa nhóm
-- Cho phép xóa khi nhóm quyền không có ai sử dụng
+ Phân quyền

03: USER - Module người dùng
+ Xem người dùng
-- user_id bằng 0 là user có quyền ai cao nhất
-- Nếu user_id bằng 0 thì hiển thị tất cả user
-- Nếu user_id khác 0 thì chỉ hiển thị user do user đó thêm
+ Thêm người dùng
+ Sửa người dùng
+ Xóa người dùng
-- Cho phép xóa khi thành viên không phải là tài khoản đang đăng nhập
-- Cho phép xóa khi thành viên không là khóa ngoại của bảng khác

============================================================================

- Administator
- Manager
- Sales
- Staff

(1) chillies.nhut.16800@gmail.com (Admin) <Quyền cao nhất>
    admin!@#

(2) kimhang@gmail.com (Manager)
    admin!@#

(3) longphuoc@gmail.com (Sales)
    admin!@#

(4) minhphat@gmail.com (Staff)
    admin!@#

============================================================================

- Lưu thông tin người tạo ra user
- Lưu thông tin người tạo ra bài viết
- Lưu thông tin người tạo ra nhóm quyền user

- Nếu user không quyền truy cập module hoặc action đó thì
+ URL: Ngặn chặn truy cập từ url (GET & POST)
+ Giao diện: Ẩn button 


- Nếu phân quyền là Thêm/Sửa/Xóa/Phân quyền (quyền thay đổi dữ liệu)
==> Thì chắc chắn phải kèm theo quyền Xem

============================================================================

1. Thiết lập Gate: Cho phép truy cập vào Controller

2. Thiết lập Policy: Ứng với mỗi Model

============================================================================

- Nội dung được áp dụng:
+ Laravel 8.x
+ Ghép theme ( SB Admin 2 )
+ Seeder fake data ( tạo dữ liệu demo )
+ Đăng nhập, đăng xuất ( Auth )
+ Thêm, Sửa, Xóa, Hiển thị ( Eloquent ORM ) < đã check ràng buộc dữ liệu >
+ Validate form
+ Helper
+ Phân quyền ( Gate & Policy )

============================================================================

Trong quá trình phát triển
Em cố gắng phân tích chi tiết nhất có thể

============================================================================

- Quyền thay đổi dữ liệu ==> Check Xem
- Blocks: Sidebar
- Url: admin/login
- Cho phép xóa khi thành viên không là khóa ngoại của bảng khác
