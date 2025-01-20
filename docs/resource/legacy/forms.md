# Forms

{% hint style="warning" %}
This section is deprecated. However, as of now, the Sylius E-Commerce project is still resorting to this configuration so you might want to check it out.
{% endhint %}

Have you noticed how Sylius generates forms for you? Of course, for many use-cases you may want to create a custom form.

## Custom Resource Form

### Create a FormType class for your resource

{% code title="src/Form/Type/BookType.php" lineNumbers="true" %}
```php
namespace App\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Build your custom form, with all fields that you need
        $builder->add('title', TextType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_book';
    }
}
```
{% endcode %}

### **Note**
The getBlockPrefix method returns the prefix of the template block name for this type.

### Register the FormType as a service


### **Warning**

the registration of a form type is only needed when the form is extending the ``AbstractResourceType``
or when it has some custom constructor dependencies.

{% code %}
```yaml
app.book.form.type:
    class: App\Form\Type\BookType
    tags:
        - { name: form.type }
    arguments: ['%app.model.book.class%', '%app.book.form.type.validation_groups%']
```
{% endcode %}

## Configure the form for your resource

{% code title="config/routes/sylius_resource.yaml" lineNumbers="true" %}
```yaml
sylius_resource:
    resources:
        app.book:
            classes:
                model: App\Entity\Book
                form: App\Form\Type\BookType
```
{% endcode %}

That's it. Your new class will be used for all forms!

**[Go back to the documentation's index](index.md)**
