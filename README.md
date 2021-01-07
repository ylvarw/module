Module
============================

A Module for Ramverk1Redovisning

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ylvarw/module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ylvarw/module/?branch=master)

__installation__

add to composer.json

```
"repositories": [{"type": "vcs", "url": "https://github.com/ylvarw/module"}]
"require": {"anax/module": "dev-main"}
```

install with `composer update`


```
#Add files to project
rsync -av vendor/anax/module/config ./
rsync -av vendor/anax/module/src ./
rsync -av vendor/anax/module/test ./
rsync -av vendor/anax/module/view ./
```

```
#Or move all folders at once
rsync -av vendor/anax/module/* ./

note that moving all at once will overwrite existing composer file

```
