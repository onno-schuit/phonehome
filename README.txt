This block requires the jQuery plugin version 1.7.2. This plugin is standard not included in this block, because most sites have their own include already.

The block Phonehome is standard off, because of all the data it creates. To put the block on, add or change the $CFG->phonehome in config.php to true;

The Phonehome block sends every period (default 60 seconds) an update to the database in which course the user is, so the time a user takes in a course can be tracked.

In the global configuration file, config.php, the period can be changed.
Add or change the variable $CFG->phonehome_timer and give it the preferred value (in seconds);