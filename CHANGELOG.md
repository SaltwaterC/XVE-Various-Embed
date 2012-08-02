## Keys
 * # Breaks backward compatibility
 * ! Feature
 * % Bugfix
 * . Internal change

## Changelog

### v1.0.1

 * % Fixes the Trilulilu audio + image embedding. The service changed the embedding mode, breaking the backward compatibility with some of the new additions. Since one can't be sure that it works or not, the new syntax is now used by the plug-in. Thanks to @pauneugen for reporting.
 * . Added support for the new Trilulilu video embedding syntax as consequence to the above bug fix.

### v1.0

 * . Plug-in rewrite from scratch. Shares *some* of the concepts from the v0.3 branch of XHTML Video Embed, none of the code. Unlike the previous monolithic version, this plug-in is a collection of individual components, much easier to maintain. Adopted the OOP approach. Dropped support for legacy PHP versions as this version of XVE requires specifically PHP 5.2.0+.
 * . Instead of having n+m tags for n services, now the plug-in uses a much simpler syntax, based onto the file type. Want a YouTube video? use the [video] tag. Want a Trilulilu video? Use the [video] tag. Want a Trilulilu audio? Use the [audio] tag. Everything uses a single, consistent interface. Supported types: video, audio, image (for services proving flash embedding for images).
 * # Adopted the standard WordPress, GNU gettext, support for plug-in localization instead of my previous "in house" solution. It has some overhead when GNU gettext isn't available as native PHP extension, but it dramatically improves the translator's experience as there are tools like Poedit or other .po editors such as the Codestyling Localization plug-in. The localization made by me (Romanian) actually uses Codestyling Localization. I recommend this method for this task.
 * . Dropped the support for Jumpcut as the service doesn't exist anymore, therefore the plug-in used to produce useless output.
 * . Dropped the support for Veevo as the service doesn't exist anymore, therefore the plug-in used to produce useless output.
 * . Added support for "alternatives" support when a single domain requires more than one matching regular expression. To be avoided if possible.
 * #! Added support for Livestream which replaces Mogulus, but with different URL syntax since the old Mogulus embeds may not work anyway.
 * ! Support for the Capped.TV new URL syntax while preserving the legacy support. Added support for Capped.TV file quality selectors: high quality, medium quality, and low quality. The quality selector is used if it's present into the input URL.
 * ! Support for the Spike new URL syntax while preserving the legacy support.
 * ! Support for the GameTrailers new URL syntax while preserving the legacy support.
 * ! 220.ro support for video and audio.
 * ! Support for the Dailymotion new URL syntax while preserving the legacy support.
 * # Due to the inclusion of Hulu videos on MySpace, the MySpace support was dropped. This is not *my* bad will, but Hulu's retarded embedding format which is impossible to compute by knowing just the input URL. The same retardation was carried onto MySpace, therefore there's nothing more I can do. Use the generic [swf] from now on, the same as the rest of the unsupported services. However, this may be supported in the future via oEmbed.
 * ! youtu.be support. Now it's possible to use the YouTube short URLs as embedding URLs.
 * ! Support for legacy tags, aka the service tags of XHTML Video Embed. Although initially there were plans for removing this support, I decided it is best to support all the legacy support in order to not break the previous functionality while providing an upgrade path for the old XHTML Video Embed users.
 * ! Support for Flowplayer, FLV Player (the old XVE player), and JW Player. Defaults to Flowplayer. You may override the default player by using the player attrib of the flv tag by using the values: flowplayer, flvplayer, and jwplayer. It originates as developer feature in order to test the various implementations easier, but I found it to be useful in real usage scenarios as well.
 * # Dropped Google Video support since the service reached end of life.

