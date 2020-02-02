<?php

namespace AsyncAws\S3\Result;

class Owner
{
    private $DisplayName;

    private $ID;

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    /**
     * @param array{
     *   DisplayName?: string,
     *   ID?: string,
     * } $input
     */
    public function __construct(array $input = [])
    {
        $this->DisplayName = $input['DisplayName'] ?? null;
        $this->ID = $input['ID'] ?? null;
    }

    public function getDisplayName(): ?string
    {
        return $this->DisplayName;
    }

    public function getID(): ?string
    {
        return $this->ID;
    }
}