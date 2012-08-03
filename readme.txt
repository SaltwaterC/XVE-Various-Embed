=== Plugin Name ===
Contributors: SaltwaterC
Tags: xhtml, embed, flash, video, audio, image, swf, flv, flv player, jw player, flowplayer, youtube, metacafe, dailymotion, revver, spike, vimeo, livestream, capped.tv, trilulilu.ro, 220.ro, collegehumor, myvideo.de, snotr, gametrailers, blip.tv
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 1.0.4
License: GPL v3.0

XVE (XVE Various Embed) is a simple yet powerful way to add media content to your WordPress blog.

== Description ==

XVE (XVE Various Embed) is a simple yet powerful way to add media content to your WordPress blog. It is a drop-in replacement for my old XHTML Video Embed plug-in, while it aims to continue the original support.

The plug-in is self documented, so there's the point where you may want to start. The help is integrated into the WordPress help system. If you're looking for it, it's into the above menu, the 'Help' item. For some of you, this isn't so obvious as the Help system is kinda new.

New features and support requests are honored better if you open a [ticket on GitHub](https://github.com/SaltwaterC/XVE-Various-Embed "GitHub") where this plug-in is actually hosted.

Supported video services: youtube.com (youtu.be URLs as well), metacafe.com, dailymotion.com, revver.com, spike.com, vimeo.com, livestream.com, capped.tv, trilulilu.ro, 220.ro, collegehumor.com, myvideo.de, snotr.com, gametrailers.com, blip.tv

Supported audio services: trilulilu.ro, 220.ro

Supported image services: trilulilu.ro

It also supports generic SWF / FLV (MP4) embedding.

For the FLV (MP4) embedding, there are three provided players: Flowplayer, FLV Player, and JW Player. You may change them on the fly without the need to change the embed code.

== Installation ==

1. Add the xve-various-embed directory to /wp-content/plugins.
1. Enable it via the WordPress administration interface.
1. Start using it :).

== Changelog ==

- 1.0.4 - updates the Flow Player version to 3.2.12. Updates the JW Player version to 5.10.2295. This is a security update since JW Player 5.9.x is vulnerable. Enabled the embedding filter for post excerpts.
- 1.0.3 - adds support for blip.tv embedding
- 1.0.2 - adds support for YouTube modest branding (aka the player without the YouTube logo)
- 1.0.1 - fixes the Trilulilu embeds as the service changed the syntax without maintaining full backward compatibility
- 1.0 - plug-in rewrite from scratch

== Upgrade Notice ==

= 1.0.4 =
This version fixes a security related bug.  Upgrade immediately.
