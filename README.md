# Hairdresser App

A Symfony 5.4 application serving a Vue 3 single-page frontend for a hair salon site: navigation, an image slider, a masonry gallery, and service information, with a light and dark mode switch.

> Experiment from 2023 exploring the Symfony plus Vite plus Vue setup. It is a frontend study, not a finished product.

## What it includes

- A Vue 3 interface mounted into a Twig template through Vite.
- Navigation bar, sticky banner, and bottom menu.
- An image slider with a skeleton placeholder while loading.
- A masonry gallery and a service information section.
- A light and dark mode switcher.

## Tech stack

- Symfony 5.4 and PHP
- Vue 3 and TypeScript
- Vite with `vite-plugin-symfony`
- Tailwind CSS, Headless UI, and Flowbite
- Sass

## Getting started

### Requirements

- PHP 7.2.5 or newer
- Composer
- Node.js and npm
- [Symfony CLI](https://symfony.com/download)

### Installation

```bash
composer install
npm install
```

### Development

Build the assets and start the Symfony server:

```bash
npm run dev
symfony server:start
```

The application runs at `http://localhost:8000/`, the Vue interface at `/vue`.

## Useful commands

```bash
npm run dev     # Vite dev server with live reload
npm run build   # Build the production assets into public/build
```

Do not compile the TypeScript files by hand. Vite owns the build and is wired into Symfony through `vite-plugin-symfony`; a manual `tsc` run bypasses that configuration and breaks the asset manifest.

## How it works

`VueController` renders `templates/vue/index.html.twig`, which loads the Vite entry point `assets/app.ts`. From there `assets/vue/App.vue` composes the page through a `BaseLayout` with header, main, and footer slots. Vite writes its output to `public/build` and Symfony resolves the hashed asset names through the plugin.

## Project structure

```text
assets/
├── vue/
│   ├── components/   # Slider, gallery, navigation, service info, bottom menu
│   ├── patterns/     # Sticky banner, mode switcher, skeletons, icons
│   ├── layout/       # BaseLayout with header, main, and footer slots
│   └── App.vue
├── helpers/          # Mode switching
├── styles/           # Sass entry point
└── app.ts            # Vite entry point

src/Controller/       # Symfony route rendering the Vue shell
templates/            # Twig base and Vue host template
```

## Status

Unmaintained. Symfony 5.4 and the pinned frontend dependencies are from 2023 and are not kept current. The routing is intentionally minimal — a single controller serving the Vue app plus one JSON test route.

## License

No open-source license has been declared yet. Until a license is added, reuse and redistribution are not granted by default.

Made with love by [Laflamme](https://github.com/lafllamme).
