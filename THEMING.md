BeardBlock - Theming Guide
=================

## Contents:

#### 1. Introduction
##### 1.1 Pages, Blocks and Functions
#### 2. Color Schema
#### 3. Font-Face
#### 4. Block-Design
#### 5. Conclusion

### 1. Introduction

BeardBlock is a Block based CMS which is able to build dynamic websites containing Blocks.
To achieve such a system BeardBlock needs a compatible Theme which contains the following
files:
```
./themes/ThemeFolder/
-------------+-- 404.php
             +-- blog.php
             +-- calltoaction.php
             +-- contact.php
             +-- content.php
             +-- custom.php
             +-- default.css
             +-- feature.php
             +-- footer.php
             +-- header.php
             +-- login.php
             +-- register.php
             +-- team.php
             \-- testimonial.php
```

#### 1.1 Pages, Blocks and Functions
#### Pages
##### 404-Page

Usage:
```php
BBError();
```

##### Explanation:
Automatically shows up if the entered page(?site=id&page=id) is not available.

##### Blog-Page

Usage:
```php
BBBlog();
```

##### Explanation:
Shows up if url is like ?site=id&page=blog and represents the Blog.

##### Login-Page

Usage:
```php
BBLogin();
```

##### Explanation:
Shows up if url is like ?site=id&page=login and logs the user in.

##### Important:
Submit url must look like: ?site=id&page=login&submit=true
POST must contain: 
* $_POST["email"]
* $_POST["password"]
