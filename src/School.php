<?php

declare(strict_types=1);

namespace GradeSchool;

final class School
{
    /**
     * @var GradeCollection
     */
    private $grades;

    public function __construct()
    {
        $this->grades = new GradeCollection();
    }

    public function enrollStudentInGrade(string $student, string $gradeName): void
    {
        $grade = $this->grades->get($gradeName);
        $grade->enroll($student);
        $this->grades->set($gradeName, $grade);
    }

    /**
     * @param string $gradeName
     *
     * @return array<string>
     */
    public function studentsInGrade(string $gradeName): array
    {
        return $this->grades->get($gradeName)->students();
    }

    /**
     * @return array<string,array<string>>
     */
    public function grades(): array
    {
        return $this->grades->map(
            static function($name, $grade) {
                return [$name => $grade->students()];
            }
        );
    }
}
