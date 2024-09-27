# Overriding hookables

While designing more complex systems, you might want to provide more than one hook name while defining a hook.&#x20;

```twig
{% raw %}
{% hook ['app.course.create', 'app.common.create'] %}
{% endraw %}
```

{% hint style="info" %}
While defining multiple hooks names, remember the earlier ones have higher priority than later ones. So, `header` hookable from `app.course.create` will override the one from `app.common.create`.
{% endhint %}

You can use this mechanism for creating set of hookables for "generic" use-cases, and override only specific hookables on a concrete pages. For example, every `create` page (or at least more of them) is similar. So we can define these all similar elements for the `app.common.create` hook, and override only specific ones with other hookables or configuration.

Moreover, there is no limit for number of hook names you can define. So, you can create the following hook:

{% code lineNumbers="true" %}
```twig
{% raw %}
{% hook ['app.course.create.form', 'app.common.create.form', 'app.common.component.form'] %}
{% endraw %}
```
{% endcode %}

A hookable **with the same name** from `app.common.create.form` will override a hookable with the same name from `app.common.component.form`. As same as a hookable with the same name from `app.course.create.form` will override a hookable with the same name from `app.common.create.form` and `app.common.component.form`.

Of course, this mechanism is scoped to a given hook definiton. In other template you can still define:

{% code lineNumbers="true" %}
```twig
{% raw %}
{% hook ['app.common.create.form', 'app.common.component.form'] %}
{% endraw %}
```
{% endcode %}

and in this case only hookables with the same name from `app.common.create.form` will override the ones from `app.common.component.form`.

### Example

Let's consider the following hooks configuration:

{% code title="config/packages/twig_hooks.yaml" lineNumbers="true" %}
```yaml
sylius_twig_hooks:
    hooks:
        'app.common.create':
            header:
                template: 'common/create/header.html.twig'
            content:
                template: 'common/create/content.html.twig'
```
{% endcode %}

And let's assume that we have two pages:

* creating a course
* creating a course category

with the following templates:

{% code title="templates/course/create.html.twig" lineNumbers="true" %}
```twig
<div>
    {% raw %}
{% hook ['app.course.create', 'app.common.create'] %}
{% endraw %}
</div>
```
{% endcode %}

{% code title="templates/course_category/create.html.twig" lineNumbers="true" %}
```
<div>
    {% raw %}
{% hook ['app.course_category.create', 'app.common.create'] %}
{% endraw %}
</div>
```
{% endcode %}

As there is no configuration for the `app.course.create` and `app.course_category.create` the `app.common.create` configuration will be applied. But, once we define the following configuration:

{% code title="config/packages/twig_hooks.yaml" lineNumbers="true" %}
```
sylius_twig_hooks:
    hooks:
        'app.common.create':
            header:
                template: 'common/create/header.html.twig'
            content:
                template: 'common/create/content.html.twig'

        'app.course.create':
            header:
                template: 'course/create/header.html.twig'
```
{% endcode %}

instead of the `common/create/header.html.twig` template we will see the `course/create/header.html.twig` template on the "Create a course" page.
