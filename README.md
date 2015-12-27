# nginx-cache-hit-parser

Parse a nginx FastCGI cache hit log file.

## nginx config

This isn't verbatim - i assume you know what you're doing.

```nginx
log_format cache '$request_method $uri $sent_http_x_cache $bytes_sent $request_time';

fastcgi_cache_key "$scheme$request_method$host$request_uri";
fastcgi_cache_path /tmp/nginx levels=1:2 keys_zone=website:100m inactive=60m;

access_log /var/log/nginx/website.cache.txt cache buffer=128k;

add_header X-Cache $upstream_cache_status;

location ~ \.php$ {
	fastcgi_cache website;
	fastcgi_cache_valid 200 60m;
	fastcgi_cache_methods GET HEAD; # Only GET and HEAD methods apply

	#normal php stuff
	fastcgi_pass unix:/var/run/php-fpm/php-fpm.sock;
	fastcgi_index index.php;
	fastcgi_param SCRIPT_FILENAME /var/www/website$fastcgi_script_name;
	include fastcgi_params; 
}
```

## PHP usage example

```php
<?php
include('src' . DIRECTORY_SEPARATOR . 'fcgiCacheAnalyze.php');
echo "Website\n";
$c = new levidurfee\fcgiCacheAnalyze('sample' . DIRECTORY_SEPARATOR . 'website.cache.txt');
$c->analyze();
```