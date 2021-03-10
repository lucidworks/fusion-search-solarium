# Solarium PHP Solr client library for Fusion

## What is Solarium?

Solarium is a PHP Solr client library that accurately model Solr concepts. Where many other Solr libraries only handle the communication with Solr, Solarium also relieves you of handling all the complex Solr query parameters using a well documented API.

Please see the [docs](http://solarium.readthedocs.io/en/stable/) for a more detailed description.

**Note:** This project is a fork of Solarium that adds support for authenticating all API requests to Fusion using JWT, used by Lucidworks Fusion.

Expected Configs:

| Config | Type   | Description  | Required |
|--------|--------|--------------|----------|
| scheme | string | The HTTP protocol to use for sending queries. | yes      |
| host   | string | The host name or IP of a Solr node, e.g. localhost or pg01.us-west1.cloud.lucidworks.com. | yes   |
| port   | string | The Jetty example server is at port 8983, while Tomcat uses 8080 by default.              | yes   |
| path   | string | The path that identifies the Solr instance to use on the node. | yes |
| core   | string | This is the collection if you're using it in the Solrcloud mode. | yes |
| jwt_token | string | This is the JWT token used to authenticate with the Fusion instance. | yes |
| query_profile | string | This is the query profile id for Fusion. | yes |

See [config.php](config.php) file for an example config.

Read more on how to authenticate with Solarium over [here](HOW.md).

## Requirements

Solarium only supports PHP 7.0 and up.

It's highly recommended to have Curl enabled in your PHP environment. However if you don't have Curl available you can
switch from using Curl (the default) to another client adapter. The other adapters don't support all the features of the
Curl adapter.

## Getting started

The preferred way to install Solarium is by using Composer. Solarium is available on Packagist.

Example:
```
composer require lucidworks/fusion-search-solarium
```

## Run the examples

To run the examples read through the _Example code_ section of
https://solarium.readthedocs.io/en/stable/getting-started/


## More information

* Docs
  http://solarium.readthedocs.io/en/stable/

* Issue tracker   
  http://github.com/solariumphp/solarium/issues

* Contributors    
  https://github.com/solariumphp/solarium/contributors

* License   
  See the COPYING file or view online:  
  https://github.com/solariumphp/solarium/blob/master/COPYING

## Continuous Integration status

* 4.x branch (master) [![Develop build status](https://secure.travis-ci.org/solariumphp/solarium.png?branch=master)](http://travis-ci.org/solariumphp/solarium?branch=master) [![Coverage Status](https://coveralls.io/repos/solariumphp/solarium/badge.png?branch=master)](https://coveralls.io/r/solariumphp/solarium?branch=master)
* 3.x branch [![Develop build status](https://secure.travis-ci.org/solariumphp/solarium.png?branch=3.x)](http://travis-ci.org/solariumphp/solarium?branch=3.x) [![Coverage Status](https://coveralls.io/repos/solariumphp/solarium/badge.png?branch=3.x)](https://coveralls.io/r/solariumphp/solarium?branch=3.x)
* [![SensioLabsInsight](https://insight.sensiolabs.com/projects/292e29f7-10a9-4685-b9ac-37925ebef9ae/small.png)](https://insight.sensiolabs.com/projects/292e29f7-10a9-4685-b9ac-37925ebef9ae)
* [![Total Downloads](https://poser.pugx.org/solarium/solarium/downloads.svg)](https://packagist.org/packages/solarium/solarium)

