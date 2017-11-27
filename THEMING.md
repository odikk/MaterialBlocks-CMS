BeardBlock - Theming Guide
=================

## Contents:

### 1. Introduction
#### 1.1 Pages, Blocks and Functions
### 2. Color Schema
### 3. Font-Face
### 4. Block-Design
### 5. Conclusion


## 1. Introduction

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
To apply or change the current Theme go to Dashboard > Settings > Design > Theme (Enter theme's name)

To preview the chosen Theme simply enter ThemePreviewer.php after your Installation-URL. A extended Theme-
Preview should popup!

### 1.1 Pages, Blocks and Functions

### Pages
#### 404-Page

Usage:
```php
BBError();
```

##### Explanation:
Automatically shows up if the entered page(?site=id&page=id) is not available.


#### Blog-Page

Usage:
```php
BBBlog();
```

##### Explanation:
Shows up if URL is like ?site=id&page=blog and represents the Blog.


#### Login-Page

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


#### Register-Page

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


#### Contact-Page

Usage:
```php
BBContact();
```

##### Explanation:
Shows up if URL is like ?site=id&page=contact. Action is based on the Theme.

##### Important:
The Theme must handle the contact form itself due to, to many possibilities.


### Blocks

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
    $params=[0=>img count,1=>text count,2=>headings count,3=>link count];
    return $params;
}
?>
```

#### CallToAction

Availiable Block Slots: 1-24

Block Base Name: CallToAction

include: calltoaction.php

##### Explanation:
Big Jumbotron like Blocks.


#### Content

Availiable Block Slots: 1-33

Block Base Name: Content

include: content.php

##### Explanation:
Blocks which mainly contain text and/or sometimes images.


#### Feature

Availiable Block Slots: 1-32

Block Base Name: Feature

include: feature.php

##### Explanation:
Blocks which explain certain Features or Functions.


#### Pricing

Availiable Block Slots: 1-10

Block Base Name: Pricing

include: pricing.php

##### Explanation:
Blocks which represent the difference between certain prizes or shows products.


#### Team

Availiable Block Slots: 1-8

Block Base Name: Team

include: team.php

##### Explanation:
Blocks which show Team Members and e.g. their role.


#### Testimonial

Availiable Block Slots: 1-10

Block Base Name: Testimonial

include: testimonial.php

##### Explanation:
Blocks which show user expierence or company expierence.


### Functions

#### Header

The header function must be placed in the header.php and has to be defined like this:
```php
function BBHeader($iID,$bShow=true) {...}
```
Also the header function is always called at first.

To implement Menu-Item Support you need to add the following code:
```php
$counter=0;
while($aElem=HTMLGetMenuElement($iID,$counter)) {
    //based on the css you use
    echo "<li class=\"nav-item\">";
    echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
    echo "</li>";
    $counter++;
}
```

To implement Support-Item Support you need to add the following code:
```php
$counter=0;
while($aElem=HTMLGetSocialElement($iID,$counter)) {
    //based on the css you use
    echo "<li class=\"nav-item\">";
    echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
    echo "</li>";
    $counter++;
}
```


#### Footer

The footer function must be placed in the footer.php and has to be defined like this:
```php
function BBFooter($iID,$bShow=true) {...}
```
Also the footer function is always called at last.

To implement Menu-Item Support you need to add the following code:
```php
$counter=0;
while($aElem=HTMLGetMenuElement($iID,$counter)) {
    //based on the css you use
    echo "<li class=\"nav-item\">";
    echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
    echo "</li>";
    $counter++;
}
```

To implement Support-Item Support you need to add the following code:
```php
$counter=0;
while($aElem=HTMLGetSocialElement($iID,$counter)) {
    //based on the css you use
    echo "<li class=\"nav-item\">";
    echo "<a class=\"nav-link\" href=\"".$aElem[1]."\">".$aElem[0]."</a>";
    echo "</li>";
    $counter++;
}
```


#### Page

The page function is called if the URL pageid does exist. Also the page function will
be called between header and footer.

To implement a generic page function simply copy the following code:
```php
include_once "calltoaction.php";
include_once "content.php";
include_once "feature.php";
include_once "pricing.php";
include_once "team.php";
include_once "testimonial.php";

function BBPage($iPageID) {
	$row=SQLGetPageRow($iPageID);
	if($row["type"]==0) {
		if($row["blockids"]!="") {
			$blockids=explode("|",$row["blockids"]);
			for($i=0;$i<count($blockids);$i++) {
				$block=SQLGetBlockRow($blockids[$i]);
				call_user_func($block["type"],$block["imgs"],$block["texts"],$block["headings"],$block["links"]);
			}
		} else {
            include_once "404.php";
            BBError();
		}
	} else {
		include_once "custom.php";
		BBCustom($row["custom_php"]);			
	}
}
```  

## 2. Color Schema

The most easy way to create a impressive Theme is to simply take the default.css from default's theme-folder
and change the following values in the root header:
```css
--control-color: #rgb;
--btn-hover-color: #rgb;
--btn-black-hover-color: #rgb;
--btn-white-hover-color: #rgb;
--font-color: #rgb;
--font-light-color: #rgb;
--white: #rgb;
--black: #rgb;
--heart-color: #rgb;
--dark-color: #rgb;
--grey-color: #rgb;
--link-color: #rgb;
--link-dark-color: #rgb;
--header-border: #rgb;
--bg-color: #rgb;
```

If you are a more advanced user you can even build your own css file completly unrelated to bootstrap.


## 3. Font-Face

The following simple steps are explaining how to change the Main-Font of your Theme and it's size.
This only applies to default.css based themes!

### Main-Font

Before you are able to change the used Font in your theme you need to change the Font-URL.
To do this go to Dashboard > Settings > Design > FontURL and enter the URL of your font.

To change the main font of the Theme you have to change the following line in the root header of your css:
```css
--font: 'FontName'
```
The used font has to be the same as the FontURL else sans-serif will be used.

After changing this line the font will be applied.


### Font-Sizes

To change the Font size simply edit these values based on your needs:
```css
--font-size: 25px;
--font-size-h1: 2.75rem;
--font-size-h2: 2.00rem;
--font-size-h3: 1.125rem;
--font-size-h4: 1.00rem;
--font-size-h5: 0.90rem;
--font-size-h6: 0.75rem;
```


## 4. Block Design

As we know from 1.Introduction/Blocks each Block type has a different amount of
Slots. Each Slot either returns false or returns an array filled with the count
of the content type(Images,Texts,Headings,Links).

Now let's begin with our own Block from scratch!

First of all we have to decide which type of Block we want to create. In my case
a Team Block will do.

So Team Block states that it need 1-8 Slots so let's make them:

```php
function Team1($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
function Team2($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
function Team3($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
function Team4($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
function Team5($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
function Team6($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
function Team7($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
function Team8($imgs,$texts,$headings,$links,$bShow=true) {
    return false;
}
```

Now we got 8 different Team Blocks but they are all empty and if
we would load our theme into BeardBlock it wouldn't even show us
one of our Blocks!

But how can we change this?

Simple. We have to put some code into the first Slot and return an array
instead of false like this:

```php
function Team1($imgs,$texts,$headings,$links,$bShow=true) {
    if($bShow) {
        $imgs=explode("|",$imgs);
        $texts=explode("|",$texts);
        $headings=explode("|",$headings);
        $links=explode("|",$links);
    ?>
    <section class="fdb-block team-2">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-8">
                    <?php echo "<h1>".$headings[0]."</h1>"; ?>
                </div>
            </div>
            <div class="row-50"></div>
            <div class="row text-center justify-content-center">
                <div class="col-sm-3 m-sm-auto">
                    <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[0]."\">";
                    echo "<h2>".$headings[1]."</h2>";
                    echo "<p>".$texts[0]."</p>"; ?>
                </div>
                <div class="col-sm-3 m-sm-auto">
                    <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[1]."\">";
                    echo "<h2>".$headings[2]."</h2>";
                    echo "<p>".$texts[1]."</p>"; ?>
                </div>
                <div class="col-sm-3 m-sm-auto">
                    <?php echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$imgs[2]."\">";
                    echo "<h2>".$headings[3]."</h2>";
                    echo "<p>".$texts[2]."</p>"; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
    /*
        Just calculate the last index +1

        Like $texts[2] is the last index = 3 different texts
                     |
                    \/ 
    */
    $params=[0=>3,1=>3,2=>4,3=>0];
    return $params;
}
```

Now BeardBlock will show us our Block and we can easily use it!


## 5. Conclusion

With BeardBlock everything is possible but yet easy to handle for more advanced
User. Also BeardBlocks Theming system opens up millions of different possibilities
while being easy and understandable. Additionally BeardBlock Themes can be but don't have
to be related to bootstrapor any other framework. Just keep in mind that atm their is
no button where you are able to deactivate Bootstrap.

## Try it yourself!
