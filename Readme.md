Mumble Viewer
=============

Requirements
------------

+ a Mumble server (obviously)
+ [GT Murmur Plugin](http://www.gametracker.com/downloads/gtmurmurplugin.php) (other [CVP Providers](http://mumble.sourceforge.net/Channel_Viewer_Protocol) are not tested)
+ a webserver running PHP

Acknowledgements
----------------

I am using Edmundas Kondrašovas' [Mumble Query](https://github.com/edmundask/MurmurQuery) for the PHP-CVP interface. Without it my work would have been a lot harder.

Installation
------------

Copy the files to your webserver and adjust the `data.php` for your Mumble server's CVP address. You might want to change the branding in the index.htm as well (TODO: maybe someone wants to commit a patch to remove the branding and make this more generic)

Licensing
----------

I consider all the code public domain if not otherwise stated. Do not use the ggaming.de domain, name and/or logo. I would appreciate a hint if you successfully are using this.