# KM Starter Kit

This is the minimalist wrapper around the bulk of the KM Collaborative work done at https://github.com/United-Philanthropy-Forum/km-collaborative

This code should only need to be referenced when you spin up a new Forum site.

### Requirements:

Building this project successfully requires a few things:

1. The ability to push code to github, specifically, this repo: https://github.com/United-Philanthropy-Forum/km-collaborative
   
    Make sure you’ve added an SSH key to your profile on github, and that you are a collaborator or team member with Write permissions on the KM Collaborative repo.

    This is working when you can visit the repo link above, and typing `git clone git@github.com:United-Philanthropy-Forum/km-collaborative.git` you see a result like “Cloning into 'km-collaborative'...”

2. The ability to create a new repository in the United Philanthropy Forum namespace.
   You’ll know this is working when you can visit this url without error: https://github.com/organizations/United-Philanthropy-Forum/repositories/new

3. Access to Pantheon

4. Access to the United Philanthropy Forum CircleCI instance

5. Terminus

6. The Pantheon Build tools https://github.com/pantheon-systems/terminus-build-tools-plugin/#installation

### Usage:

Choose a new project name

To start a new project, run:

```
terminus build:project:create --team='ThinkShout' --org='United-Philanthropy-Forum' --visibility='private' united-philanthropy-forum/km-starter-kit:^0.4.0 [new-project-name]
```

This will create a new repository in the United Philanthropy Forum github repo, as well as a new Pantheon site:

https://github.com/United-Philanthropy-Forum/`[new-project-name]`

dev-`[new-project-name]`.pantheonsite.io

The Pantheon site should also have the km_collaborative profile installed.

### What to do if the build:project command fails:

If the build:project command fails for some reason, part of the skeleton for the new site might already exist. If it does, delete both the Pantheon environment and the github repo created, if either exist.

There is a lot of information about the build tools, which might help with debugging, in the Build Tools Plugin README here: 
https://github.com/pantheon-systems/terminus-build-tools-plugin

### Maintaining this project

There are minimal files in this project, as it's meant to solely ease the handoff between Pantheon's build tools and the
KM Collaboration profile. So when an upstream change happens in the https://github.com/pantheon-systems/example-drops-8-composer project, the following update strategy can be used:

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

* The option to allow upstream modules to apply patches was enabled via the "enable-patching" section. This way, united-philanthropy-forum/km_collaborative can be responsible for things like drupal core patches.

* The patchLevel was set to -p2 for the drupal/core package, which keeps a rouge "b" folder from showing up in your web/core folder in cases
where the patch doesn't apply cleanly.

#### scripts/composer/ScriptHandler.php

This is a direct copy of the same file in https://github.com/pantheon-systems/example-drops-8-composer and can be overwritten by upstream
changes at any time.

#### scripts/composer/ScriptUpdater.php

This code lives in this repository and is maintained here. It helps projects built with this repo continue to get the upstream changes from
https://github.com/pantheon-systems/example-drops-8-composer
