# Metadata objects

Metadata objects have been introduce to structurize the information passed between hooks and hookables. In Twig Hooks we have two metadata objects:

* A hook metadata object, which contains information about the hook name, and the hook-level defined context
* A hookable metadata object, which contains information about the hook which rendered it, the merged context, the configuration and prefixes

### Accessing a hook metadata

A hook metadata object can be accessed only from a hookable metadata object.&#x20;

### Accessing a hookable metadata

A hookable metadata can be accessed from a Twig template that is a hookable. You can do this by:

* using the `hookable_metadata` variable which is automatically created for hookables
* using the `get_hookable_metadata()` function

There is no difference between these two methods, so you can pick the one you prefer the one that best fits your coding style.&#x20;

{% hint style="info" %}
There are also Twig functions which are shortcuts for accessing concrete data bags from a metadata object:

* `get_hookable_context()` for accessing the context
* `get_hookable_configuration` for accessing the configuration
{% endhint %}

