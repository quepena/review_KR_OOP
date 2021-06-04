<?php

namespace Model\Entities;

class Rating {

    use \Library\Shared;
    use \Library\Entity;
    use \Library\Questionnaire;

    private Teacher $teacher;
    private Subject $chosen;
    private array $subjects;

    public function __construct(){
    }

    public function getStatistics(string $guid, Subject $subject): string|int {
        $teacher = Teacher::search(guid: $guid, limit: 1);
        $name = $teacher->name;
        $title = $subject->title;

        $pract = Practician::count(teacher: $guid, subject: $subject->guid);
        $lect = Lecturer::count(teacher: $guid, subject: $subject->guid);

        $result = 'Не знайдено :(';
        if ($pract && $lect){
            $practician = Practician::average(teacher: $guid, subject: $subject->guid);
            $lecturer = Lecturer::average(teacher: $guid, subject: $subject->guid);
            $result = $this->getText($name, $title, $lecturer ,$practician);
        }
        elseif ($pract) {
            $practician = Practician::average(teacher: $guid, subject: $subject->guid);
            $result = $this->getText($name, $title, null , $practician);
        }
        elseif ($lect) {
            $lecturer = Lecturer::average(teacher: $guid, subject: $subject->guid);
            $result = $this->getText($name, $title, $lecturer, null);
        }
        return $result;
    }

    public function getText(string $name, string $title, ?array $lecturer = null,  ?array $practician = null):?string {

        $text = 'Викладач: ' . $name . "\n" . 'Дисципліна: ' . $title . "\n";
        $params = $this->questions;
        if ($lecturer) {
            $text .= "\n\nЛЕКТОР";
            foreach (['main', 'evaluation', 'distance'] as $var)
                $text .= "\n" . $params[$var]['title'] . ' - ' . $lecturer[$var] . '%';
            foreach (['punctuality', 'objectivity', 'politeness', 'relevance', 'exams', 'lecture'] as $var)
                $text .= "\n" . $params[$var]['title'] . ' - ' . $lecturer[$var];
            $text .= "\n" . $params['knowledge']['title'] . " - \n" .
                str_replace(array('{','}','[',']'), ' ', json_encode($lecturer['knowledge']));
            $text .= "\n" . 'Кількість опитувань' . ' - ' . $lecturer['count'];
        }
        if ($practician) {
            $text .= "\n\nПРАКТИК";
            foreach (['main', 'evaluation', 'distance'] as $var)
                $text .= "\n" . $params[$var]['title'] . ' - ' . $practician[$var] . '%';
            foreach (['punctuality', 'objectivity', 'politeness', 'conformity', 'practice'] as $var)
                $text .= "\n" . $params[$var]['title'] . ' - ' . $practician[$var];
            $text .= "\n" . $params['knowledge']['title'] . " - \n" .
                str_replace(array('{','}','[',']'), ' ', json_encode($practician['knowledge']));
            $text .= "\n" . 'Кількість опитувань' . ' - ' . $practician['count'];
        }
        return $text;
    }


    public function getTeacher(string $name): null|Teacher {
        $var = Teacher::search(name: $name, limit: 1);
        if (!isset($var)) {
            return null;
        }
        else {
            $this->teacher = $var;
            return $this->teacher;
        }
    }

    public function getSubjectsList(): array {
        return $this->subjects;
    }


    public function getSubjects(): null|array|string {
        $practices = Practician::search(teacher:$this->teacher->guid, limit: 0);
        $lectures = Lecturer::search(teacher:$this->teacher->guid, limit: 0);
        $subjects = [];
        if(isset($practices) || isset($lectures)) {
            $array = [];
            if (isset($practices) && isset($lectures)) {
                foreach ($practices[0] as $pract)
                    $array[] = $pract['subject'];
                foreach ($lectures[0] as $lect)
                    if (!in_array($lect['subject'], $array))
                        $array[] = $lect['subject'];
            } elseif (isset($practices))
                foreach ($practices[0] as $pract)
                    $array[] = $pract['subject'];
            else
                foreach ($lectures[0] as $lect)
                    $array[] = $lect['subject'];
            foreach ($array as $guid){
                $subjects[] = Subject::search(guid: $guid, limit: 1);
            }
        }
        else
            $array = [];

        if (isset($subjects))
            $this->subjects = $subjects;
        return $subjects;

    }

}




