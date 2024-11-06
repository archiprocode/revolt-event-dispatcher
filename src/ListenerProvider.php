<?php

declare(strict_types=1);

namespace ArchiPro\EventDispatcher;

use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Simple implementation of PSR-14 ListenerProviderInterface.
 *
 * Stores listeners in an array indexed by event class name and provides them
 * when requested for event dispatch.
 */
class ListenerProvider implements ListenerProviderInterface
{
    /** @var array<string, array<callable>> */
    private array $listeners = [];

    /**
     * Registers a listener for a specific event class.
     *
     * @param string $eventClass The fully qualified class name of the event
     * @param callable $listener The listener callback that will handle the event
     */
    public function addListener(string $eventClass, callable $listener): void
    {
        $this->listeners[$eventClass][] = $listener;
    }

    /**
     * Gets all listeners registered for the given event.
     *
     * @param object $event The event to get listeners for
     * @return iterable<callable> The registered listeners
     */
    public function getListenersForEvent(object $event): iterable
    {
        return $this->listeners[$event::class] ?? [];
    }
} 