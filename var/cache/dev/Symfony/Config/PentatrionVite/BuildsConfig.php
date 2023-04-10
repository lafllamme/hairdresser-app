<?php

namespace Symfony\Config\PentatrionVite;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class BuildsConfig 
{
    private $base;
    private $scriptAttributes;
    private $linkAttributes;
    private $_usedProperties = [];

    /**
     * @default '/build/'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function base($value): self
    {
        $this->_usedProperties['base'] = true;
        $this->base = $value;

        return $this;
    }

    /**
     * @param ParamConfigurator|list<mixed|ParamConfigurator> $value
     * @return $this
     */
    public function scriptAttributes($value): self
    {
        $this->_usedProperties['scriptAttributes'] = true;
        $this->scriptAttributes = $value;

        return $this;
    }

    /**
     * @param ParamConfigurator|list<mixed|ParamConfigurator> $value
     * @return $this
     */
    public function linkAttributes($value): self
    {
        $this->_usedProperties['linkAttributes'] = true;
        $this->linkAttributes = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('base', $value)) {
            $this->_usedProperties['base'] = true;
            $this->base = $value['base'];
            unset($value['base']);
        }

        if (array_key_exists('script_attributes', $value)) {
            $this->_usedProperties['scriptAttributes'] = true;
            $this->scriptAttributes = $value['script_attributes'];
            unset($value['script_attributes']);
        }

        if (array_key_exists('link_attributes', $value)) {
            $this->_usedProperties['linkAttributes'] = true;
            $this->linkAttributes = $value['link_attributes'];
            unset($value['link_attributes']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['base'])) {
            $output['base'] = $this->base;
        }
        if (isset($this->_usedProperties['scriptAttributes'])) {
            $output['script_attributes'] = $this->scriptAttributes;
        }
        if (isset($this->_usedProperties['linkAttributes'])) {
            $output['link_attributes'] = $this->linkAttributes;
        }

        return $output;
    }

}
