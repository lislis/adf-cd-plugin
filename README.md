# ADF-CD the Wordpress Plugin

Use git to clone this repo or download the zip and upload it to your Wordpress instance.

This plugin just includes the scripts and styles build by https://github.com/lislis/adf-cd and offers a shortcode to easily place it on your website.

Shortcode looks like this:

```
[adf_cd api_url="http://localhost:3000/api" container_class="fooobarbaz"]

```

Where `api_url` is the url to the server of https://github.com/lislis/adf-cd, so yes, this plugin does not provide the server, it just serves the client.

`container_class` lets you add a custom class to the container div which you can then use to write styles in your theme.
