# Basic operations

## List of resources

<div data-full-width="false">

<figure><img src="../../.gitbook/assets/list_of_books.png" alt="List of books"></figure>

</div>

Create a grid for your resource.

```shell
bin/console make:grid
```

Configure the `index` operation in your resource.

```php
namespace App\Entity;

use App\Grid\BookGrid;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Model\ResourceInterface;

#[AsResource(
    section: 'admin', // This will influence the route name
    routePrefix: '/admin',
    templatesDir: '@SyliusAdminUi/crud', // This directory contains the generic template for your list
    operations: [
        new Index( // This operation will add "index" operation for the books list
            grid: BookGrid::class, // Use the grid class you have generated in previous step
        ), 
    ],    
)]
class Book implements ResourceInterface
{
    //...
}
```

Use the Symfony `debug:router` command to check the results.

```shell
bin/console debug:router
```

Your route should look like this.

```shell
 ------------------------------ ---------------------------
  Name                           Path                                           
 ------------------------------ ---------------------------                  
  app_admin_book_index           /admin/books               
```

## Resource creation page

<div data-full-width="false">

<figure><img src="../../.gitbook/assets/book_creation.png" alt="Book creation page"></figure>

</div>

Create a form type for your resource.

```shell
bin/console make:form

Configure the `create` operation in your resource.

```php
namespace App\Entity;

use App\Form\BookType;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Model\ResourceInterface;

#[AsResource(
    section: 'admin', // This will influence the route name
    routePrefix: '/admin',
    templatesDir: '@SyliusAdminUi/crud', // This directory contains the generic templates
    formType: BookType::class, // The form type you have generated in previous step
    operations: [
        // ...
        new Create(), // This operation will add "create" operation for the book resource
    ],    
)]
class Book implements ResourceInterface
{
    //...
}
```

Use the Symfony `debug:router` command to check the results.

```shell
bin/console debug:router
```

Your route should look like this.

```shell
 ------------------------------ ---------------------------
  Name                           Path                                           
 ------------------------------ ---------------------------                  
  app_admin_book_create           /admin/books/new               
```
