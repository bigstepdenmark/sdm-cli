<?php

namespace App\Model;

class File
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var null|array
     */
    protected $variables = [];

    /**
     * @var string
     */
    protected $path;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return File
     */
    public function setName(string $name): File
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return File
     */
    public function setContent(string $content): File
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getVariables(): ?array
    {
        return $this->variables;
    }

    /**
     * @param array|null $variables
     * @return File
     */
    public function setVariables(?array $variables): File
    {
        $this->variables = $variables;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return File
     */
    public function setPath(string $path): File
    {
        $this->path = $path;
        return $this;
    }
}
