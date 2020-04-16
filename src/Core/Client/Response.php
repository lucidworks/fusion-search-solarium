<?php

namespace Solarium\Core\Client;

use Solarium\Exception\HttpException;

/**
 * Class for describing a response.
 */
class Response
{
    /**
     * Headers.
     *
     * @var array
     */
    protected $headers;

    /**
     * Body.
     *
     * @var string
     */
    protected $body;

    /**
     * HTTP response code.
     *
     * @var int
     */
    protected $statusCode;

    /**
     * HTTP response message.
     *
     * @var string
     */
    protected $statusMessage;

    /**
     * Constructor.
     *
     * @param string $body
     * @param array  $headers
     */
    public function __construct(string $body, array $headers = [])
    {
        $this->body = $body;
        if ($headers) {
            $this->setHeaders($headers);
        }
    }

    /**
     * Get body data.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Get response headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Get status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get status message.
     *
     * @return string
     */
    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    /**
     * Set headers.
     *
     *
     * @param array $headers
     *
     * @return self Provides fluent interface
     *
     * @throws HttpException
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        // get the status header
        $statusHeader = null;
        if (isset($headers["http_code"])) {
          $statusHeader = $headers["http_code"];
        }

        if (null === $statusHeader) {
            throw new HttpException('No HTTP status found');
        }

        $this->statusCode = $statusHeader;
        $this->statusMessage = 'HTTP/1.1'.' '.$statusHeader;
        return $this;
    }
}
