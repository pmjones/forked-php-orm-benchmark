<?php
/**
 *
 * This file is part of Atlas for PHP.
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 */
declare(strict_types=1);

namespace Atlas\Pdo;

class ConnectionLocator
{
    const DEFAULT = 'DEFAULT';

    const READ = 'READ';

    const WRITE = 'WRITE';

    protected $factories = [
        self::DEFAULT => null,
        self::READ => [],
        self::WRITE => [],
    ];

    protected $instances = [
        self::DEFAULT => null,
        self::READ => [],
        self::WRITE => [],
    ];

    protected $read;

    protected $write;

    protected $lockToWrite = false;

    public static function new(...$args)
    {
        if ($args[0] instanceof Connection) {
            return new ConnectionLocator(function () use ($args) {
                return $args[0];
            });
        }

        return new ConnectionLocator(Connection::factory(...$args));
    }

    public function __construct(
        callable $default = null,
        array $read = [],
        array $write = []
    ) {
        if ($default) {
            $this->setDefaultFactory($default);
        }

        foreach ($read as $name => $factory) {
            $this->setReadFactory($name, $factory);
        }

        foreach ($write as $name => $factory) {
            $this->setWriteFactory($name, $factory);
        }
    }

    public function setDefaultFactory(callable $factory) : void
    {
        $this->factories[static::DEFAULT] = $factory;
    }

    public function setReadFactory(
        string $name,
        callable $factory
    ) : void
    {
        $this->factories[static::READ][$name] = $factory;
    }

    public function setWriteFactory(
        string $name,
        callable $factory
    ) : void
    {
        $this->factories[static::WRITE][$name] = $factory;
    }

    public function getDefault() : Connection
    {
        if ($this->instances[static::DEFAULT] === null) {
            $instance = ($this->factories[static::DEFAULT])();
            $this->instances[static::DEFAULT] = $instance;
        }

        return $this->instances[static::DEFAULT];
    }

    public function getRead() : Connection
    {
        if ($this->lockToWrite) {
            return $this->getWrite();
        }

        if (! isset($this->read)) {
            $this->read = $this->getType(static::READ);
        }

        return $this->read;
    }

    public function getWrite() : Connection
    {
        if (! isset($this->write)) {
            $this->write = $this->getType(static::WRITE);
        }

        return $this->write;
    }

    protected function getType(string $type) : Connection
    {
        if (empty($this->factories[$type])) {
            return $this->getDefault();
        }

        if (! empty($this->instances[$type])) {
            return reset($this->instances[$type]);
        }

        return $this->get($type, array_rand($this->factories[$type]));
    }

    public function get(
        string $type,
        string $name
    ) : Connection
    {
        if (! isset($this->factories[$type][$name])) {
            throw Exception::connectionNotFound($type, $name);
        }

        if (! isset($this->instances[$type][$name])) {
            $this->instances[$type][$name] = ($this->factories[$type][$name])();
        }

        return $this->instances[$type][$name];
    }

    public function hasRead() : bool
    {
        return isset($this->read);
    }

    public function hasWrite() : bool
    {
        return isset($this->write);
    }

    public function lockToWrite(bool $lockToWrite = true) : void
    {
        $this->lockToWrite = $lockToWrite;
    }

    public function isLockedToWrite() : bool
    {
        return $this->lockToWrite;
    }
}
