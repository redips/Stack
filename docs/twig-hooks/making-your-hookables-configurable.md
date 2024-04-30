# Making your hookables configurable

Sometimes when you are creating a bundle or a reusable template for different hookables, you might want to provide a way to adjust it to a given context. Thanks to the configuration data bag, you are able to achieve it easily.

Configuration can be defined only while defining a hookable, and is accessibly with using `hookable_metadata.configuration.<key_name>` or `get_hookable_configuration().<key_name>`.

#### Example

{% code title="index.html.twig" lineNumbers="true" %}
```
{#
 # we assume there is a `form` variable holding a `FormView` instance passed
 # from the controller
 #}

<div class="container">
    {{ form_start(form) }}
        {{ form_errors(form) }}
        {{ form_widget(form._token) }}
    
        {% raw %}
{% hook 'index.form' with { form } %}
{% endraw %}
    {{ form_end(form, {render_rest: false}) }}
</div>
```
{% endcode %}

{% code title="generic_field.html.twig" lineNumbers="true" %}
```
<div class="{{ hookable_metadata.configuration.attr.class|default("field) }}">
     {{ form_row(
          hookable_metadata.context.form[hookable_metadata.configuration.field_name]
     ) }}
</div>
```
{% endcode %}

{% code title="twig_hooks.yaml" lineNumbers="true" %}
```
twig_hooks:
    hooks:
        'index.form':
            name:
                template: 'generic_field.html.twig'
                configuration:
                    field_name: 'name'
                    attr:
                        class: 'field special-field'
```
{% endcode %}
