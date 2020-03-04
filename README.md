# Fundamento

A modern, [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself) and reusable theme, specially made for [Engenharia Livre](https://engenharialivre.com).

[Theme class](https://github.com/EngenhariaLivre/fundamento/blob/master/classes/class-theme.php) based on the work of [Tyler Smith](https://dev.to/tylerlwsmith/simplifying-wordpresss-functionsphp-with-oop-2mj8).

## Development

Start WordPress locally with [WP-CLI](https://wp-cli.org/):

```
wp server --host=localhost --port=8030 
```

Clone the repository on WordPress theme directory:

```
git clone https://github.com/EngenhariaLivre/fundamento.git
```

Install development dependencies:
```
composer install && npm install
```

Watch SASS changes:

```
npm run watch:sass
```

Build CSS:

```
npm run build
```

Check PHP against WordPress coding rules:

```
npm run check:php
```

For more, please, explore the npm scripts on package.json.