Field Types
===========

This is the list of built-in field types.

String
------

Simplest column type, which basically renders the value at given path as
a string.

By default, it uses the name of the field, but you can specify a different path if needed. For example:

<details open><summary>Yaml</summary>

{% code title="config/packages/sylius_grid.yaml" lineNumbers="true" %}
```yaml
sylius_grid:
    grids:
        app_user:
            fields:
                email:
                    type: string
                    label: app.ui.email # each field type can have a label, we suggest using translation keys instead of messages
                    path: contactDetails.email
```
{% endcode %}

</details>

<details open><summary>PHP</summary>

{% code title="config/packages/sylius_grid.php" lineNumbers="true" %}
```php
<?php

use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilder;
use Sylius\Bundle\GridBundle\Config\GridConfig;

return static function (GridConfig $grid): void {
    $grid->addGrid(GridBuilder::create('app_user', '%app.model.user.class%')
        ->addField(
            StringField::create('email')
                ->setLabel('app.ui.email') // # each field type can have a label, we suggest using translation keys instead of messages
                ->setPath('contactDetails.email')
        )
    )
};
```
{% endcode %}

OR

{% code title="src/Grid/UserGrid.php" lineNumbers="true" %}
```php
<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\User;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class UserGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
           return 'app_user';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                StringField::create('email')
                    ->setLabel('app.ui.email') // # each field type can have a label, we suggest using translation keys instead of messages
                    ->setPath('contactDetails.email')
            )
        ;
    }

    public function getResourceClass(): string
    {
        return User::class;
    }
}
```
{% endcode %}

</details>

This configuration will display the value from
`$user->getContactDetails()->getEmail()`.

DateTime
--------

This column type works exactly the same way as *string*, but expects a
*DateTime* instance and outputs a formatted date and time string.

Available options:
* `format` - default is `Y:m:d H:i:s`, you can modify it with any supported format (see https://www.php.net/manual/en/datetime.format.php)
* `timezone` - default is `%sylius_grid.timezone%` parameter, null if such a parameter does not exist, you can modify it with any supported timezone (see https://www.php.net/manual/en/timezones.php)

<details open><summary>Yaml</summary>

{% code title="config/packages/sylius_grid.yaml" lineNumbers="true" %}
```yaml
sylius_grid:
    grids:
        app_user:
            fields:
                birthday:
                    type: datetime
                    label: app.ui.birthday
                    options:
                        format: 'Y:m:d H:i:s'
                        timezone: null
```
{% endcode %}

</details>

<details open><summary>PHP</summary>

{% code title="config/packages/sylius_grid.php" lineNumbers="true" %}
```php
<?php

use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\GridBuilder;
use Sylius\Bundle\GridBundle\Config\GridConfig;

return static function (GridConfig $grid): void {
    $grid->addGrid(GridBuilder::create('app_user', '%app.model.user.class%')
        ->addField(
            DateTimeField::create('birthday', 'Y:m:d H:i:s', null) // this format and timezone are the default value, but you can modify them
                ->setLabel('app.ui.birthday')
        )
    )
};
```
{% endcode %}

OR

{% code title="src/Grid/UserGrid.php" lineNumbers="true" %}
```php
<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\User;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class UserGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
           return 'app_user';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                DateTimeField::create('birthday', 'Y:m:d H:i:s', null) // this format and timezone are the default value, but you can modify them
                    ->setLabel('app.ui.birthday')
            )
        ;
    }

    public function getResourceClass(): string
    {
        return User::class;
    }
}
```
{% endcode %}

</details>

### *Warning*

You have to pass `'format'` and `'timezone'` again if you want to call the `setOptions` function.
Otherwise, it will be unset:

Example:
{% code %}
```php
$field->setOptions([
    'format' => 'Y-m-d H:i:s',
    'timezone' => 'null'

    // Your options here
]);
```
{% endcode %}

Twig (*twig*)
-------------

The Twig column type is the most flexible one, because it
delegates the logic of rendering the value to the Twig templating engine.
You just have to specify the template and it will be rendered with the
`data` variable available to you.

<details open><summary>Yaml</summary>

{% code title="config/packages/sylius_grid.yaml" lineNumbers="true" %}
```yaml
sylius_grid:
    grids:
        app_user:
            fields:
                name:
                    type: twig
                    label: app.ui.name
                    options:
                        template: "@Grid/Column/_prettyName.html.twig"
```
{% endcode %}

</details>

<details open><summary>PHP</summary>

{% code title="config/packages/sylius_grid.php" lineNumbers="true" %}
```php
<?php

use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilder;
use Sylius\Bundle\GridBundle\Config\GridConfig;

return static function (GridConfig $grid): void {
    $grid->addGrid(GridBuilder::create('app_user', '%app.model.user.class%')
        ->addField(
            TwigField::create('name', '@Grid/Column/_prettyName.html.twig')
                ->setLabel('app.ui.name')
        )
    )
};
```
{% endcode %}

OR

{% code title="src/Grid/UserGrid.php" lineNumbers="true" %}
```php
<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\User;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class UserGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
           return 'app_user';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                TwigField::create('name', ':Grid/Column:_prettyName.html.twig')
                    ->setLabel('app.ui.name')
            )
        ;
    }

    public function getResourceClass(): string
    {
        return User::class;
    }
}
```
{% endcode %}

</details>

In the `@Grid/Column/_prettyName.html.twig` template, you just need to
render the value. For example:

{% code %}
```twig
<strong>{{ data }}</strong>
```
{% endcode %}

If you wish to render more complex grid fields, just redefine the path of
the field to root – `path: .` and then you can access all
attributes of the object instance:

{% code %}
```twig
<strong>{{ data.name }}</strong>
<p>{{ data.description|markdown }}</p>
```
{% endcode %}

### *Warning*

You have to pass the `'template'` option again if you want to call the `setOptions` function. Otherwise, it will be unset:

Example:
{% code %}
```php
$field->setOptions([
    'template' => ':Grid/Column:_prettyName.html.twig',

    // Your options here
]);
```
{% endcode %}
