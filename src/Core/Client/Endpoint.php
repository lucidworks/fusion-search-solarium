<?php

namespace Solarium\Core\Client;

use Solarium\Core\Configurable;
use Solarium\Exception\UnexpectedValueException;

/**
 * Class for describing an endpoint.
 */
class Endpoint extends Configurable
{
    /**
     * Default options.
     *
     * The defaults match a standard Solr example instance as distributed by
     * the Apache Lucene Solr project.
     *
     * @var array
     */
    protected $options = [
        'scheme' => 'http',
        'host' => '127.0.0.1',
        'port' => 8983,
        'path' => '/',
        'collection' => null,
        'core' => null,
        'timeout' => 5,
        'leader' => false,
        'oauth2_client_id' => '',
        'oauth2_client_secret' => '',
    ];

    /**
     * Magic method enables a object to be transformed to a string.
     *
     * Get a summary showing significant variables in the object
     * note: uri resource is decoded for readability
     *
     * @return string
     */
    public function __toString()
    {
        $output = __CLASS__.'::__toString'."\n".'host: '.$this->getHost()."\n".'port: '.$this->getPort()."\n".'path: '.$this->getPath()."\n".'collection: '.$this->getCollection()."\n".'core: '.$this->getCore()."\n".'timeout: '.$this->getTimeout()."\n".'authentication: '.print_r($this->getAuthentication(), 1);

        return $output;
    }

    /**
     * Get key value.
     *
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->getOption('key');
    }

    /**
     * Set key value.
     *
     * @param string $value
     *
     * @return self Provides fluent interface
     */
    public function setKey(string $value): self
    {
        $this->setOption('key', $value);
        return $this;
    }

    /**
     * Set host option.
     *
     * @param string $host This can be a hostname or an IP address
     *
     * @return self Provides fluent interface
     */
    public function setHost(string $host): self
    {
        $this->setOption('host', $host);
        return $this;
    }

    /**
     * Get host option.
     *
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->getOption('host');
    }

    /**
     * Set port option.
     *
     * @param int $port Common values are 80, 8080 and 8983
     *
     * @return self Provides fluent interface
     */
    public function setPort(int $port): self
    {
        $this->setOption('port', $port);
        return $this;
    }

    /**
     * Get port option.
     *
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->getOption('port');
    }

    /**
     * Set path option.
     *
     * If the path has a trailing slash it will be removed.
     *
     * @param string $path
     *
     * @return self Provides fluent interface
     */
    public function setPath(string $path): self
    {
        if ('/' === substr($path, -1)) {
            $path = substr($path, 0, -1);
        }

        $this->setOption('path', $path);
        return $this;
    }

    /**
     * Get path option.
     *
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->getOption('path');
    }

    /**
     * Set collection option.
     *
     * @param string $collection
     *
     * @return self Provides fluent interface
     */
    public function setCollection(string $collection): self
    {
        $this->setOption('collection', $collection);
        return $this;
    }

    /**
     * Get collection option.
     *
     * @return string|null
     */
    public function getCollection(): ?string
    {
        return $this->getOption('collection');
    }

    /**
     * Set core option.
     *
     * @param string $core
     *
     * @return self Provides fluent interface
     */
    public function setCore(string $core): self
    {
        $this->setOption('core', $core);
        return $this;
    }

    /**
     * Get core option.
     *
     * @return string|null
     */
    public function getCore(): ?string
    {
        return $this->getOption('core');
    }

    /**
     * Set timeout option.
     *
     * @param int $timeout
     *
     * @return self Provides fluent interface
     *
     * @deprecated Endpoint::setTimeout is deprecated since Solarium 5.2 and will be removed in Solarium 6. Configure the timeout on the HTTP Client used by the Adapter instead.
     */
    public function setTimeout(int $timeout): self
    {
        @trigger_error('Endpoint::setTimeout is deprecated since Solarium 5.2 and will be removed in Solarium 6. Configure the timeout on the HTTP Client used by the Adapter instead.', E_USER_DEPRECATED);

        $this->setOption('timeout', $timeout);
        return $this;
    }

    /**
     * Get timeout option.
     *
     * @return int|null
     *
     * @deprecated Endpoint::getTimeout is deprecated since Solarium 5.2 and will be removed in Solarium 6. Configure the timeout on the HTTP Client used by the Adapter instead.
     */
    public function getTimeout(): ?int
    {
        @trigger_error('Endpoint::getTimeout is deprecated since Solarium 5.2 and will be removed in Solarium 6. Configure the timeout on the HTTP Client used by the Adapter instead.', E_USER_DEPRECATED);

        return $this->getOption('timeout');
    }

    /**
     * Set scheme option.
     *
     * @param string $scheme
     *
     * @return self Provides fluent interface
     */
    public function setScheme(string $scheme): self
    {
        $this->setOption('scheme', $scheme);
        return $this;
    }

    /**
     * Get scheme option.
     *
     * @return string|null
     */
    public function getScheme(): ?string
    {
        return $this->getOption('scheme');
    }


    /**
     * Set oauth2_client_id option.
     *
     * @param string $oauth2_client_id This is oauth2 client id.
     *
     * @return self Provides fluent interface
     */
    public function setOAuth2ClientId(string $oauth2_client_id): self
    {
        $this->setOption('oauth2_client_id', $oauth2_client_id);
        return $this;
    }

    /**
     * Get oauth2_client_id option.
     *
     * @return string|null
     */
    public function getOAuth2ClientId(): ?string
    {
        return $this->getOption('oauth2_client_id');
    }

    /**
     * Set oauth2_client_secret option.
     *
     * @param string $oauth2_client_secret This oauth client secret
     *
     * @return self Provides fluent interface
     */
    public function setOAuth2ClientSecret(string $oauth2_client_secret): self
    {
        $this->setOption('oauth2_client_secret', $oauth2_client_secret);
        return $this;
    }

    /**
     * Get oauth2_client_secret option.
     *
     * @return string|null
     */
    public function getOAuth2ClientSecret(): ?string
    {
        return $this->getOption('oauth2_client_secret');
    }

    /**
     * Get the V1 base url for all SolrCloud requests.
     *
     * Based on host, path, port and collection options.
     *
     * @return string
     *
     * @throws UnexpectedValueException
     */
    public function getCollectionBaseUri(): string
    {
        $uri = $this->getServerUri();
        $collection = $this->getCollection();

        if ($collection) {
            $uri .= 'solr/'.$collection.'/';
        } else {
            throw new UnexpectedValueException('No collection set.');
        }

        return $uri;
    }

    /**
     * Get the V1 base url for all requests.
     *
     * Based on host, path, port and core options.
     *
     * @return string
     *
     * @throws UnexpectedValueException
     */
    public function getCoreBaseUri(): string
    {
        $uri = $this->getServerUri();
        $core = $this->getCore();

        if ($core) {
            // V1 API
            $uri .= 'solr/'.$core.'/';
        } else {
            throw new UnexpectedValueException('No core set.');
        }

        return $uri;
    }

    /**
     * Get the base url for all V1 API requests.
     *
     * @return string
     *
     * @throws UnexpectedValueException
     */
    public function getBaseUri(): string
    {
        try {
            return $this->getCollectionBaseUri();
        } catch (UnexpectedValueException $e) {
            try {
                return $this->getCoreBaseUri();
            } catch (UnexpectedValueException $e) {
                throw new UnexpectedValueException('Neither collection nor core set.');
            }
        }
    }

    /**
     * Get the base url for all V1 API requests.
     *
     * @return string
     *
     * @throws UnexpectedValueException
     */
    public function getV1BaseUri(): string
    {
        return $this->getServerUri().'solr/';
    }

    /**
     * Get the base url for all V2 API requests.
     *
     * @return string
     *
     * @throws UnexpectedValueException
     */
    public function getV2BaseUri(): string
    {
        return $this->getServerUri().'api/';
    }

    /**
     * Get the server uri, required for non core/collection specific requests.
     *
     * @return string
     */
    public function getServerUri(): string
    {
        return $this->getScheme().'://'.$this->getHost().':'.$this->getPort().$this->getPath().'/';
    }

    /**
     * Set HTTP basic auth settings.
     *
     * If one or both values are NULL authentication will be disabled
     *
     * @param string $username
     * @param string $password
     *
     * @return self Provides fluent interface
     */
    public function setAuthentication(string $username, string $password): self
    {
        $this->setOption('username', $username);
        $this->setOption('password', $password);

        return $this;
    }

    /**
     * Get HTTP basic auth settings.
     *
     * @return array
     */
    public function getAuthentication(): array
    {
        return [
            'username' => $this->getOption('username'),
            'password' => $this->getOption('password'),
        ];
    }

    /**
     * Get OAuth2 token.
     *
     * @param string $oauth2_client_id
     * @param string $oauth2_client_secret
     * @param string $customer_id
     * @param bool $new_token
     *
     * @return string
     */
    public function getOAuth2Token($oauth2_client_id, $oauth2_client_secret, $customer_id, $failed_token = false): string
    {
        $file_pointer = __DIR__.'/.access_token';
        $process_file = __DIR__.'/.process_id';
        $token = '';

        if($failed_token || !is_file($file_pointer) || trim(file_get_contents($file_pointer)) === '') {
            $lms_oauth2_endpoint = 'https://cloud.lucidworks.com/oauth2/default/'.$customer_id.'/v1/token';
            $curl_req = curl_init($lms_oauth2_endpoint);
            $customHeaders = array(
              'Accept-Encoding: gzip, deflate',
              'accept: application/json',
              'Authorization: Basic '.base64_encode($oauth2_client_id.':'.$oauth2_client_secret),
              'Content-Type: application/x-www-form-urlencoded',
              'cache-control: no-cache,no-cache',
            );
            curl_setopt($curl_req, CURLOPT_POST, true);
            curl_setopt($curl_req, CURLOPT_POSTFIELDS, "grant_type=client_credentials&scope=com.lucidworks.cloud.search.solr.customer");
            curl_setopt($curl_req, CURLOPT_HTTPHEADER, $customHeaders);

            curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, true);
            $lms_oauth2_response = curl_exec($curl_req);
            $res = json_decode($lms_oauth2_response, true);
            $token = $res['token_type'].' '.$res['access_token'];
            file_put_contents($file_pointer, $token);
            if (!is_file($process_file) || trim(file_get_contents($process_file)) === '') {
                $pid = exec("php ".__DIR__."/worker.php ".$oauth2_client_id." ".$oauth2_client_secret." ".$customer_id." ".$res['expires_in']." > /dev/null 2>&1 & echo $!;");
                file_put_contents($process_file, $pid);
            }
        } else {
            $token = file_get_contents($file_pointer);
        }
        return $token;
    }

    /**
     * If the shard is a leader or not. Only in SolrCloud.
     *
     * @param bool $leader
     *
     * @return self Provides fluent interface
     */
    public function setLeader(bool $leader): self
    {
        $this->setOption('leader', $leader);
        return $this;
    }

    /**
     * If the shard is a leader or not. Only in SolrCloud.
     *
     * @return bool|null
     */
    public function isLeader(): ?bool
    {
        return $this->getOption('leader');
    }

    /**
     * Initialization hook.
     *
     * In this case the path needs to be cleaned of trailing slashes.
     *
     * @see setPath()
     */
    protected function init()
    {
        foreach ($this->options as $name => $value) {
            switch ($name) {
                case 'path':
                    $this->setPath($value);
                    break;
            }
        }
    }
}
