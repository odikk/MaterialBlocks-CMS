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
Shows up if URL is like ?site=id&page=blog and represents the Blog.


##### Login-Page

Usage:
```php
BBLogin();
```

##### Explanation:
Shows up if URL is like ?site=id&page=login and logs the user in.

##### Important:
Submit URL must look like: ?site=id&page=login&submit=true
POST must contain: 
* $_POST["email"]
* $_POST["password"]


##### Register-Page

Usage:
```php
BBRegister();
```

##### Explanation:
Shows up if URL is like ?site=id&page=register and registers a new user.

##### Important:
Submit URL must look like: ?site=id&page=register&submit=true
POST must contain:
* $_POST["username"]
* $_POST["email"]
* $_POST["password"]
* $_POST["confirm_password"]


##### Contact-Page

Usage:
```php
BBContact();
```

##### Explanation:
Shows up if URL is like ?site=id&page=contact. Action is based on the Theme.

##### Important:
The Theme must handle the contact form itself due to, to many possibilities.


#### Blocks

Each Blocktype consists of various Slots. These slots can be empty(return false;).
If a Slot isn't empty, then you have to return an array like this:
```php
$params[0=>img count,1=>text count,2=>heading count,3=>link count];
return $params;
```
Also *every* Slot function needs 5 Parameters and needs to handle them like this:
```php
function BlockSlot1($imgs,$texts,$headings,$links,$bShow=true) {
    $imgs=explode("|",$imgs);
    $texts=explode("|",$texts);
    $headings=explode("|",$headings);
    $links=explode("|",$links);
    if($bShow) {
    ?>
        //Html source
    <?php
    }
}
?>
```

##### CallToAction

Availiable Block Slots: 1-24

Block Base Name: CallToActionSlot

##### Explanation:
Big Jumbotron like Blocks.