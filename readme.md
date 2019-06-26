## 目前运行环境
- Nginx 1.8+
- PHP 5.6+
- MySQL 5.5+

## 基础安装

**1.克隆源代码到本地：** <br/>

```git clone https://github.com/ChinaLeng/practice_laravel.git``` <br/>

**2.安装扩展包依赖：** <br/>

```composer install``` <br/>

**3.生成配置文件：** <br/>


```cp .env.example .env``` <br/>

**然后配置.env里面的数据库和邮箱：** <br/>

```
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1 
DB_PORT=3306 
DB_DATABASE=homestead 
DB_USERNAME=homestead 
DB_PASSWORD=homestead 
MAIL_DRIVER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
**4.执行数据库迁移** <br/>

```php artisan migrate``` <br/>


## 最终效果
