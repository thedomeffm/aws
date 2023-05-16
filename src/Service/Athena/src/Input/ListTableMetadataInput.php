<?php

namespace AsyncAws\Athena\Input;

use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\Core\Input;
use AsyncAws\Core\Request;
use AsyncAws\Core\Stream\StreamFactory;

final class ListTableMetadataInput extends Input
{
    /**
     * The name of the data catalog for which table metadata should be returned.
     *
     * @required
     *
     * @var string|null
     */
    private $catalogName;

    /**
     * The name of the database for which table metadata should be returned.
     *
     * @required
     *
     * @var string|null
     */
    private $databaseName;

    /**
     * A regex filter that pattern-matches table names. If no expression is supplied, metadata for all tables are listed.
     *
     * @var string|null
     */
    private $expression;

    /**
     * A token generated by the Athena service that specifies where to continue pagination if a previous request was
     * truncated. To obtain the next set of pages, pass in the NextToken from the response object of the previous page call.
     *
     * @var string|null
     */
    private $nextToken;

    /**
     * Specifies the maximum number of results to return.
     *
     * @var int|null
     */
    private $maxResults;

    /**
     * @param array{
     *   CatalogName?: string,
     *   DatabaseName?: string,
     *   Expression?: string,
     *   NextToken?: string,
     *   MaxResults?: int,
     *
     *   @region?: string,
     * } $input
     */
    public function __construct(array $input = [])
    {
        $this->catalogName = $input['CatalogName'] ?? null;
        $this->databaseName = $input['DatabaseName'] ?? null;
        $this->expression = $input['Expression'] ?? null;
        $this->nextToken = $input['NextToken'] ?? null;
        $this->maxResults = $input['MaxResults'] ?? null;
        parent::__construct($input);
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getCatalogName(): ?string
    {
        return $this->catalogName;
    }

    public function getDatabaseName(): ?string
    {
        return $this->databaseName;
    }

    public function getExpression(): ?string
    {
        return $this->expression;
    }

    public function getMaxResults(): ?int
    {
        return $this->maxResults;
    }

    public function getNextToken(): ?string
    {
        return $this->nextToken;
    }

    /**
     * @internal
     */
    public function request(): Request
    {
        // Prepare headers
        $headers = [
            'Content-Type' => 'application/x-amz-json-1.1',
            'X-Amz-Target' => 'AmazonAthena.ListTableMetadata',
        ];

        // Prepare query
        $query = [];

        // Prepare URI
        $uriString = '/';

        // Prepare Body
        $bodyPayload = $this->requestBody();
        $body = empty($bodyPayload) ? '{}' : json_encode($bodyPayload, 4194304);

        // Return the Request
        return new Request('POST', $uriString, $query, $headers, StreamFactory::create($body));
    }

    public function setCatalogName(?string $value): self
    {
        $this->catalogName = $value;

        return $this;
    }

    public function setDatabaseName(?string $value): self
    {
        $this->databaseName = $value;

        return $this;
    }

    public function setExpression(?string $value): self
    {
        $this->expression = $value;

        return $this;
    }

    public function setMaxResults(?int $value): self
    {
        $this->maxResults = $value;

        return $this;
    }

    public function setNextToken(?string $value): self
    {
        $this->nextToken = $value;

        return $this;
    }

    private function requestBody(): array
    {
        $payload = [];
        if (null === $v = $this->catalogName) {
            throw new InvalidArgument(sprintf('Missing parameter "CatalogName" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['CatalogName'] = $v;
        if (null === $v = $this->databaseName) {
            throw new InvalidArgument(sprintf('Missing parameter "DatabaseName" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['DatabaseName'] = $v;
        if (null !== $v = $this->expression) {
            $payload['Expression'] = $v;
        }
        if (null !== $v = $this->nextToken) {
            $payload['NextToken'] = $v;
        }
        if (null !== $v = $this->maxResults) {
            $payload['MaxResults'] = $v;
        }

        return $payload;
    }
}