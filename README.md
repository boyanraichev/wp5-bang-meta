# wp5-bang-meta

Custom meta fields configurator for WordPress 5. An alternative to ACF. This package uses php config files (Laravel-style), instead of saving the configuration into the database, and integrates natively into WordPress. This way it has several advantages over ACF:

- Setup the configuration once and push to every environment
- Access the saved meta data easily with WordPress native functions
- Speed

It depends on the `boyo\wp5-bang` package for reading the configuration files. 

## Configuration

You can find the sample `post_meta.php` and `term_meta.php` configuration files in my theme boilerplate at https://github.com/boyanraichev/wp5-blank