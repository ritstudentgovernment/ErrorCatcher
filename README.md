# ErrorCatcher
Custom 502 Error page with error catching capabilities.

## How to Install

1. Clone this repo.
2. Create a [Slack Webhook][1]in your desired channel.
3. Complete the `settings.json` file
4. In your NGINX configuration file, add the configuration at the bottom inside server{}.

NGINX configuration:
```javascript
error_page  500 502 503 504 /ErrorCatcher/custom_50x.html;
error_page  405     =200 $uri;
location  "/ErrorCatcher" {
 root /usr/share/nginx/html/;
}
```


[1]:	https://api.slack.com/incoming-webhooks
