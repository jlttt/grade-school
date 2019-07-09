<?php

declare(strict_types=1);

namespace spec\GradeSchool;

use GradeSchool\School;
use PhpSpec\ObjectBehavior;

final class SchoolSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(School::class);
    }

    function it_enrolls_student_in_grade()
    {
        $this->enrollStudentInGrade("Alice", "2");

        $this->studentsInGrade("2")->shouldContain("Alice");
    }

    function it_enrolls_students_in_grade()
    {
        $this->enrollStudentInGrade("Alice", "2");
        $this->enrollStudentInGrade("Bob", "2");

        $this->studentsInGrade("2")->shouldContain("Alice");
        $this->studentsInGrade("2")->shouldContain("Bob");
    }

    function it_enrolls_students_in_different_grades()
    {
        $this->enrollStudentInGrade("Alice", "2");
        $this->enrollStudentInGrade("Bob", "3");

        $this->studentsInGrade("2")->shouldContain("Alice");
        $this->studentsInGrade("2")->shouldNotContain("Bob");
    }

    function it_lists_students_alphabetically()
    {
        $this->enrollStudentInGrade("Charlie", "2");
        $this->enrollStudentInGrade("Alice", "2");
        $this->enrollStudentInGrade("Bob", "2");

        $this->studentsInGrade("2")->shouldEqual(["Alice", "Bob", "Charlie"]);
    }

    function it_returns_an_empty_list_for_an_empty_grade()
    {
        $this->studentsInGrade("2")->shouldEqual([]);
    }

    function it_lists_grades_alphabetically()
    {
        $this->enrollStudentInGrade("Charlie", "2");
        $this->enrollStudentInGrade("Alice", "1");
        $this->enrollStudentInGrade("Bob", "3");

        $this->grades()->shouldEqual([
            "1" => ["Alice"],
            "2" => ["Charlie"],
            "3" => ["Bob"],
        ]);
    }

}
