# Project3_Magento
E_Comnerce_Website
1. Yêu cầu hệ thống:
- Hệ điều hành linux.
- Có cài magento 2.1.9 ( link hướng dẫn cài: https://tecadmin.net/install-
magento2-using-composer-ubuntu-16-04/# )
2. Hướng dẫn cài đặt:
- Drop database cũ của magento đã cài đặt, tạo lại 1 database mới cùng tên
và nhập file sql trong zip.
- Cho folder icon vào trong <thư mục gốc của magento
>/pub/media/catalog/product.
- Vào folder design/frontend lấy folder Hiddentechies đưa vào trong folder
<thư mục gốc của magento>/app/code/design/frontend
- Đưa các folder Project3, SR và Hiddentechies vào trong folder <thư mục
gốc của magento>/app/code
- Thêm thư mục wysiwyg trong pub/media vào đúng đường dẫn đấy trong
forder chứa magento
- Chuyển đến folder gốc của magento và chạy các câu lệnh:
o Sudo bin/magento setup:upgrade
o Sudo chmod -R 777 .
