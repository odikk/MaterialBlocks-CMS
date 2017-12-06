# Hitchhiker's guide to MaterialBlocks-CMS

# Contents:
1. [Installation](#installation)
2. [Login](#login)
3. [Dashboard](#dashboard)
4. [Static Sites](#static-sites)
5. [Support](#support)

# Installation
The following short paragraph will get you a working installation of MaterialBlocks.

1. Download the newest stable-release of MaterialBlocks([Download](https://github.com/EasyDevCpp/MaterialBlocks-CMS/releases))
2. Extract the archive on a local device.
3. Open navigate into the bb-include folder and edit the bb-config.php file like this:
```php
define("BB_DB_LOCATION","localhost"); //Enter database location here
define("BB_DB_NAME","bblock"); //Enter database name here(or leave the same[recommended])
define("BB_DB_USER","root"); //Enter database user here
define("BB_DB_PW","1234"); //Enter database password here
```
4. Upload the complete MaterialBlocks-Folder onto your server or local machine.
5. Navigate to the installation-URL, the installation should popup.
**If the installation doesn't popup simple type in install.php**
6. Follow the instructon on the screen.
7. Delete the install.php from the server.
8. Enjoy!

After the installation you will end up on a nearly blank page which says: "Nothing to Show :(". This simply means the installation 
worked!

If this page doesn't open or open correctly please then please open an Issue on Github.

# Login
To log yourself into the MaterialBlocks dashboard simply type in: **?site=dashboard**. Now you will be promted to login. Simply enter your data and hit [ENTER] to continue.

After you are logged in you are promted to choose a site which is because one MaterialBlocks Installation could have various sites to for example use different themes or even enable multi-language support!

# Dashboard
The dashboard contains 9 different options, each of this option fullfills a different function. In the following I will explain each of them.

## Add Page
Used to add a new Page to your Site. You are able to directly add this Page to your SiteMenu by checking the box. After you clicked on Add Page you will be directly redirected to the Page Editor.

## View Pages
Shows you all avialable Pages you have added lately to your site. Also you can delete each page or edit it directly from here. Simply
click on the minus button or the pencil button.

## Add Custom(Recommended for advanced users only)
Each Theme **must** contain a custom.php which is used to load custom pages. To add such a Page simply click on Add Custom and give the page a title. Also you need to enter a string which will be very important. Normally you like to choose the same as in the title. After that the pages is added but if we call it, we won't see anything! This is because we have to change the custom.php like this:
```php
/*
    Let's say our Custom String is Trap
*/
function BBCustom($CustomParam) {
    if($CustomParam=="Trap") {
		echo "<section class=\"fdb-block\">";
		echo "<div class=\"container\">";
		echo "<div class=\"row align-items-center\">";
		echo "<h1>It's a Trap!</h1>";
		echo "</div>";
		echo "</div>";
		echo "</section>";
    }
}
```
If we reload the page now we will see the text It's a Trap! or something else. You can even call Function from this point but keep in mind that functions from different sources can be dangerous.

## Add Post
Adds a new post to the Blog which is always located at **?site=id&page=blog** (More Info at [Static Sites](#static-sites)).
You can edit all of your post later under View Posts by clicking on edit.

## View Posts
Shows a list of all your added Posts ordered by Date. From here you can also edit or delete each post.
**WARNING: Deletion or Edit can't be undone after saving!**

## View Users
Shows a list of all registered Users and their role. User-Role can be: Administrator, Editor or Normal User. Only administrator is able to fully access the dashboard while Editor is only able to Edit or View Posts and Pages(Not implemented yet). Users are not allowed to access the Dashboard. After registration, which is located under **?site=id&page=register**, Users are normally assigned to the Normal User role.

## Edit Elememts
The first two paragraphs are dynamicly created and are used to edit the Header & Footer block. Underneath this area you can edit your menu entries or your social media entries. The effect of those values are depending on your Theme.

## Settings
The settings area is used to change the active Theme or the used Font-URL(See [THEMING.md](THEMING.md)). Also you are able to change the Site's Title, the Site's Description, the Site's Keywords or activate the Offline Ressources, which will help you to create a faster loading page but can also lead to certain incompatibility.

## Log Out
Destroys your user session and redirects you to the login.


# Static Sites

You want to create your own Theme? Than read the [THEMING.md](THEMING.md)

| Static Sites               | Description       |
| -------------------------- | ----------------: |
| **?site=id&page=blog**     | Blog page         |
| **?site=id&page=contact**  | Contact page      |
| **?site=id&page=login**    | Login page        |
| **?site=id&page=register** | Registration page |
| **?site=dashbaord**        | Dashboard         |


# Support

Any further problems/questions? Than contact me per mail or open an issue.

Want to contribute? Than read the [CONTRIBUTING.md](CONTRIBUTING.md) file.

## Enjoy!