<?php

namespace Symfony\Config;

require_once __DIR__.\DIRECTORY_SEPARATOR.'PentatrionVite'.\DIRECTORY_SEPARATOR.'BuildsConfig.php';

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class PentatrionViteConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $publicDir;
    private $base;
    private $scriptAttributes;
    private $linkAttributes;
    private $defaultBuild;
    private $builds;
    private $_usedProperties = [];

    /**
     * @default '/public'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function publicDir($value): self
    {
        $this->_usedProperties['publicDir'] = true;
        $this->publicDir = $value;

        return $this;
    }

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

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function defaultBuild($value): self
    {
        $this->_usedProperties['defaultBuild'] = true;
        $this->defaultBuild = $value;

        return $this;
    }

    public function builds(string $name, array $value = []): \Symfony\Config\PentatrionVite\BuildsConfig
    {
        if (!isset($this->builds[$name])) {
            $this->_usedProperties['builds'] = true;
            $this->builds[$name] = new \Symfony\Config\PentatrionVite\BuildsConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "builds()" has already been initialized. You cannot pass values the second time you call builds().');
        }

        return $this->builds[$name];
    }

    public function getExtensionAlias(): string
    {
        return 'pentatrion_vite';
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('public_dir', $value)) {
            $this->_usedProperties['publicDir'] = true;
            $this->publicDir = $value['public_dir'];
            unset($value['public_dir']);
        }

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

        if (array_key_exists('default_build', $value)) {
            $this->_usedProperties['defaultBuild'] = true;
            $this->defaultBuild = $value['default_build'];
            unset($value['default_build']);
        }

        if (array_key_exists('builds', $value)) {
            $this->_usedProperties['builds'] = true;
            $this->builds = array_map(function ($v) { return new \Symfony\Config\PentatrionVite\BuildsConfig($v); }, $value['builds']);
            unset($value['builds']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['publicDir'])) {
            $output['public_dir'] = $this->publicDir;
        }
        if (isset($this->_usedProperties['base'])) {
            $output['base'] = $this->base;
        }
        if (isset($this->_usedProperties['scriptAttributes'])) {
            $output['script_attributes'] = $this->scriptAttributes;
        }
        if (isset($this->_usedProperties['linkAttributes'])) {
            $output['link_attributes'] = $this->linkAttributes;
        }
        if (isset($this->_usedProperties['defaultBuild'])) {
            $output['default_build'] = $this->defaultBuild;
        }
        if (isset($this->_usedProperties['builds'])) {
            $output['builds'] = array_map(function ($v) { return $v->toArray(); }, $this->builds);
        }

        return $output;
    }

}
