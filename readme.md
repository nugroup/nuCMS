### What is nuCMS

nuCMS is an open source cms project based on CodeIgniter Framework.
You can install this cms fast even on cheap hosting.

### Installation

- Clone git repository
```sh
git clone git@github.com:nugroup/nuCMS.git
```

- Install dependencies using composer
```sh
composer install
```

- Create database

- Run migrations
```sh
php index.php migrate allModules
```

### Server Requirements

PHP version 5.4 or newer is recommended.

It should work on 5.2.4 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

### License

The MIT License (MIT)