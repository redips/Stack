<?php

declare(strict_types=1);

namespace Sylius\TwigEvent\Registry;

use Laminas\Stdlib\SplPriorityQueue;
use Sylius\TwigEvent\Block\EventBlock;

/** @internal */
final class EventBlocksRegistry
{
    /** @var array<string, array<EventBlock>> */
    private array $eventBlocks = [];

    /**
     * @param iterable<EventBlock> $eventBlocks
     */
    public function __construct (iterable $eventBlocks)
    {
        foreach ($eventBlocks as $eventBlock) {
            if (!$eventBlock instanceof EventBlock) {
                throw new \InvalidArgumentException(
                    sprintf('Event block must be an instance of "%s".', EventBlock::class)
                );
            }

            $this->eventBlocks[$eventBlock->getEventName()][$eventBlock->getName()] = $eventBlock;
        }
    }

    /** @return array<string, array<EventBlock>> */
    public function getAll(): array
    {
        return $this->eventBlocks;
    }

    /**
     * @param string|array<string> $eventName
     *
     * @return array<EventBlock>
     */
    public function getEnabledForEvent(string|array $eventName): array
    {
        if (is_string($eventName)) {
            return array_values(
                array_filter(
                    $this->eventBlocks[$eventName] ?? [],
                    static fn (EventBlock $block): bool => $block->isEnabled(),
                )
            );
        }

        $priorityQueue = new SplPriorityQueue();
        foreach ($this->mergeEventBlocks($eventName) as $block) {
            $priorityQueue->insert($block, $block->getPriority());
        }

        return $priorityQueue->toArray();
    }

    /**
     * @param array<string> $eventsNames
     *
     * @return array<EventBlock>
     */
    private function mergeEventBlocks(array $eventsNames): array
    {
        /** @var array<EventBlock> $mergedBlocks */
        $mergedBlocks = [];

        foreach (array_reverse($eventsNames) as $eventName) {
            $eventBlocks = $this->eventBlocks[$eventName] ?? [];

            foreach ($eventBlocks as $blockName => $block) {
                if (array_key_exists($blockName, $mergedBlocks)) {
                    $block = $mergedBlocks[$blockName]->overwriteWith($block);
                }

                $mergedBlocks[$blockName] = $block;
            }
        }

        return array_values($mergedBlocks);
    }
}
