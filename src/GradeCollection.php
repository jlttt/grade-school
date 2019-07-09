<?php

declare(strict_types=1);

namespace GradeSchool;

final class GradeCollection implements \IteratorAggregate
{
    /**
     * @var array<string, Grade>
     */
    private $grades = [];

    public function get(string $gradeName): Grade
    {
        if (!$this->exists($gradeName)) {
            return new Grade();
        }
        return $this->grades[$gradeName]->deepClone();
    }

    public function set(string $gradeName, Grade $grade): void
    {
        $this->grades[$gradeName] = $grade;
        ksort($this->grades);
    }

    public function exists(string $gradeName): bool
    {
        return isset($this->grades[$gradeName]);
    }

    public function getIterator(): \Iterator
    {
        return new \ArrayIterator($this->grades);
    }

    public function map(callable $callable): array
    {
        $result = [];
        foreach ($this->grades as $key => $value) {
            $result += $callable($key, $value);
        }
        return $result;
    }
}
