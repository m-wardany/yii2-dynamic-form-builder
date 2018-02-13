dynamic form generator
======================
this package generate dynamic form with client and server side validation

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist wardany/dynamic-form-builder "*"
```

or add

```
"wardany/dynamic-form-builder": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \wardany\dform\AutoloadExample::widget(); ?>```