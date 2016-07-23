# [Wordpress](http://wordpress.org) Command Line Installer

This is a command line downloader for Wordpress that downloads and extracts the latest version of Wordpress to the directory of your choosing.

## How To Use

**Prerequisites:**

- Composer (Local or global)

**First**, download the Wordpress downloader using Composer:

```composer global require "rappasoft/wordpress-command-line-downloader"```

Make sure to place the ```~/.composer/vendor/bin``` directory (or the equivalent directory for your OS) in your PATH so the ```wordpress``` executable can be located by your system.

Once installed, the ```wordpress new``` command will create a fresh Wordpress installation in the directory you specify.

If you leave the directory out it will install in the current working directory.

For example:

```wordpress new mywebsite```

Will install in a new folder called ```mywebsite``` using the current working directory as the base.