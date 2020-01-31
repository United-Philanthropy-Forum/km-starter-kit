# KM Starter Kit

This is the minimalist wrapper around the bulk of the KM Collaborative work done at https://github.com/United-Philanthropy-Forum/km-collaborative

This code should only need to be referenced when you spin up a new Forum site.

### Usage:

Choose a new project name

To start a new repository, run:

```
composer create-project united-philanthropy-forum/km-starter-kit new-project-name --repository="{\"url\": \"https://github.com/United-Philanthropy-Forum/km-starter-kit\", \"type\": \"git\"}" --remove-vcs --stability=dev
```

Enter the new site folder:

```
cd new-project-name
```

Remove the part of your `.gitignore` file that ignores your lock file by deleting this line:

```
# Gitignore for the starter kit.
*
!.gitignore
!README.md
!composer.json
```

Initialize a repository on github https://github.com/new that matches your project name and connect your local directory to it:

```
git init
git add .
git commit -m "Initial commit."
git remote add origin git@github.com:United-Philanthropy-Forum/new-project-name.git
git push -u origin master
```

Delete the contents of this README.md above this line.

---

# New Project Name (TODO, update this)

### Initial build (existing repo)

From within your `~/Sites` directory run:

```
git clone git@github.com:United-Philanthropy-Forum/new-project-name.git
cd new-project-name
composer install
```

### Building

Running the `robo configure` command will read the .env.dist, cli arguments and
your local environment (`DEFAULT_PRESSFLOW_SETTINGS`) to generate a .env file. This file will be used to set
the database and other standard configuration options. If no database name is provided, the project name and the git branch name will be used. If no database name is provided, the project name and the git branch name will be used. Note the argument to pass to robo configure can include: --db-pass; --db-user; --db-name; --db-host.

```
robo configure
# Use an alternate DB password
robo configure --db-pass=<YOUR LOCAL DATABASE PASSWORD>
# Use an alternate DB name
robo configure --db-name=<YOUR DATABASE NAME>
```

The structure of `DEFAULT_PRESSFLOW_SETTINGS` if you want to set it locally is:

```
DEFAULT_PRESSFLOW_SETTINGS_={"databases":{"default":{"default":{"driver":"mysql","prefix":"","database":"","username":"root","password":"root","host":"localhost","port":3306}}},"conf":{"pressflow_smart_start":true,"pantheon_binding":null,"pantheon_site_uuid":null,"pantheon_environment":"local","pantheon_tier":"local","pantheon_index_host":"localhost","pantheon_index_port":8983,"redis_client_host":"localhost","redis_client_port":6379,"redis_client_password":"","file_public_path":"sites\/default\/files","file_private_path":"sites\/default\/files\/private","file_directory_path":"site\/default\/files","file_temporary_path":"\/tmp","file_directory_temp":"\/tmp","css_gzip_compression":false,"js_gzip_compression":false,"page_compression":false},"hash_salt":"","config_directory_name":"sites\/default\/config","drupal_hash_salt":""}
```

### Configure Drush

Drush options can be configured in the `.env` file. For example, to set a default uri for commands like `drush uli`, add this:

```
DRUSH_OPTIONS_URI="https://web.new-project-name.localhost"
```

[Drush configuration docs](https://github.com/drush-ops/drush/blob/master/docs/using-drush-configuration.md)

### Installing

Running the robo install command will run composer install to add all required
dependencies and then install the site and import the exported configuration.

```
robo install
```

### Testing

Test are run automatically on CircleCI, but can be run locally as well with:

```
robo test
```

For more information refer to the `behat/README.md` file.

## Updating contributed code

### Updating contrib modules

With `composer require drupal/{module_name}` you can download new dependencies to your
installation.

```
composer require drupal/devel:8.*
```

### Applying patches to contrib modules

If you need to apply patches (depending on the project being modified, a pull
request is often a better solution), you can do so with the
[composer-patches](https://github.com/cweagans/composer-patches) plugin.

To add a patch to drupal module "foobar" insert the patches section in the `extra`
section of composer.json:
```json
"extra": {
    "patches": {
        "drupal/foobar": {
            "Patch description": "URL to patch"
        }
    }
}
```

### Updating Drupal Core

This project will attempt to keep all of your Drupal Core files up-to-date; the
project [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold)
is used to ensure that your scaffold files are updated every time drupal/core is
updated. If you customize any of the "scaffolding" files (commonly .htaccess),
you may need to merge conflicts if any of your modified files are updated in a
new release of Drupal core.

Follow the steps below to update your core files.

1. Run `composer update drupal/core --with-dependencies` to update Drupal Core and its dependencies.
1. Run `git diff` to determine if any of the scaffolding files have changed.
   Review the files for any changes and restore any customizations to
  `.htaccess` or `robots.txt`.
1. Commit everything all together in a single commit, so `web` will remain in
   sync with the `core` when checking out branches or running `git bisect`.
1. In the event that there are non-trivial conflicts in step 2, you may wish
   to perform these steps on a branch, and use `git merge` to combine the
   updated core files with your customized files. This facilitates the use
   of a [three-way merge tool such as kdiff3](http://www.gitshah.com/2010/12/how-to-setup-kdiff-as-diff-tool-for-git.html). This setup is not necessary if your changes are simple;
   keeping all of your modifications at the beginning or end of the file is a
   good strategy to keep merges easy.
