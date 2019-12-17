# SDM CLI

## Installation

> **Requires [PHP 7.2+](https://php.net/releases/)**

Require SDM CLI using [Composer](https://getcomposer.org):

```bash
$ composer global require bigstepdenmark/sdm-cli
```

## Usage

List all sdmcli commands:
```bash
$ sdmcli
```

Help:
```bash
$ sdmcli help <command> 
#or
$ sdmcli <command> --help
```

Create a new Magento module:
```bash
$ sdmcli magento:make:module
```

Install a fresh Laravel Application:
```bash
$ sdmcli laravel:new <name>
```

Install a fresh Symfony Application:
```bash
$ sdmcli symfony:new <name> [--type=web,ms/microservice]
```

Install a fresh Drupal8 Application:
```bash
$ sdmcli drupal8:new <name>
```

![](/images/1.jpg "")
![](/images/2.jpg "")
![](/images/3.jpg "")
![](/images/4.jpg "")
