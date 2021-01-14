Module
============================

A Module for Ramverk1Redovisning

Scrutinizer
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ylvarw/module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ylvarw/module/?branch=master)

scrutinizer
[![Build Status](https://scrutinizer-ci.com/g/ylvarw/module/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ylvarw/module/build-status/master)

Travis
[![Build Status](https://travis-ci.org/ylvarw/module.svg?branch=master)](https://travis-ci.org/ylvarw/module)

CircleCI
[![ylvarw](https://circleci.com/gh/ylvarw/module.svg?style=svg)](https://app.circleci.com/pipelines/github/ylvarw/module?branch=main)

Symfony
[![SymfonyInsight](https://insight.symfony.com/projects/6cafa987-3ae6-4f3c-b535-e9b641680a6d/mini.svg)](https://insight.symfony.com/projects/6cafa987-3ae6-4f3c-b535-e9b641680a6d) [![Join the chat at https://gitter.im/ylvan/module](https://badges.gitter.im/ylvan/module.svg)](https://gitter.im/ylvan/module?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

__installation__

add to composer.json

```
"require": {"ylvan/module": "dev-master"}
```


install module with `composer update`

```
#Add files to project
rsync -av vendor/ylvan/module/config ./
rsync -av vendor/ylvan/module/src ./
rsync -av vendor/ylvan/module/test ./
rsync -av vendor/ylvan/module/view ./
```

```
#Or move all folders at once
rsync -av vendor/ylvan/module/* ./

note that using this command will overwrite existing composer file

```
