Module
============================

A Module for Ramverk1Redovisning

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ylvarw/module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ylvarw/module/?branch=master)

[![Build Status](https://scrutinizer-ci.com/g/ylvarw/module/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ylvarw/module/build-status/master)

[![Build Status](https://travis-ci.org/ylvarw/module.svg?branch=master)](https://travis-ci.org/ylvarw/module)

[![ylvarw](https://circleci.com/gh/ylvarw/module.svg?style=svg)](https://app.circleci.com/pipelines/github/ylvarw/module?branch=main)


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
