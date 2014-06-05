=== Clicky by Yoast ===
Contributors: joostdevalk
Donate link: http://yoast.com/donate/
Tags: analytics, statistics, clicky, getclicky, affiliate, outbound links, analysis, Joost de Valk, Yoast
Requires at least: 2.8
Tested up to: 3.5
Stable tag: 1.4.2.3

Integrates the Clicky (from getClicky.com) web analytics service into your blog.

== Description ==

Integrates the [Clicky web analytics](http://getclicky.com/145844) service into your blog.

* Automatically adding your Clicky (from getClicky.com) tracking code everywhere.
* Option to ignore admins.
* Option to store names of commenters.
* Option to disable the use of cookies.
* Stores comments as an action using the getClicky [internal data logging API](https://secure.getclicky.com/help/customization/manual#internal). This requires a [pro account](http://getclicky.com/145844) to work.
* Option to track posts &amp; pages as goals and assign a revenue to that page or post.
* An overview of your site's statistics on your dashboard.
* Easily add outbound link pattern matching for affiliate links etc.
* Adds a small stats indicator of visitors in the last 48 to the WordPress toolbar.

Read the authors [review of Clicky Analytics](http://yoast.com/clicky-analytics-review/) if you want to see a bit more of the cool integration this plugin provides.

== Installation ==

1. Upload the `clicky` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Enter your Site ID, Key and Admin Key.
1. You're done, getClicky should start working.

== Screenshots ==

1. The Clicky WordPress plugin settings panel.
2. The Clicky metabox on posts and pages.
3. The stats indicator on the WordPress Toolbar.

== Changelog ==

= 1.4.2.3 =

* Don't overwrite the `clicky_custom` variable when it's already there.
* Added phpDoc
* Use https instead of http for showing stats page
* The <noscript>-part now uses // instead of http:// so it can switch to https.
* Added Turkish (tr_TK)

= 1.4.2.2 =

* Prevent collission with utm username param.

= 1.4.2.1 =

* Fixed a few notices.
* Fixed a possible crash due to not having imagemagick compiled in.
* Added a whole bunch of translations.

= 1.4.2 =

* Option to disable the use of cookies.
* Fix some notices.

= 1.4.1.3 =

* Fix for another "possible" error.

= 1.4.1.2 =

* Fixed divide by zero on site with empty stats.
* Removed a no longer used hook.

= 1.4.1.1 =

* Removed a ) too much. I suck at coding, sometimes.

= 1.4.1 =

* Forgot to remove a piece of code that's no longer used.

= 1.4 =

* Interface cleanup, interface no longer breaks on smaller resolutions. 
* No more unneeded JavaScript being loaded on the admin pages.
* Made the Goal Tracking box work for all post types and made it smaller.
* Removed some code that was no longer used.
* Removed dashboard widget, added Yoast news widget to settings page.
* Added a small stats indicator of visitors in the last 48 to the WordPress toolbar.

= 1.3 =

* Added support for the new [outbound link pattern matching](http://getclicky.com/blog/287/custom-outbound-link-pattern-matching-and-iframe-tracking).

= 1.2.3 =

* No longer track preview pages.
* Made the tracking code a bit simpler.

= 1.2.2 =

* Fixed error in pointing the script to in.getclicky.com instead of static.getclicky.com.

= 1.2.1 =

* Made the admin class load conditionally instead of always.
* Added donation button.
* Updated documentation.

= 1.2 =

* Update to work with the new CDN per [this post](http://getclicky.com/blog/264/important-were-moving-to-a-real-cdn-soon-depending-on-how-youve-set-up-tracking-you-may-need-to-take-action). 
* Remove clicky.me integration that was no longer working anyway due to Twitter API changes.

= 1.1.5 =

* Tiny improvement in error handling to prevent "Cannot use object of type WP_Error as array" error.

= 1.1.4 =

* Minor backend improvements.

= 1.1.3 =

* Fixed bug that would cause tracking not to work if commenter name tracking was not enabled.

= 1.1.2 =

* Another tiny bugfix on the js outputted.

= 1.1.1 =

* Removed tracking of category and author due to complaints. We'll see later if there's a way to add it back in more wisely.

= 1.1 =

* Switched to the new asynchronous javascript.
* Added tracking of category and author as custom variables.
* Fixed the bug that caused tweeting of updated posts.
* Some slight updates to the backend.

= 1.0.6 =

* Auto-tweeting now only happens when a post is first published. 
* Made sure there are no spaces in site ID, site key and admin site key are always trimmed.
* Added extra check to make sure clicky.me returned a valid short URL before tweeting.

= 1.0.5 =

* Minor copy changes.

= 1.0.4 =

* Made sure there's no spaces in the Site ID when displaying it, should solve blank Dashboard Stats Page issue.

= 1.0.3 =

* Made all strings localizable (is that even a word).
* Added .pot file to allow localization.
* Added a Dutch translation.

= 1.0.2 =

* Added option to auto tweet articles, removing the checkbox from the add post screen. This makes sure auto tweet works when you're posting from within an external editor.

= 1.0.1 =

* Added prefix option for Tweets that are sent out on publish.

= 1.0 =

* Initial release.