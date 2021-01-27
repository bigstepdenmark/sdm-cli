<?php

namespace App\Model;

class Module
{
    /**
     * @var string
     */
    protected $vendor;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var null|string
     */
    protected $registration;

    /**
     * @var null|string
     */
    protected $moduleXML;

    /**
     * @var null|string
     */
    protected $diXML;

    /**
     * @var null|array
     */
    protected $command;

    /**
     * @var null|array
     */
    protected $composer;

    /**
     * @var null|array
     */
    protected $logger;

    /**
     * @var null|array
     */
    protected $graphQl;

    /**
     * @var null|array
     */
    protected $webApi;

    /**
     * @return string
     */
    public function getVendor(): string
    {
        return $this->vendor;
    }

    /**
     * @param string $vendor
     * @return Module
     */
    public function setVendor(string $vendor): Module
    {
        $this->vendor = $vendor;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Module
     */
    public function setName(string $name): Module
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegistration(): ?string
    {
        return $this->registration;
    }

    /**
     * @param string|null $registration
     * @return Module
     */
    public function setRegistration(?string $registration): Module
    {
        $this->registration = $registration;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getModuleXML(): ?string
    {
        return $this->moduleXML;
    }

    /**
     * @param string|null $moduleXML
     * @return Module
     */
    public function setModuleXML(?string $moduleXML): Module
    {
        $this->moduleXML = $moduleXML;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiXML(): ?string
    {
        return $this->diXML;
    }

    /**
     * @param string|null $diXML
     * @return Module
     */
    public function setDiXML(?string $diXML): Module
    {
        $this->diXML = $diXML;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCommand(): ?array
    {
        return $this->command;
    }

    /**
     * @param array|null $command
     * @return Module
     */
    public function setCommand(?array $command): Module
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getComposer(): ?array
    {
        return $this->composer;
    }

    /**
     * @param array|null $composer
     * @return Module
     */
    public function setComposer(?array $composer): Module
    {
        $this->composer = $composer;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getLogger(): ?array
    {
        return $this->logger;
    }

    /**
     * @param array|null $logger
     * @return Module
     */
    public function setLogger(?array $logger): Module
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getGraphQl(): ?array
    {
        return $this->graphQl;
    }

    /**
     * @param array|null $graphQl
     * @return Module
     */
    public function setGraphQl(?array $graphQl): Module
    {
        $this->graphQl = $graphQl;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getWebApi(): ?array
    {
        return $this->webApi;
    }

    /**
     * @param array|null $webApi
     * @return Module
     */
    public function setWebApi(?array $webApi): Module
    {
        $this->webApi = $webApi;
        return $this;
    }
}
