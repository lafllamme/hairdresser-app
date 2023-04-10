<p align="center">
  <img width="100" src="https://raw.githubusercontent.com/lhapaipai/vite-bundle/main/docs/symfony-vite.svg" alt="Symfony logo">
</p>

# ViteBundle : Symfony integration with Vite

This bundle helping you render all of the dynamic `script` and `link` tags needed.
Essentially, he provides two twig functions to load the correct scripts into your templates.

## Installation

Before you start, make sure you don't have a package.json file otherwise, or if you come from Webpack Encore, check the [migration](https://github.com/lhapaipai/vite-bundle/blob/main/docs/migration-webpack-encore.md) documentation.

Install the bundle with :

```console
composer require pentatrion/vite-bundle
```

```bash
npm install

# start your vite dev server
npm run dev
```

Add this twig functions in any template or base layout where you need to include a JavaScript entry.

```twig
{% block stylesheets %}
    {{ vite_entry_link_tags('app') }}
{% endblock %}

{% block javascripts %}
    {{ vite_entry_script_tags('app') }}
{% endblock %}
```

if you experience unwanted reloads of your application, read the section [https/http in development](#https--http-in-development).

if you want to reduce the FOUC ([flash of unstyled content](https://en.wikipedia.org/wiki/Flash_of_unstyled_content)), read the section **css file as entrypoint**.

if you are using React, you have to add this option in order to have FastRefresh.

```twig
{{ vite_entry_script_tags('app', { dependency: 'react' }) }}
```

If you want to install the bundle without the community recipe, check the [manual installation](https://github.com/lhapaipai/vite-bundle/blob/main/docs/manual-installation.md).

## Bundle Configuration

If you change some properties in your `vite.config.js` file, you probably need to create a `config/packages/pentatrion_vite.yaml` file to postpone these changes. it concerns `server.host`, `server.port`, `server.https` and `build.outdir` (and also `base`).

default configuration

```yaml
# config/packages/pentatrion_vite.yaml
pentatrion_vite:
    # path to the web root relative to the Symfony project root directory
    public_dir: /public

    # Base public path when served in development or production
    base: /build/

    script_attributes:
        # you can define your attributes that you want to apply
        # for all your script tags

    link_attributes:
        # you can define your attributes that you want to apply
        # for all your link tags


    # only if you have multiple vite.config files
    # leave keys : base, script_attributes, link_attributes empty
    # and fill in the following
    default_build: <custom-build-name-1>
    builds:
        <custom-build-name-1>:
            # Base public path when served in development or production
            base: /build1/

            script_attributes:
                # etc

            link_attributes:
                # etc
```


## Vite config

For the transparency, I decided not to create an overlay of the config file `vite.config.js`. You can check the full documentation of the `vite-plugin-symfony` in the [github repository](https://github.com/lhapaipai/vite-plugin-symfony).

```js
// vite.config.js
import {defineConfig} from "vite";
import symfonyPlugin from "vite-plugin-symfony";

/* if you're using React */
// import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        /* react(), // if you're using React */
        symfonyPlugin(),
    ],

    build: {
        rollupOptions: {
            input: {
                /* relative to the root option */
                app: "./assets/app.ts",

                /* you can also provide css files to prevent FOUC */
                theme: "./assets/theme.css" 
            },
        }
    },
});
```

## Twig functions

The bundle provide 2 twig functions both of which accept an optional second parameter of options and an optional third parameter `buildName` if you have multiple builds (look at [#multiple vite configurations](#multiple-vite-configurations) section).

`vite_entry_script_tags`

options:
- dependency: 'react' | null
- attr: Array (an array of extra attributes)

```twig
vite_entry_script_tags('<entrypoint>', {
    dependency: 'react',
    attr: {
        referrerpolicy: "origin"
    }
})
```

`vite_entry_link_tags`

options:
- attr: Array (an array of extra attributes)

```twig
vite_entry_link_tags('<entrypoint>', {
    attr: {
        media: "screen and (prefers-color-scheme: dark)"
    }
})
```

if you have defined multiple builds
```twig
vite_entry_script_tags('<entrypoint>', {}, '<custom-build-name-1>')
```

## Vite Assets managements

When you reference assets files in your js or css files, you should remember that you need to use a relative path if you wants Vite process your file.
- **all your files defined with an absolute path will be ignored by Vite** and will be left as is in your build files. You can specify an absolute path relative to your public folder. this practice is not recommended because your asset files will not be versioned.
- **all your files defined with a relative path will be processed by Vite**. The paths are relative to the file where they are referenced. Any assets referenced via a relative path will be re-written, versioned, and bundled by Vite.

## Symfony Asset Component

Whenever you build your Vite app, two configuration files are generated in your output folder (default location: public/build/): manifest.json (generated by vite core), entrypoints.json (generated by vite-plugin-symfony).

The manifest.json file is needed to get the versioned filename of assets files, like font files or image files.

so you can use Symfony's asset component and its asset function to take advantage of this file.
To be able to use this during development you will have to use `ViteAssetVersionStrategy`.

```yaml
# config/packages/framework.yaml
framework:
    assets:
        version_strategy: 'Pentatrion\ViteBundle\Asset\ViteAssetVersionStrategy'

```

You can also use the asset twig function by specifing your asset file path relative to your root path (for compatibility reason with vite generated manifest file) specified in your vite.config.js

```twig
<body>
    <img src="{{ asset('assets/images/avatar.jpg') }}" />
</body>
```

You can use this `asset()` function only with assets referenced by JavaScript or CSS files. If you want to make Vite aware of others assets you can import directory of assets into your application's entry point. For example il you want to version all images stored in `assets/images` you could add the following in your `app` entrypoint.

```
├──assets
│ ├──images
│ │ ├──climbing.jpg
│ │ ├──violin.jpg
│ │ ├──...
│ │ 
│ ├──app.js
│...
```

```js
// assets/app.js
import.meta.glob([
    './images/**'
]);
```


## Multiple Vite Configurations

It's possible to combine multiple vite configuration files. Here is a possible configuration model.

`package.json`
```json
{
  "scripts": {
    "dev": "vite -c vite.build1.config.js & vite -c vite.build2.config.js",
    "build": "vite build -c vite.build1.config.js && vite build -c vite.build2.config.js"
  }
}
```

define 2 vite config files `vite.build1.config.js` and `vite.build2.config.js`.

```js
// vite.build1.config.js
import { defineConfig } from 'vite'
import symfonyPlugin from 'vite-plugin-symfony';

export default defineConfig({
  plugins: [
    symfonyPlugin({
      buildDirectory: 'build1'
    }),
  ],

  build: {
    rollupOptions: {
      input: {
        "welcome": "./assets/page/welcome/index.js",
        "theme": "./assets/theme.scss"
      },
    },
  },

  server: {
    port: 19875
  },
});
```

```js
// vite.build2.config.js
import { defineConfig } from 'vite'
import symfonyPlugin from 'vite-plugin-symfony';

export default defineConfig({
  plugins: [
    symfonyPlugin({
      buildDirectory: 'build2'
    }),
  ],

  build: {
    rollupOptions: {
      input: {
        "multiple": "./assets/page/multiple/build2.js",
      },
    },
  },

  server: {
    port: 19876
  },
});
```

in your `config/packages/pentatrion_vite.yaml` file

```yaml
pentatrion_vite:

    default_build: build1
    builds:
        build1:
            base: /build1/
            script_attributes:
                # you can define your attributes that you want to apply
                # for all your script tags

            link_attributes:
                # you can define your attributes that you want to apply
                # for all your link tags

        build2:
            base: /build2/
            script_attributes:
                # etc

            link_attributes:
                # etc

```

in your templates

```twig
{% block stylesheets %}
    {# define your build in the 3rd parameter #}
    {{ vite_entry_link_tags('multiple', [], 'build2') }}

    {# no 3rd parameters it will be default_build -> build1 #}
    {{ vite_entry_link_tags('welcome') }}
{% endblock %}

{% block javascripts %}
    {# define your build in the 3rd parameter #}
    {{ vite_entry_script_tags('multiple', [], 'build2') }}

    {# no 3rd parameters it will be default_build -> build1 #}
    {{ vite_entry_script_tags('welcome') }}
{% endblock %}
```

to show your assets in dev mode

```yaml
# config/routes/dev/pentatrion_vite.yaml

# remove this default config
# _pentatrion_vite:
#     prefix: /build
#     resource: "@PentatrionViteBundle/Resources/config/routing.yaml"

# add one route by build path
_pentatrion_vite_build1:
    path: /build1/{path} #same as your build1 base
    defaults:
        _controller: Pentatrion\ViteBundle\Controller\ViteController::proxyBuild
        buildName: build1
    requirements:
        path: ".+"

_pentatrion_vite_build2:
    path: /build2/{path} #same as your build2 base
    defaults:
        _controller: Pentatrion\ViteBundle\Controller\ViteController::proxyBuild
        buildName: build2
    requirements:
        path: ".+"
```


Optional : if you want to use asset symfony component with custom strategy you need to add extra config...

```yaml
# config/services.yaml
services:
    pentatrion_vite.asset_strategy_build1:
        parent: Pentatrion\ViteBundle\Asset\ViteAssetVersionStrategy
        calls:
            - [setBuildName, ['build1']]

    pentatrion_vite.asset_strategy_build2:
        parent: Pentatrion\ViteBundle\Asset\ViteAssetVersionStrategy
        calls:
            - [setBuildName, ['build2']]
```

```yaml
# config/packages/framework.yaml
framework:
    assets:
        packages:
            build1:
                # same name as your service defined above
                version_strategy: 'pentatrion_vite.asset_strategy_build1'

            build2:
                version_strategy: 'pentatrion_vite.asset_strategy_build2'

```

after you can use your assets like this:
```twig
<img src="{{ asset('assets/images/violin.jpg', 'build1')}}" alt="">
```



## Usage tips

### CSS files as entrypoint

This section talk about FOUC (Flash of unstyled content) for development only. Normally this phenomenon should not occur after a build process.

By default if you import your css files from js entry point, the vite dev server create only one entrypoint (`<script src="http://localhost:5173/build/assets/app.js" type="module"></script>`) for your js and css files. Your css content will be loaded after. This result to a period of time when the content of the page will not be styled. It can be boring.

You can however provide a css/scss/... file as entrypoint and it will be directly inserted as a link tag `<link rel="stylesheet" href="http://localhost:5173/build/assets/theme.scss">`.
In this way your browser will wait for the loading of your `theme.scss` file before rendering the page.

```js
export default defineConfig({
    // ...your config
    build: {
        rollupOptions: {
            input: {
                theme: "./assets/theme.scss"
            },
        }
    },
});
```

note : still add the 2 twig functions vite_entry_link_tags / vite_entry_script_tags
even if the entry point is a css file because ViteJs may need to insert his js code to enable the hmr

```twig
{% block stylesheets %}
    {{ vite_entry_link_tags('theme') }}
{% endblock %}

{% block javascripts %}
    {{ vite_entry_script_tags('theme') }}
{% endblock %}
```

will render
```html
<script src="http://localhost:5173/build/@vite/client" type="module">
<link rel="stylesheet" href="http://localhost:5173/build/assets/theme.scss">
```
during development.

### Dependency Pre-Bundling

Initially in a Vite project, `index.html` is the entry point to your application. When you run your dev serve, Vite will crawl your source code and automatically discover dependency imports.

Because we don't have any `index.html`, Vite can't do this Pre-bundling step when he starts but when you browse a page where he finds a package he does not already have cached. Vite will re-run the dep bundling process and reload the page.

this behavior can be annoying if you have a lot of dependencies because it creates a lot of page reloads before getting to the final render.

you can limit this by declaring in the `vite.config.js` the most common dependencies of your project.

```js
// vite.config.js

export default defineConfig({
    server: {
        //Set to true to force dependency pre-bundling.
        force: true,
    },
    // ...
    optimizeDeps: {
        include: ["my-package"],
    },
});
```
### One file by entry point

Vite try to split your js files into multiple smaller files shared between entry points. In some cases, it's not a good choise and you can prefer output one js file by entry point.

```js
// vite.config.js

export default defineConfig({
  build: {
    rollupOptions: {
      output: {
        manualChunks: undefined,
      },
    },
  },
});
```

### https / http in Development

By default, your Vite dev server don't use https and can cause unwanted reload if you serve your application with https (probably due to invalid certificates ). Configuration is easier if you develop your application without https.

```console
npm run dev
symfony serve --no-tls
```

browse : `http://127.0.0.1:8000`

if you still want to use https you will need to generate certificates for your Vite dev server.

you can use mkcert : https://github.com/FiloSottile/mkcert

```console
mkcert -install
mkcert -key-file certs/vite.key.pem -cert-file certs/vite.crt.pem localhost 127.0.0.1

```

```js
// vite.config.js
import fs from "fs";

export default defineConfig({

    // ...
    server: {
        https: {
          key: fs.readFileSync('certs/vite.key.pem'),
          cert: fs.readFileSync('certs/vite.crt.pem'),
        },
        cors: true
    },
});
```

```console
npm run dev
symfony serve
```

browse : `https://127.0.0.1:8000`

## Dependency injection

if you want more control (like creating custom Twig functions),
you can use dependency injection with EntrypointRenderer / EntrypointsLookup.

```php
use Twig\Extension\AbstractExtension;
use Pentatrion\ViteBundle\Asset\EntrypointRenderer;
use Pentatrion\ViteBundle\Asset\EntrypointsLookup;

class YourTwigExtension extends AbstractExtension
{
    public function __contruct(
        private EntrypointsLookup $entrypointsLookup,
        private EntrypointRenderer $entrypointsRenderer
    ) {
        // ...
    }
}
```


## How this bundle works

```twig
{% block stylesheets %}
    {{ vite_entry_link_tags('app') }}
{% endblock %}

{% block javascripts %}
    {{ vite_entry_script_tags('app') }}
{% endblock %}
```

would render in dev:

```html
<!--Nothing with vite_entry_link_tags('app') -->

<!-- vite_entry_script_tags('app') -->
<script src="http://localhost:5173/build/@vite/client" type="module"></script>
<script src="http://localhost:5173/build/app.js" type="module"></script>
```

would render in prod:

```html
<!-- vite_entry_link_tags('app') -->
<link rel="stylesheet" href="/build/app.[hash].css" />
<link rel="modulepreload" href="/build/vendor.[hash].js" />

<!-- vite_entry_script_tags('app') -->
<script src="/build/app.[hash].js" type="module"></script>
```

In development environment, the bundle also acts as a proxy by forwarding requests that are not intended for it to the Vite dev server.

## Migration

This version 3 is compatible with Vite v4. For migration from v2.X to v3, you just need to update your `vite-plugin-symfony` package to version >= 0.7.2.

Vite-bundle version 2 is compatible with Vite v3.

If you use previous version of the plugin consult [migration](https://github.com/lhapaipai/vite-bundle/blob/main/docs/migration.md) page.
