Module
============================

A Module for Ramverk1Redovisning

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ylvarw/module/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ylvarw/module/?branch=master)

__installation__

add to composer.json

```
<!-- "repositories": [{"type": "vcs", "url": "https://github.com/ylvarw/module"}] -->
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
