<?php

declare(strict_types=1);

namespace GradeSchool;

final class Grade
{
    /**
     * @var array<string>
     */
    private $students = [];

    public function enroll(string $student): void
    {
        $this->students[] = $student;
        sort($this->students);
    }

    /**
     * @return array<string>
     */
    public function students(): array
    {
        return $this->students;
    }

    public function deepClone(): self
    {
        return clone $this;
    }
}
