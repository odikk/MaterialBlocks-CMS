# Hitchhiker's guide to BeardBlock

# Contents:
1. [Installation](#installation)
2. [Login](#login)
3. [Dashboard](#dashboard)
4. [Add Post](#add_post)
5. [Add Page](#add_page)
6. [Edit Page](#edit_page)
7. [Edit Elements](#edit_elements)
8. [Support](#support)

# Installation
The following short paragraph will get you a working installation of BeardBlock.

1. Download the newest stable-release of BeardBlock([Download](https://github.com/EasyDevCpp/BeardBlock/releases))
2. Extract the archive on a local device.
3. Open navigate into the bb-include folder and edit the bb-config.php file like this:
```php
define("BB_DB_LOCATION","localhost"); //Enter database location here
define("BB_DB_NAME","bblock"); //Enter database name here(or leave the same[recommended])
define("BB_DB_USER","root"); //Enter database user here
define("BB_DB_PW","1234"); //Enter database password here
```
4. Upload the complete BeardBlock-Folder onto your server or local machine.
5. Navigate to the installation-URL, the installation should popup.
**If the installation doesn't popup simple type in install.php**
6. Follow the instructon on the screen.
7. Delete the install.php from the server.
8. Enjoy!

After the installation you will end up on a nearly blank page which says: "Nothing to Show :(". This simply means the installation 
worked!

If this page doesn't open or open correctly please then please open an Issue on Github.

# Login
To log yourself into the BeardBlock dashboard simply type in: **?site=dashboard**. Now you will be promted to login. Simply enter your data and hit [ENTER] to continue.

After you are logged in you are promted to choose a site which is because one BeardBlock Installation could have various sites to for example use different themes or even enable multi-language support!

# Dashboard
The dashboard contains 9 different options, each of this option fullfills a different function. In the following I will explain each of them.

## Add Page
Used to add a new Page to your Site. You are able to directly add this Page to your SiteMenu by checking the box. After you clicked on Add Page you will be directly redirected to the Page Editor.

## View Pages

## Add Custom

## Add Post

## View Posts

## View Users

## Edit Elememts

## Settings

## Log Out