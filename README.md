# DevSnaps (back-end)

> Everyday solutions to everyday dev problems

As a developer, I stumble upon dev problems *every single day*.<br>
Most of the time the fixes are trivial, but in some cases they need a thorough investigation.

In order to *keep track* of how I solved each of those problems, this application allows to keep track of each 'snap' of code/solution I may have encountered and used.

## Technologies

The DevSnaps application is composed of two parts:
- The [front-end](https://github.com/AlexandreBonneau/devSnaps) with [Vue.js](https://github.com/vuejs/vue), [Nuxt.js](https://github.com/nuxt/nuxt.js) and [Vuetify.js](https://vuetifyjs.com/), and
- The [back-end](https://github.com/AlexandreBonneau/devSnaps-back) with Laravel's lightweight [Lumen framework](https://github.com/laravel/lumen).

**This repository *DevSnaps-back* is the code for the back-end.** 

## Goal of this project

This project has been created to serve as a playground for Nuxt and Vuetify (and Lumen to some extends since it's a bit different than Laravel), and to learn from it.

**Be sure to check the code and tell me what can be improved so that we could all learn from you!**

## Work in progress

Since this is a work in progress, the features for now are pretty bare but more features are in preparation.

Check the project roadmap [here](https://github.com/AlexandreBonneau/devSnaps#work-in-progress).

## Build Setup

1. Clone this repository
```bash
git clone https://github.com/AlexandreBonneau/devSnaps-back.git
```
2. Install the dependencies
```bash
cd devSnaps-back
composer install
```
3. Create a `database/database.sqlite` file to store the Snap data (or use any sql server you'd prefer).
4. That's it for the back-end preparation!
5. If you want to run the DevSnaps application, you need to clone the [front-end repo](https://github.com/AlexandreBonneau/devSnaps) as well then follow the instructions from [here](https://github.com/AlexandreBonneau/devSnaps#build-setup).

For info, the back-end API server will run by default on port `4242`, but you can change that in the back-end configuration and in the `.env` file in the front-end repository.

## Contributing

I'm open to **any** critics regarding the code, so *please* create an [issue](https://github.com/AlexandreBonneau/devSnaps/issues/new)/[pull request](https://github.com/AlexandreBonneau/devSnaps/compare) if you think any part of it can be improved!

## Support

I'll just leave my patreon page link here (I work on [AutoNumeric](https://github.com/autoNumeric/autoNumeric/) and [vue-autoNumeric](https://github.com/autoNumeric/vue-autoNumeric) too for instance), you never know :)

[![Donate][patreon-image]][patreon-url]

## License

DevSnaps is an [MIT-licensed](http://opensource.org/licenses/MIT) open-source project, feel free to copy/edit/study its code!


[patreon-url]: https://www.patreon.com/user?u=4810062
[patreon-image]: https://img.shields.io/badge/patreon-donate-orange.svg
