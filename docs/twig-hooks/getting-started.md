---
description: >-
  Twig Hooks are a robust and powerful alternative to the Sonata Block Events
  and the old Sylius Template Events systems.
---

# Getting started

### Main features

* built-in support for _Twig templates_, _Twig Components_ and _Symfony Live Components_
* adjustability
* autoprefixing hooks
* configurable hookables
* priority mechanism
* easy enable/disable mechanism per each hook

### Installation

Install the package using Composer and Symfony Flex:

```bash
composer require sylius/twig-hooks
```

### Your first hook & hookable

Once Twig Hooks installed, you can open **any** twig file and define your first hook.

{% code title="some.html.twig" %}
```twig
{# ... #}

{% raw %}
{% hook 'my_first_hook' %}
{% endraw %}

{# ... #}
```
{% endcode %}

From now the `my_first_hook` is a unique name we will use to hook into that place.

{% hint style="success" %}
The ideal hook name:

* is consisted of small case letters
* has logical parts separated with using dots (`.`)
* has each part separated with underscore (`_`) if it is consisted of multiple words



<mark style="color:green;">Recommended:</mark>

* `index`
* `index.sidebar`
* `index.top_menu`



<mark style="color:red;">Not recommended:</mark>

* index
* indextopmenu
{% endhint %}

#### Hooking into a hook

For the purpose of this example, let's consider we want to render the `some_block.html.twig` template inside the `my_first_hook` hook. First step is to create a `twig_hooks.yaml` file (or any other format you use) under the `config/packages/` directory (of course, if you do not have already one).

Now, we can define our first hookable with the following configuration:

{% code title="config/packages/twig_hooks.yaml" lineNumbers="true" %}
```yaml
sylius_twig_hooks:
    hooks:
        'my_first_hook':
            some_block:
                template: 'some_block.html.twig'
```
{% endcode %}

Decomposing the example above we can notice that:

1. `twig_hooks` is just a main key for the Twig Hooks configuration
2. `hooks` is a configuration key for defining hookables per hook
3. `my_first_hook` is our hook name, defined on the Twig file level
4. `some_block` is a name of our hookable, it can be any string, but it should be unique for a given hook unless you want to override the existing hookable (if you want to read more about overriding hookables check the [overriding-hookables.md](advanced/overriding-hookables.md "mention")section)
5. finally we have a `template` key that defines what template should be rendered inside the `my_first_hook` hook

#### Possible hookable configuration options

Depending on the hookable template, we can pass different configuration options while defining hookables:

{% tabs %}
{% tab title="Hookable Template" %}
{% code lineNumbers="true" %}
```yaml
sylius_twig_hooks:
    hooks:
        'my_first_hook':
            some_block:
                template: 'some_block.html.twig'
                enabled: true # whether the hookable is enabled
                context: [] # key-value pair that will be passed to the context bag
                configuration: [] # key-value pair that will be passed to the configuration bag
                priority: 0 # priority, the higher number, the earlier hookable will be hooked
```
{% endcode %}
{% endtab %}

{% tab title="Hookable Component" %}
{% code title="" %}
```yaml
sylius_twig_hooks:
    hooks:
        'my_first_hook':
            some_block:
                component: 'app:block' # component key
                enabled: true # whether the hookable is enabled
                context: [] # key-value pair that will be passed to the context bag
                props: [] # key-value pair that will be passed to our component as props
                configuration: [] # key-value pair that will be passed to the configuration bag
                priority: 0 # priority, the higher number, the earlier hookable will be hooked
```
{% endcode %}
{% endtab %}
{% endtabs %}
