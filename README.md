# MrOAK
Create base modules or other file structures based on templates. Similar to Laravel's Artisan command however templates are not tied to a specific framework and are intended to be specific for a projects needs.

### Install
```
composer require mroke
composer require <your_module_template>
```

### Usage
`vendor/bin/MrOak create -h`

```
vendor/bin/MrOak create --namespace="YourProject\\" <your_module_template>" path/to/new/module
```

**Note**: It is recommended that you alias this in your composer.json file as a script. In most use cases things like the template and namespace will not need to change so they can be omitted via an alias. e.g.

```JSON
"scripts": {
    "create-module": [
        "vendor/bin/MrOak create --namespace='Acme\\' <your_module_template> "
    ]
}
```

You can then just run `composer create-module src/NewModule`
