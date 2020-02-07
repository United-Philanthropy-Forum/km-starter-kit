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

5. [Composer](https://getcomposer.org/) Globally available. You'll know this is working when you can type `composer --version` into your console and see something like "Composer version 1.8.5 2019-04-09 17:46:47"

6. [Terminus > 2.0](https://pantheon.io/docs/terminus/install). You'll know this is working when you can type `terminus --version` into your console and see something like `Terminus 2.3.0`

7. [The Pantheon Build tools](https://github.com/pantheon-systems/terminus-build-tools-plugin/#installation). You'll know this is working when you can type `terminus build:project:create -h` into your console and see information about the build:project:create command, like this:

   ```yaml
    Usage:
      build:project:create [options] [--] <source> [<target>]
    ...
    ```


### Usage:

Choose a new project name

To start a new project, decide on a new project name. It should be a url-safe string, so letters, dashes, and numbers:

```
terminus build:project:create --team='United Philanthropy Forum' --org='United-Philanthropy-Forum' --visibility='private' united-philanthropy-forum/km-starter-kit:^0.5.0 [new-project-name]
```

This will create a new repository in the United Philanthropy Forum github repo, as well as a new Pantheon site:

https://github.com/United-Philanthropy-Forum/`[new-project-name]`

dev-`[new-project-name]`.pantheonsite.io

The Pantheon site should also have the km_collaborative profile installed.

### What to do if the build:project command fails:

If the build:project command fails for some reason, part of the skeleton for the new site might already exist. If it does, delete both the Pantheon environment and the github repo created, if either exist.

There is a lot of information about the build tools, which might help with debugging, in [The Pantheon Build tools README](https://github.com/pantheon-systems/terminus-build-tools-plugin)

### How to delete a project made with this starter kit.

[The Pantheon Build tools](https://github.com/pantheon-systems/terminus-build-tools-plugin) provides an [build:env:obliterate](https://github.com/pantheon-systems/terminus-build-tools-plugin#buildenvobliterate) command to delete a site that was spun up using the `build:project:create` command. It will delete both the Pantheon site and the repo, so any changes you've made either place will be lost forever.
 
### Maintaining this project

There are minimal files in this project, as it's meant to solely ease the handoff between [The Pantheon Build tools](https://github.com/pantheon-systems/terminus-build-tools-plugin) and the
[KM Collaboration profile](https://github.com/United-Philanthropy-Forum/km-collaborative). So when an upstream change happens in the [the D8 pantheon drop](https://github.com/pantheon-systems/example-drops-8-composer), the following update rules can be used to update this repo as well:

#### .gitignore

This code belongs in this project only. It should only need to be updated if you need to add another file to this repo.

#### README.md

This code belongs in this project only. It should only need to be updated if changes are made to the process or requirements.

#### composer.json

This code was largely taken from the example drops repo, but was also largely customized. The customizations were:

* "name", "description", and "homepage" where altered.

* The "km_collaborative" repository was added to the "repositories" section.

* The "require" section was stripped down to just:

```yaml
    "php": ">=7.0.8",
    "pantheon-systems/example-drops-8-composer": "^2.3",
    "united-philanthropy-forum/km_collaborative": "dev-master"
```

* The "scripts/composer/ScriptUpdater.php" autoloader file was added, and the "DrupalProject\\composer\\ScriptUpdater::createParentFiles"
command was added post install, update, and build.

* The "km-collab-scaffold" was added to the "extras" section. These are configurations passed to the "scripts/composer/ScriptUpdater.php" script.

* The option to allow upstream modules to apply patches was enabled via the "enable-patching" section. This way, the [KM Collaboration profile](https://github.com/United-Philanthropy-Forum/km-collaborative) can be responsible for things like drupal core patches.

* The patchLevel was set to -p2 for the drupal/core package, which keeps a rouge "b" folder from showing up in your web/core folder in cases
where the patch doesn't apply cleanly.

#### scripts/composer/ScriptHandler.php

This is a direct copy of the same file in [the D8 pantheon drop](https://github.com/pantheon-systems/example-drops-8-composer) and can be overwritten by upstream
changes at any time.

#### scripts/composer/ScriptUpdater.php

This code lives in this repository and is maintained here. It helps projects built with this repo continue to get the upstream changes from
[the D8 pantheon drop](https://github.com/pantheon-systems/example-drops-8-composer)
