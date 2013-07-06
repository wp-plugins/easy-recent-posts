=== Plugin Name ===
Contributors: christopherross
Plugin URI: http://thisismyurl.com/plugins/easy-recent-posts/
Tags: recent posts, best, post-plugins, recent, posts,comments, most recent, sidebar, widget, theme, php, code, plugin, post, posts
Donate link:  http://thisismyurl.com/
Requires at least: 3.0.0
Tested up to: 3.5.1
Stable tag: 2.1.2

An easy to use WordPress function to <a href='http://thisismyurl.com/plugins/easy-recent-posts/'>add recent posts to any WordPress theme</a>.

== Description ==

An easy to use WordPress function to <a href='http://thisismyurl.com/plugins/easy-recent-posts/'>add recent posts to any WordPress theme</a>.

You can also include the the list in a post using a shortcode [thisismyurl_easy_recent_posts] or as a widget.

This plugin is maintained by Christopher Ross, http://thisismyurl.com or you can find him on Twitter at http://twitter.com/thisismyurl/


== Installation ==

To install the plugin, please upload the folder to your plugins folder and active the plugin.

== Screenshots ==

1. Screenshot of Widget

== Updates ==
Updates to the plugin will be posted here, to [Christopher Ross]
(http://thisismyurl.com)

== Frequently Asked Questions ==

= How do I display the results in my PHP code? =

&lt;?php thisismyurl_easy_recent_posts(); ?&gt;

= How do I display the results in my posts? =

Include the shortcode [thisismyurl_easy_recent_posts] in any post or page.

= How do I include the results as a widget? =

On your Widgets page, simply drag and drop the widget to your sidebar!

=General results=
Without passing any parameters, the plugin will return ten results or fewer depending on how many posts you have.

&lt;?php thisismyurl_easy_recent_posts(); ?&gt;

=Specific number of results=
If you would like to return a specific number of results as your maximum:

&lt;?php thisismyurl_easy_recent_posts('count=10'); ?&gt;

=Altering the before and after values=<
By default the plugin wraps your code in list item (&lt;li&gt;) tags but you can specify how to format the results using the following code:

&lt;?php thisismyurl_easy_recent_posts('before=&lt;p&gt;&amp;after=&lt;/p&gt;'); ?&gt;


=The Order=<
You can now change the order of the results using ASC, DESC or RAND to return the results in ascending, descending or random order.

&lt;?php thisismyurl_easy_recent_posts('order=ASC'); ?&gt;


=Echo vs. Return=
Finally, if you'd like to copy the results into a variable you can return the results as follows:

&lt;?php thisismyurl_easy_recent_posts('show=false'); ?&gt;

=Combining Arguements=

If you'd like to call multiple arguments you can do so by separating them with a & symbol:

&lt;?php thisismyurl_easy_recent_posts('show=false&order=ASC'); ?&gt;


== Donations ==
If you would like to donate to help support future development of this tool, please visit [Christopher Ross]
(http://thisismyurl.com/)


== Change Log ==

= 2.1.2 =

* Added optional credit link in widget

= 2.0.1 = 

* Code migrate from Easy Popular Posts
