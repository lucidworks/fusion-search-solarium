## Authenticate with the Solarium Library


OAuth2 authentication servers provide an authentication service to Managed Search. Each Managed Search REST API call must include an `Authorization` header that contains a valid OAuth2 access token.

This topic describes how to use the Lucidworks Managed Search Solarium client library to authenticate apps.

The OAuth2 access token implementation in the Solarium client library simplifies the process of obtaining, using and refreshing access tokens.

### Use the Solarium Library

```composer install lucidworks/solarium```

**TODO:** publish the package

If you're cloning the repo itself to try out the examples, make sure to run:

```composer install```

and ensure that `.access_token` and `.background_process_id` files are writable.

### Configure OAuth2 config parameters

Provide the `oauth2_client_id` and `oauth2_client_secret` parameters as a [config](config.php) to the Solarium client instantiation.

This config file is used by all the examples. For instance, you can try the:

- [examples/1.1-check-solarium-and-ping.php](examples/1.1-check-solarium-and-ping.php) which makes a ping request.

You can try any of the other examples as well.

**Note**: You will need to have a HTTP Server (like Apache2) configured to your project's root directory to run the PHP examples.


### Client Workflow

![](https://i.imgur.com/nO1ez3t.png)

The diagram here shows the client workflow with OAuth2 access_token retrieval.

For the first time, the client will retrieve the access_token by using the OAuth2 token endpoint using the oauth2_client_id and oauth2_client_secret values.


```sh
curl -X POST \
  https://cloud.lucidworks.com/oauth2/default/$customer_id/v1/token \
  -H 'Accept-Encoding: gzip, deflate' \
  -H 'accept: application/json' -H 'Cache-control: no-cache' \
  -H 'authorization: Basic base64($oauth2_client_id:$oauth2_client_secret)' \
  -H 'content-type: application/x-www-form-urlencoded' \
  -d 'grant_type=client_credentials&scope=com.lucidworks.cloud.search.solr.customer'

Response Format:

{
    "token_type":"Bearer",
    "access_token":"...token_value",
    "scope":"com.lucidworks.cloud.search.solr.customer",
    "expires_in":3599
}
```


The client then manages this token in a `.access_token` file in the project root directory and runs a background worker to manage an updated access token by fetching the token again based on the `expires_in` value of the last response.

