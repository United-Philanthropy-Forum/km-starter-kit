# KM Starter Kit

This is the minimalist wrapper around the bulk of the KM Collaborative work done at https://github.com/United-Philanthropy-Forum/km-collaborative

This code should only need to be referenced when you spin up a new Forum site.

### Requirements:

Building this project successfully requires a few things:

1. The ability to push code to github, specifically, [this repo](https://github.com/United-Philanthropy-Forum/km-collaborative)

   Make sure you’ve [added an SSH key to your profile on github](https://www.inmotionhosting.com/support/website/git/how-to-add-ssh-keys-to-your-github-account/), and that you are a collaborator or team member with Write permissions on [the KM Collaborative repo](https://github.com/United-Philanthropy-Forum/km-collaborative).

   This is working when you can visit the [repo home page](https://github.com/United-Philanthropy-Forum/km-collaborative), and see a little pencil in the top-right corner of the README.md file. That means you can edit that file.

   **If you don't have access**, one of the [United-Philanthropy-Forum owners](https://github.com/orgs/United-Philanthropy-Forum/people) will need to invite you.

2. The ability to create a new repository in the United Philanthropy Forum namespace.
   You’ll know this is working when you can visit this url without error: https://github.com/organizations/United-Philanthropy-Forum/repositories/new

   **If you don't have access**, one of the [United-Philanthropy-Forum owners](https://github.com/orgs/United-Philanthropy-Forum/people) will need to invite you.

3. Access to Pantheon.
   You'll know this is working when you can go to [Create a new site in Pantheon](https://dashboard.pantheon.io/sites/create) and be able to choose United Philanthropy Forum from the dropdown.

   **If you don't have access**, one of the [United Philanthropy Forum Administrators](https://dashboard.pantheon.io/organizations/e8f1697b-fb5c-497c-88f1-5b8eaa98f48e#people) will need to invite you.

4. Access to [the United Philanthropy Forum CircleCI instance](https://circleci.com/gh/United-Philanthropy-Forum). You'll know this is working when you can visit that url.

   **If you don't have access**, you might need to authenticate Circle -- you can log in with Github.

5. [Composer > 2.0.0](https://getcomposer.org/) Globally available. You'll know this is working when you can type `composer --version` into your console and see something like "Composer version 2.1.6 2021-08-19 17:11:08"

6. [Terminus > 2.0](https://pantheon.io/docs/terminus/install). You'll know this is working when you can type `terminus --version` into your console and see something like `Terminus 2.3.0`

7. [The Pantheon Build tools](https://github.com/pantheon-systems/terminus-build-tools-plugin/#installation). You'll know this is working when you can type `terminus build:project:create -h` into your console and see information about the build:project:create command, like this:

   ```yaml
    Usage:
      build:project:create [options] [--] <source> [<target>]
    ...
    ```
8. You have run the [One time setup steps](https://github.com/United-Philanthropy-Forum/km-starter-kit/wiki/How-to-test-changes-to-this-starter-kit#one-time)

### Usage:

Choose a new project name

To start a new project:
- decide on a new project name -- it should be a url-safe string, so letters, dashes, and numbers
- confirm which Pantheon "Team" to build the site under (This is a unique name string, but it can include spaces -- visible in Pantheon under "Team")
- confirm which Github Organization the development repository will live under (this is also a URL-safe string, visible in github)

For example, to create a site with the project for the ThinkShout Foundation:
Project name: thinkshout-foundation
Pantheon Team: United Philanthropy Forum
Github Org: United-Philanthropy-Forum

Be prepared for this command to take 30 minutes. That means making sure your computer doesn't go to sleep in that time. If you're experiencing timeouts, you might try adding a ["ServerAliveInterval"](https://unix.stackexchange.com/a/2013) to keep Pantheon connected to your machine during install.

You would run this command:

```
terminus build:project:create --team='United Philanthropy Forum' --org='United-Philanthropy-Forum' --visibility='private' united-philanthropy-forum/km-starter-kit thinkshout-foundation
```

The first time running this command, you will be asked to provide some API keys on Circle and Pantheon. Each step provides
links and instructions on doing that. You will also be asked to set a User 1 password for the new site. (If the password request keeps repeating, the system is rejecting your password as insufficiently secure. Choose something more complex.)

This will create a new repository in the United Philanthropy Forum github repo, as well as a new Pantheon site:

https://github.com/United-Philanthropy-Forum/thinkshout-foundation

https://dev-thinkshout-foundation.pantheonsite.io

The Pantheon site should also have the km_collaborative profile installed.

### What to do if the build:project command fails:

If the `build:project:create` command fails when running `composer create-project` with `Fatal error: Allowed memory size ... exhausted`, edit your php configuration and raise the memory limit.

If the command fails because of a composer conflict, you can try to debug this by running the simpler build command locally:

```yaml
composer create-project united-philanthropy-forum/km-starter-kit thinkshout-foundation
```

If that fails as well, this repo needs to be updated.

If the build:project command fails for some reason, part of the skeleton for the new site might already exist. If it does, delete both the Pantheon environment and the github repo created, if either exist.

There is a lot of information about the build tools, which might help with debugging, in [The Pantheon Build tools README](https://github.com/pantheon-systems/terminus-build-tools-plugin). Pantheon also provides [thorough documentation](https://pantheon.io/docs/guides/build-tools) on the full scope of their build tools.

### How to delete a project made with this starter kit.

[The Pantheon Build tools](https://github.com/pantheon-systems/terminus-build-tools-plugin) provides an [build:env:obliterate](https://github.com/pantheon-systems/terminus-build-tools-plugin#buildenvobliterate) command to delete a site that was spun up using the `build:project:create` command. It will delete both the Pantheon site and the repo, so any changes you've made either place will be lost forever. Example:

```
terminus build:env:obliterate thinkshout-foundation
```

### Maintaining this project

There are minimal files in this project, as it's meant to solely ease the handoff between [The Pantheon Build tools](https://github.com/pantheon-systems/terminus-build-tools-plugin) and the
[KM Collaboration profile](https://github.com/United-Philanthropy-Forum/km-collaborative). So when an upstream change happens in the [the D8 pantheon drop](https://github.com/pantheon-systems/example-drops-8-composer), the following update rules can be used to update this repo as well:

#### .gitignore

This code belongs in this project only. It should only need to be updated if you need to add another file to this repo.

#### README.md

This code belongs in this project only. It should only need to be updated if changes are made to the process or requirements.

#### composer.json

This code was largely taken from [the D8 pantheon drop](https://github.com/pantheon-systems/example-drops-8-composer), but has been customized to the point where it is too different to be worth parsing.

#### scripts/composer/ScriptHandler.php

This is a direct copy of the same file in [the D8 pantheon drop](https://github.com/pantheon-systems/example-drops-8-composer) and will be overwritten by upstream changes on in the [km-collaborative profile](https://github.com/United-Philanthropy-Forum/km-collaborative). This file needs to exist in this repo for the terminus build command to succeed, and it can be pulled from the drop to this repo directly at any time.

#### scripts/composer/ScriptUpdater.php

This code lives in this repository and is maintained in the [km-collaborative profile](https://github.com/United-Philanthropy-Forum/km-collaborative). It is very much like the [drupal scaffolding](https://github.com/drupal/core-composer-scaffold) functionality in that it pulls files from another repo directly and overwrites them on composer install. Unlike the drupal-scaffold plugin, though, this script does not require you to declare every file you wish to pull from the child package to the site package.
