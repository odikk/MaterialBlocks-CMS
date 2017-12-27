# MaterialBlocks

A Froala design-blocks based CMS with Theming functionality and Blog integration. [Support](mailto: easy-dev@web.de)

## Getting Started

These instructions will get you a copy of the project up and running on your server or local machine as a CMS. See installation for detailed instructions on how to install MaterialBlocks.

### Prerequisites

Before you could start you need to install the following items on your webserver:

```markdown
* php>=5.*
* MySQL
```

### Installing

Follow this simple instructions to install MaterialBlocks on your webserver.

```text
1. Clone the latest version of MaterialBlocks and extract it.
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

```text
4. Open your browser and direct to your server-url
5. The installer should popup. Follow the instructions on screen.
```

## How to Use

A more detailed Guide available at [GUIDE.md](GUIDE.md)!

### 1. Add a Page & Edit it

1.Login at ?site=dashboard

2.Add a Page & Edit it!

### 2. Change the used Theme

1.Install a new Theme or create your own(->see [THEMING](THEMING.md))

2.Change the used Theme

## Built With

* [PHP](http://www.php.net)
* [Frola Design Blocks](https://github.com/froala/design-blocks)
* [Bootstrap](https://getbootstrap.com/)
* [jQuery](https://jquery.com/)
* [Popper.js](https://popper.js.org/)
* [Font-Awesome](http://fontawesome.io/)

## Contributing

Please read CONTRIBUTING.md for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/EasyDevCpp/MaterialBlocks-CMS/tags).

## Authors

* **Robin Krause** - *Initial work* - [EasyDevCpp](https://github.com/EasyDevCpp/)

See also the list of [contributors](https://github.com/EasyDevCpp/MaterialBlocks-CMS/contributors) who participated in this project.

## License

This project is licensed under the GNU General Public License - see the [LICENSE](LICENSE) file for details

## Acknowledgments

* Frola Design Blocks
* Inspired by WordPress
