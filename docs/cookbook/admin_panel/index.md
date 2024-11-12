# How to customize your admin panel

## How to customize the sidebar logo

To customize the sidebar logo, you need to configure the new template to use using the following configuration.
Choose the YAML or the PHP version.

```yaml
# config/packages/sylius_bootstrap_admin_ui.yaml
# ...
sylius_twig_hooks:
    hooks:
        # ...
        'sylius_admin.common.component.sidebar.logo':
            image:
                # template: '@SyliusBootstrapAdminUi/shared/crud/common/sidebar/logo/image.html.twig'
                template: 'shared/crud/common/sidebar/logo/image.html.twig'

```

```php
// config/packages/sylius_bootstrap_admin_ui.php
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // ...

    // Add these following lines to define your own Twig template for the logo.
    $containerConfigurator->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.common.component.sidebar.logo' => [
                'image' => [
                    // 'template' => '@SyliusBootstrapAdminUi/shared/crud/common/sidebar/logo/image.html.twig',
                    'template' => 'shared/crud/common/sidebar/logo/image.html.twig',
                ],
            ],
        ],
        
    ]);
};

```

```twig
{# templates/shared/crud/common/sidebar/logo/image.html.twig #}

<img src="{{ asset('images/logo.png') }}" alt="Your Brand name" class="navbar-brand-image" />
  
```

## How to customize the login page logo

To customize the login page logo, you need to configure the new template to use using the following configuration.
Choose the YAML or the PHP version.

```yaml
# config/packages/sylius_bootstrap_admin_ui.yaml
# ...
sylius_twig_hooks:
    hooks:
        # ...
        'sylius_admin.security.login.logo':
            image:
                # template: '@SyliusBootstrapAdminUi/security/common/logo/image.html.twig'
                template: 'security/common/logo/image.html.twig'

```

```php
// config/packages/sylius_bootstrap_admin_ui.php
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import('@SyliusBootstrapAdminUiBundle/config/app.php');

    // Add these following lines to define your own Twig template for the logo.
    $containerConfigurator->extension('sylius_twig_hooks', [
        'hooks' => [
            'sylius_admin.security.login.logo' => [
                'image' => [
                    // 'template' => '@SyliusBootstrapAdminUi/security/common/logo/image.html.twig'
                    'template' => 'security/common/logo/image.html.twig',
                ],
            ],
        ],
    ]);
};
```

```twig
<img src="{{ asset('images/logo.png') }}" alt="Your Brand name" class="sylius navbar-brand-image">

```

## How to customize the admin menu

You should decorate the `sylius_admin_ui.knp.menu_builder` service to customize the admin menu.

```php
<?php

declare(strict_types=1);

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: 'sylius_admin_ui.knp.menu_builder')]
final readonly class MenuBuilder
{
    public function __construct(
        private readonly FactoryInterface $factory,
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu
            ->addChild('dashboard', [
                'route' => 'sylius_admin_ui_dashboard',
            ])
            ->setLabel('sylius.ui.dashboard')
            ->setLabelAttribute('icon', 'dashboard')
        ;
    }
}
