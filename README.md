# Structure URL Updater

Structure is an add-on for ExpressionEngine that very few sites (if any) can afford to live without. It makes it easy for developers *and* clients to manage the sitemap and navigation, and it can be a challenge to work with at times because it stores site URLs in a serialized, base64-encoded array in the database.

This is a quick tool I made to work with that URL array in the event that you'd like to convert Structure URLs to use dashes ("-") instead of underscores ("_"). The script won't complain (or do anything) if you feed it invalid input, and it's only designed to be used for a single site. But this is GitHub, so have at it if you'd like to improve anything!

# Instructions

Run index.php in a PHP5 environment somewhere, paste the contents of your site_pages field, and submit the form. You'll get a new hash, the ability to see what changed, a MySQL INSERT statement, and a copy of the original hash just in case you forgot to back up and bombed your site. 