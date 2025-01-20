Creating custom Bulk Action
===========================

There are cases where pressing a button per item in a grid is not
suitable. And there are also certain cases when built-in bulk action
types are not enough.

All you need to do is create your own bulk action template and register
it for the `sylius_grid`.

In the template we will specify the button's icon to be `export` and its
colour to be `orange`.

{% code %}
```twig
{% import '@SyliusUi/Macro/buttons.html.twig' as buttons %}

{% set path = options.link.url|default(path(options.link.route)) %}

{{ buttons.default(path, action.label, null, 'export', 'orange') }}
```
{% endcode %}

Now configure the new action's template like below in the
`config/packages/sylius_grid.yaml`:

{% code title="config/packages/sylius_grid.yaml" lineNumbers="true" %}
```yaml
sylius_grid:
    templates:
        bulk_action:
            export: "@App/Grid/BulkAction/export.html.twig"
```
{% endcode %}

From now on you can use your new bulk action type in the grid
configuration!

Let's assume that you already have a route for exporting by injecting
ids, then you can configure the grid action:

<details open><summary>Yaml</summary>

{% code title="config/packages/sylius_grid.yaml" lineNumbers="true" %}
```yaml
sylius_grid:
    grids:
        app_admin_product:
            ...
            actions:
                bulk:
                    export:
                        type: export
                        label: Export Data
                        options:
                            link:
                                route: app_admin_product_export
                                parameters:
                                    format: csv
```
{% endcode %}

</details>

<details open><summary>PHP</summary>

{% code title="config/packages/sylius_grid.php" lineNumbers="true" %}
```php
<?php

use App\Entity\Product;
use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\GridBuilder;
use Sylius\Bundle\GridBundle\Builder\Field\Field;
use Sylius\Bundle\GridBundle\Config\GridConfig;

return static function (GridConfig $grid) {
    $grid->addGrid(GridBuilder::create('app_admin_product', Product::class)
        ->addActionGroup(
            BulkActionGroup::create(
                Action::create('export', 'export')
                    ->setLabel('Export Data')
                    ->setOptions([
                        'link' => [
                            'route' => 'app_admin_product_export',
                            'parameters' => [
                                'format' => 'csv',
                            ],
                        ]
                    ])
            )
        )
    )
};
```
{% endcode %}

OR

{% code title="src/Grid/AdminProductGrid.php" lineNumbers="true" %}
```php
<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\Product;
use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class AdminProductGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
           return 'app_admin_product';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addActionGroup(
                BulkActionGroup::create(
                    Action::create('export', 'export')
                        ->setLabel('Export Data')
                        ->setOptions([
                            'link' => [
                                'route' => 'app_admin_product_export',
                                'parameters' => [
                                    'format' => 'csv',
                                ],
                            ]
                        ])
                )
            )
        ;    
    }
    
    public function getResourceClass(): string
    {
        return Product::class;
    }
}
```
{% endcode %}

</details>
