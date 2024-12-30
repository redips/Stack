# Customizing the page titles

## Adding an icon

<div data-full-width="false">

<figure><img src="../../.gitbook/assets/title_with_icon.png" alt="Title with icon"></figure>

</div>

To add an icon to the page title, you need to use Twig hooks configuration.

Search the "title_block" in the Symfony debug profiler at the Twig hooks section.

<div data-full-width="false">

<figure><img src="../../.gitbook/assets/title_block_in_profiler.png" alt="Title block in profiler"></figure>

</div>

Here's an example to define a "users" icon on a speaker list.

```yaml
# config/packages/sylius_bootstrap_admin_ui.yaml
# ...
sylius_twig_hooks:
    hooks:
        # ...
        'sylius_admin.speaker.index.content.header.title_block':
            title:
                # We need to reuse the same template as 'sylius_admin.common.index.content.header.title_block'
                template: '@SyliusBootstrapAdminUi/shared/crud/common/content/header/title_block/title.html.twig'
                configuration:
                    icon: tabler:users # you can use any icon from Symfony UX icons.
```

You can also define a default icon for every "index" pages.

<div data-full-width="false">

<figure><img src="../../.gitbook/assets/icon_for_index_pages.png" alt="Icon for index pages"></figure>

</div>

```yaml
# config/packages/sylius_bootstrap_admin_ui.yaml
# ...
sylius_twig_hooks:
    hooks:
        # ...
        'sylius_admin.common.index.content.header.title_block':
            title:
                configuration:
                    icon: tabler:list-details
```

## Adding a subheader

<div data-full-width="false">

<figure><img src="../../.gitbook/assets/title_with_subheader.png" alt="Title with subheader"></figure>

</div>

To add a subheader to the page title, you need to use Twig hooks configuration.

See the [previous section](#adding-an-icon) to see how to search for the title block.

Here's an example to define a subheader on a speaker list.

```yaml
# config/packages/sylius_bootstrap_admin_ui.yaml
# ...
sylius_twig_hooks:
    hooks:
        # ...
        'sylius_admin.speaker.index.content.header.title_block':
            title:
                # We need to reuse the same template as 'sylius_admin.common.index.content.header.title_block'
                template: '@SyliusBootstrapAdminUi/shared/crud/common/content/header/title_block/title.html.twig'
                configuration:
                    subheader: app.ui.managing_your_speakers # you also need add this key on your translations.
```
