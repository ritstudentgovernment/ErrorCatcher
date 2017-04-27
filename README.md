# ErrorCatcher
Custom 502 Error page with error catching capabilities.

## How to Install

1. Clone this repo.

2. Create a [Slack Webhook][1] in your desired channel.

3. Complete the `settings.json` file

4. In your NGINX configuration file, add the configuration at the bottom inside server{}.

   ​

   **IMPORTANT**, make sure that you have PHP installed and that PHP has read and write access to the file ``run.log`` (This file should be created in the ErrorCatcher directory)

   ​

NGINX configuration:
```javascript
error_page  500 502 503 504 /ErrorCatcher/custom_50x.html;
error_page  405     =200 $uri;
	
location ~ "/ErrorCatcher" {
  fastcgi_cache  off;
  root /usr/share/nginx/html/;
}

error_page 404 /404.html;
    
location ~ \.php$ {
  root           /usr/share/nginx/html/ErrorCatcher;
  try_files $uri =404;
  fastcgi_pass   127.0.0.1:9000;
  fastcgi_index  index.php;
  fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
  include        fastcgi_params;
}
```


[1]:	https://api.slack.com/incoming-webhooks
