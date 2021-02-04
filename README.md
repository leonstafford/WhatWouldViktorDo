# What Would Viktor Do

WordPress plugin quality auditor, inspired by all the great work by [Viktor Szepe](https://github.com/szepeviktor).

I made this to help me audit [my multiple plugins](https://github.com/leonstafford). Imitation is the greatest form of flattery, so I'm stealing Viktor's ideas from things like [small project](https://github.com/szepeviktor/small-project) and other resources [Viktor has recommended](https://tomasvotruba.com/cleaning-lady-checklist/).

I struggle to maintain manual checklists or keep up to date with things, so automating out this kind of auditing is something I dearly need. I hope it can help some other developers benefit and improve code quality, so this is available on [Packagist](https://packagist.org/packages/whatwouldviktordo/), but will start quite opinionated in what I want to audit my projects for.

## Features (planned/built)

 - [x] check for `README.md`
 - [x] check for `LICENSE.md`
 - [ ] check for CI tooling (`.circle`, `.travis.yml`, `.github/workflows`)
 - [ ] check for `readme.txt` for wp.org publishing, including required fields/sections within
 - [ ] check `composer.json` (or vendor dir?) for `szepeviktor/phpcs-psr-12-neutron-hybrid-ruleset`, `szepeviktor/phpstan-wordpress`, `composer validate --strict`
 - [ ] check for `.editorconfig`, `.gitignore`, `.gitattributes`
 - [ ] check for a `src` directory
 - [ ] check for tags within git repo
 - [ ] check for project published on Packagist
 - [ ] check for URL added to GitHub repo


## Installation

Add this package to your project.

`composer require --dev leonstafford/whatwouldviktordo`

## Usage

This is not a replacement for other code quality tools, like 

`php ./vendor/bin/whatwouldviktordo`

or add as a Composer script:

```
"scripts": {                                                                   
        "phpstan": "php -d memory_limit=-1 ./vendor/bin/phpstan analyse",
        "whatwouldviktordo": "php ./vendor/bin/whatwouldviktordo"
}
```

And run with `composer run-script whatwouldviktordo`. I like to have all code quality checks under a main `test` script, too:

```
"test": [
  "composer validate --strict",
  "@whatwouldviktordo",
  "@lint",
  "@phpcs",
  "@php73",
  "@php74",
  "@phpstan",
  "@phpunit"
],
``` 

## Development

 - `git@github.com:leonstafford/WhatWouldViktorDo.git`
 - `cd WhatWouldViktorDo`
 - `composer install --ignore-platform-reqs` (workaround until upstream depency issue resolved)
 - `composer run-script test`

While developing this project, you may directly use `./bin/` vs `./vendor/bin` in your scripts, ie: "php ./bin/whatwouldviktordo".

## Roadmap

I'd like to make this more flexible for other users' needs, so adding in a config file to override/ignore certain checks and continual expansion of checking for best practices within WordPress plugins.


