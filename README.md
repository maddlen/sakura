# Sakura

> Heroku toolbox for Laravel.

## Features

- Initialize everything to host a Laravel project on Heroku
- Provides helpful artisan commands

## Setup

### Go to your project root dir
`cd /path/to/root/dir`

### Install the Heroku CLI
If the Heroku CLI is not installed on your system, please install it.
See https://devcenter.heroku.com/articles/heroku-cli

### Login to Heroku
`heroku login`

### Create an Heroku Authorization
`heroku authorizations:create`

The response should look like that:
```
Creating OAuth Authorization... done
Client:      <none>
ID:          a6e98151-f242-4592-b107-25fbac5ab410
Description: getting started token
Scope:       global
Token:       cf0e05d9-4eca-4948-a012-b91fe9704bab
Updated at:  Fri Jun 01 2018 13:26:56 GMT-0700 (PDT) (less than a minute ago)
```

### Update your .env file
Use the Token value from the Heroku Authorization response and add it to your `.env` file in the `HEROKU_API_KEY` variable.
Ex:
```
// .env
HEROKU_API_KEY=cf0e05d9-4eca-4948-a012-b91fe9704bab
```

### Install Sakura

Require the package:

`composer require maddlen/sakura:dev-master`

Run the `sakura:init` Artisan command:

`php artisan sakura:init`

## Artisan commands

### init • `sakura:init`

Sets up the Heroku environment.

### push-config-vars • `sakura:push-config-vars`

Push `.env.heroku` as Heroku's Config Vars.
