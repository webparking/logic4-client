<?php

declare(strict_types=1);

namespace Webparking\Logic4Client;

use Webmozart\Assert\Assert;

/**
 * @template TValue
 *
 * @implements \IteratorAggregate<array-key, TValue>
 */
class PaginatedResponse implements \IteratorAggregate
{
    /**
     * @param \Generator<array<mixed>> $recordsGenerator
     * @param class-string             $dataClass
     */
    public function __construct(
        public \Generator $recordsGenerator,
        public string $dataClass,
    ) {
        Assert::methodExists($this->dataClass, 'make');
    }

    /** @return \Generator<TValue> */
    public function records(): iterable
    {
        foreach ($this->recordsGenerator as $record) {
            yield $this->dataClass::make($record);
        }
    }

    /** @return array<array-key, TValue> */
    public function all(): array
    {
        return iterator_to_array($this->records());
    }

    /** @return \Traversable<TValue> */
    public function getIterator(): \Traversable
    {
        return $this->records();
    }
}
