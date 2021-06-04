<?php

namespace Model\Entities;

class Lecturer {

    use \Library\Shared;
	use \Library\Entity;

    /**
     * Lecturer constructor.
     * @param int|null $id
     * @param string $teacher
     * @param string $subject
     * @param string $user
     * Questions
     * @param bool $main
     * @param bool $evaluation
     * @param bool $distance
     * @param int $punctuality
     * @param int $objectivity
     * @param int $politeness
     * @param int $relevance
     * @param int $exams
     * @param int $lecture
     * @param int $knowledge
     */

    public function __construct(public string $teacher, public string $subject, public string $user,
                                public bool $main, public bool $evaluation, public bool $distance,
                                public int $punctuality, public int $objectivity, public int $politeness,
                                public int $relevance, public int $exams, public int $lecture,
                                public int $knowledge, private ?int $id = 0) {
        $this->db = $this->getDB();
    }

    public static function search(?int $id = null, string $teacher = null, ?string $subject = null, ?string $user = null,
                                  int $limit = 0):self|array|null {
        $result = [];

        if (isset($teacher) && !isset($id) && !isset($subject) && !isset($user)) {
            $subjects = self::getDB() -> select(['Lecturer' => ['subject' => 'subject']]);
            $filters['teacher'] = $teacher;
            $subjects->where(['Lecturer' => $filters]);
            $result[] = $subjects->many($limit, 'subject');

            return $result;
        }
        else {
            $polls = self::getDB()->select(['Lecturer' => []]);

            foreach (['id', 'teacher', 'subject', 'user'] as $var)
                if ($$var)
                    $filters[$var] = $$var;
            if (!empty($filters))
                $polls->where(['Lecturer' => $filters]);
            foreach ($polls->many($limit) as $poll) {
                $class = __CLASS__;
                $result[] = new $class($poll['teacher'], $poll['subject'], $poll['user'], $poll['main'], $poll['evaluation'],
                    $poll['distance'], $poll['punctuality'], $poll['objectivity'], $poll['politeness'], $poll['relevance'],
                    $poll['exams'], $poll['lecture'], $poll['knowledge']);
            }
            return $limit == 1 ? ($result[0] ?? null) : $result;
        }
    }

    public static function count(string $teacher, string $subject):int {
        $result = self::search(teacher:$teacher, subject: $subject, limit: 0);
        return count($result);
    }

    public static function average(string $teacher, string $subject):array|string {
        $result = [
            'main' => 0,
            'evaluation' => 0,
            'distance' => 0,
            'punctuality' => 0,
            'objectivity' => 0,
            'politeness' => 0,
            'relevance' => 0,
            'exams' => 0,
            'lecture' => 0,
            'knowledge' => [
                '1' => 0,
                '2' => 0,
                '3' => 0,
                '4' => 0,
                '5' => 0
            ],
            'count' => 0
        ];
        $array = self::search(teacher:$teacher, subject: $subject, limit: 0);
        foreach ($array as $var) {
            foreach (['main', 'evaluation', 'distance'] as $param)
                if ($var->$param)
                    $result[$param]++;
            foreach (['punctuality', 'objectivity', 'politeness', 'relevance', 'exams', 'lecture'] as $param)
                $result[$param]+=$var->$param;
            $result['knowledge'][strval($var->$param)]++;
        }

        $num = count($array);
        $result['count'] = $num;
        foreach (['main', 'evaluation', 'distance'] as $param)
            $result[$param] = round(($result[$param] * 100) / $num, 2);
        foreach (['punctuality', 'objectivity', 'politeness', 'relevance', 'exams', 'lecture'] as $param)
            $result[$param] = round($result[$param]/ $num, 2);
        return $result;
    }


    public function save():self {
        $db = $this->db;
        if (!$this->id) {
            $insert = [
                'teacher' => $this->teacher,
                'subject' => $this->subject,
                'main' => $this->main,
                'evaluation' => $this->evaluation,
                'distance' => $this->distance,
                'punctuality' => $this->punctuality,
                'objectivity' => $this->objectivity,
                'politeness' => $this->politeness,
                'relevance' => $this->relevance,
                'exams' => $this->exams,
                'lecture' => $this->lecture,
                'knowledge' => $this->knowledge
            ];
            $this->id = $db->insert(['Lecturer' => $insert])->run(true)->storage['inserted'];
        }
        // Todo: тут надо доделать
        if ($this->_changed)
            $db -> update('Lecturer', $this->_changed )
                -> where(['Lecturer'=> ['id' => $this->id]])
                -> run();
        return $this;
    }

}