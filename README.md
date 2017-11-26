BeardBlock
=================

Froala design-blocks based CMS (PHP7 and up). [Support](mailto: easy-dev@web.de)

![demo](https://i.imgur.com/m6SNlRm.gif)

![demo2](https://i.imgur.com/EbRB0En.gif)

## Getting Started

These instructions will get you a copy of the project up and running on your server or local machine as a CMS. See installation for detailed instructions on how to install BeardBlock.

### Prerequisites

Before you could start you need to install the following items on your webserver:

```
* php>=7.0
* MySQL
```

### Installing

Follow this simple instructions to install BeardBlock on your webserver.

```
1. Clone the latest version of BeardBlock and extract it.
2. Copy the containing files and folders into your configured web-path
    * On Linux it should be /var/www/html/ in most cases
3. Navigate into ./bb-include/ and open bb-config.php and edit it:
```
```php
define("BB_DB_LOCATION","localhost"); //Enter database location here
define("BB_DB_NAME","bblock"); //Enter database name here(or leave the same[recommended])
define("BB_DB_USER","root"); //Enter database user here
define("BB_DB_PW","1234"); //Enter database password here
```
```
4. Open your browser and direct to your server-url
5. The installer should popup. Follow the instructions on screen.
```

## How to Use

### 1. Add a Page & Edit it!

1. Login
![login](https://i.imgur.com/m6SNlRm.gif)

2. Add a Page & Edit it!
![page](https://i.imgur.com/XyOuNe7.gif)

### 2. Change the used Theme
Before:
![before](https://i.imgur.com/aQrGDx9.gif)

1. Install a new Theme or create your own(->see Theming.md)
2. Change the used Theme
![change](https://i.imgur.com/Sb5Ipnu.gif)

## Built With

* [PHP](http://www.php.net)
* [Frola Design Blocks](https://github.com/froala/design-blocks)

## Contributing

Please read CONTRIBUTING.md for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/EasyDevCpp/BeardBlock/tags). 

## Authors

* **Robin Krause** - *Initial work* - [EasyDevCpp](https://github.com/EasyDevCpp/)

See also the list of [contributors](https://github.com/EasyDevCpp/BeardBlock/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Acknowledgments

* Frola Design Blocks
* Inspired by WordPress

## Updates
* 1.0.0 first release with php7