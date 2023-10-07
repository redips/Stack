<?php

declare(strict_types=1);

namespace Tests\Sylius\TwigEvent\Unit\Renderer;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sylius\TwigEvent\Block\EventBlock;
use Sylius\TwigEvent\Registry\EventBlocksRegistry;
use Sylius\TwigEvent\Renderer\EventBlockRendererInterface;
use Sylius\TwigEvent\Renderer\EventRenderer;

final class TwigEventRendererTest extends TestCase
{
    /** @var EventBlocksRegistry&MockObject */
    private EventBlocksRegistry $eventBlocksRegistryMock;

    /** @var EventBlockRendererInterface&MockObject */
    private EventBlockRendererInterface $eventBlockRendererMock;

    protected function setUp(): void
    {
        $this->eventBlocksRegistryMock = $this->createMock(EventBlocksRegistry::class);
        $this->eventBlockRendererMock = $this->createMock(EventBlockRendererInterface::class);
    }

    public function testItRendersEnabledEventBlocks(): void
    {
        $someBlock = $this->createMock(EventBlock::class);
        $anotherBlock = $this->createMock(EventBlock::class);

        $this->eventBlocksRegistryMock->method('getEnabledForEvent')->willReturn([$someBlock, $anotherBlock]);
        $this->eventBlockRendererMock->method('render')->willReturnMap([
            [$someBlock, [], 'some_block_rendered'],
            [$anotherBlock, [], 'another_block_rendered'],
        ]);

        $renderer = $this->createRenderer();
        $output = $renderer->render('some_event');
        $expectedOutput = <<<RESULT
        some_block_rendered
        another_block_rendered
        RESULT;

        $this->assertSame($expectedOutput, $output);
    }

    private function createRenderer(): EventRenderer
    {
        return new EventRenderer($this->eventBlocksRegistryMock, $this->eventBlockRendererMock);
    }
}
