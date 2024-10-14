---
description: >-
  Admin UI contains minimalist generic templates and routes for your admin panels.
---

# Getting started

## Installation

Install the package using Composer and Symfony Flex:

```bash
composer require sylius/admin-ui
```

## Basic routes

- __Dashboard__ - sylius_admin_ui_dashboard
- __Login__ - sylius_admin_ui_login
- __LoginCheck__ - sylius_admin_ui_login_check
- __Logout__ - sylius_admin_ui_logout

## Minimalist templates

### Crud templates

- crud/create.html.twig
- crud/index.html.twig
- crud/show.html.twig
- crud/update.html.twig

*Usage with Sylius Resource package*

```php
// src/Entity/Speaker.php

namespace App\Entity;

use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Model\ResourceInterface;

#[AsResource(
    templatesDir: '@SyliusAdminUi/crud',
)]
class Speaker implements ResourceInterface
{
    // ...
}

```

### Dashboard

- dashboard/index.html.twig

### Login

- security/login.html.twig
