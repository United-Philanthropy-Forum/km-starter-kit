<?php

/**
 * @file
 * Contains \DrupalProject\composer\ScriptUpdater.
 */

namespace DrupalProject\composer;

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class ScriptUpdater
{
  /**
   * Updates the files in the root of this project to match the drops version.
   *
   * @param \Composer\Script\Event $event
   *  The event.
   */
  public static function createParentFiles(Event $event)
  {
    $fs = new Filesystem();
    $finder = new Finder();
    $root = getcwd();
    $drops_file = '/web/profiles/contrib/km_collaborative/assets';
    $ignored_files = $event->getComposer()->getPackage()->getExtra() + ['km-collab-scaffold' => [ 'excludes' => []]];
    $pantheon_install = $root . $drops_file;
    $event_name = $event->getName();

    if ($fs->exists($pantheon_install) && isset($ignored_files['km-collab-scaffold']['excludes'][$event_name])) {
      $iterator = $finder->files()->in($pantheon_install)->ignoreDotFiles(FALSE);

      foreach ($iterator as $file) {
        if (!in_array($file->getRelativePathname(), $ignored_files['km-collab-scaffold']['excludes'][$event_name])) {
          $vendor_path = $file->getPathname();
          $destination = str_replace($drops_file, '', $vendor_path);
          $fs->copy($vendor_path, $destination, TRUE);
        }
      }
    }
  }
}
