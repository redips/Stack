# Composable Layouts with a predictable structure

{% hint style="info" %}
All examples in this chapter assume you are familiar with the [autoprefixing-feature.md](autoprefixing-feature.md "mention").&#x20;
{% endhint %}

Before we dive into **how** to create composable layouts with `Twig Hooks`, let's first understand **what** the `composable` part means.

>
>
> **composable** (_not_ [_comparable_](https://en.wiktionary.org/wiki/Appendix:Glossary#comparable))
>
> 1. Capable of being [composed](https://en.wiktionary.org/wiki/compose#English) (as from multiple [constituent](https://en.wiktionary.org/wiki/constituent#Adjective) or [component](https://en.wiktionary.org/wiki/component#Adjective) elements).
>
> source: [Wiktioniary](https://en.wiktionary.org/wiki/composable)

So, to achieve composability we need building blocks from which we will build our layouts. With Twig Hooks we can use the following building blocks (in Twig Hooks we call them hookables):

* A regular Twig template
* Twig Component
* Live Component

As mentioned in previous chapters, hookables can also define their own hooks, so we are able to create more complex building blocks like the header section which consisted of a title and some action buttons.&#x20;

To fully utilize this functionality, make sure:

* you have turned on the [autoprefixing-feature.md](autoprefixing-feature.md "mention") and you are familiar with it
* you are familiar with [Twig Components](https://symfony.com/bundles/ux-twig-component/current/index.html) and the concept of [anonymous components](https://symfony.com/bundles/ux-twig-component/current/index.html#anonymous-components)

### Predictable structure

The idea behind the `Predictable structure` is to organize your hookables (your Twig templates) to make it easier to guess the hooks names with which they are rendered, and to be able to find them based on a given hook name.
This approach aims to reduce the need to browse through multiple folders when trying to locate a template we want to edit or check.

{% hint style="info" %}
When we define a hook in a template which is not a hookable (e.g., it is rendered by a controller) we call such a hook a **primal hook**. For primal hooks we always need to define a full hook name (as the [autoprefixing-feature.md](autoprefixing-feature.md "mention") does not work in this case) and a context we want to pass to hookables.

The opposite of **primal hookable** is **subsequent hook**. This means that a given template is a hookable and defines a new hook (or hooks).
{% endhint %}

The main rule for predictable structure is:

> Given a template defines a hook, all its hookables should live in a directory with the same name as the template.

So, if `templates/course/create.html.twig` defines a hook, all its direct hookables should live in the `templates/course/create/` directory (e.g., `templates/course/create/form.html.twig`).&#x20;

#### Example

To better understand this rule, let's consider the following directory structure (and let's assume `create.html.twig`, `form.html.twig` and `header.html.twig` define new hooks inside):

<figure><img src="../.gitbook/assets/CleanShot 2024-05-18 at 10.47.35@2x.png" alt=""><figcaption></figcaption></figure>

we can tell that:

* `create.html.twig` has two direct hookables (`form` , `header`)
* `header.html.twig` has one direct hookable (`title` )
* `form.html.twig` has five direct hookables (`create` , `max_number_of_students`, `name`, `price`, `start_date`)

Moreover, assuming `create.html.twig` defines an `app.course.create` primal hook, we can tell that the `form.html.twig` defines an `app.course.create.form` subsequent hook and `header.html.twig` defines a `app.course.create.header` subsequent hook.

{% hint style="info" %}
`app.course.create` can be any name, as there is no convention enforcement for primal hooks. However, in this example we assume that every hook is prefixed with `app` and the rest of the hook name is related to the template path.

When defining hooks inside bundles, it is recommended to use a configuration key as a prefix.
For instance, for `@SyliusAdmin/product/create/html.twig` we get `sylius_admin.product.create` as `SyliusAdminBundle` uses `sylius_admin` as a configuration key.
{% endhint %}
