# php-m3u-editor

Use the code below as simple reference to build your own custom playlist from your xtream-codes server.

Change the $url and $port values with your main server domain and port values.

Use the code in the .htaccess file to setup pretty url.

Depending of how you name your php file, adjust in the above code the filename, change GetChannelsList to the filename you place in the php code.

If your apache server is configured to use mode rewrite, then you should not be worried.

The request will look like: http://domain.com/user/pass/hls/name.m3u8

PS: this is a basic version of custom playlist generator. Is fully functional, however improvements can be done. Let me know what you'd like to have in the future versions.
