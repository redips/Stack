# Installation

We assume you're familiar with [Composer](http://packagist.org), a dependency manager for PHP.
Use the following command to add the bundle to your ``composer.json`` and download the package.

If you have [Composer installed globally](http://getcomposer.org/doc/00-intro.md#globally).

```bash
composer require sylius/resource-bundle
```
Otherwise you have to download .phar file.

```bash
curl -sS https://getcomposer.org/installer | php
php composer.phar require sylius/resource-bundle
```
## Adding Required Bundles to The Kernel

You need to enable the bundle and its dependencies in the kernel:

{% code title="config/bundles.php" %}
```php
return [
    new FOS\RestBundle\FOSRestBundle(),
    new JMS\SerializerBundle\JMSSerializerBundle($this),
    new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
    new BabDev\PagerfantaBundle\BabDevPagerfantaBundle(),
    new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
    new winzou\Bundle\StateMachineBundle\winzouStateMachineBundle(),
];
```
{% endcode %}

Configure your mapping paths for your resources

{% code title="config/packages/sylius_resource.yaml" lineNumbers="true" %}
```yaml
sylius_resource:
    mapping:
        paths:
            - '%kernel.project_dir%/src/Entity'
```
{% endcode %}

Configure the routing

{% code title="config/routes.yaml" %}
```yaml
# [...]

sylius_crud_routes:
    resource: 'sylius.routing.loader.crud_routes_attributes'
    type: service

sylius_routes:
    resource: 'sylius.routing.loader.routes_attributes'
    type: service
```
{% endcode %}

That's it! Now you can configure your first resource.
