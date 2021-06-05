<?php

namespace Model\Entities;

class Practician {

    use \Library\Shared;
    use \Library\Entity;

    /**
     * Practician constructor.
     * @param ?int $id
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
     * @param int $conformity
     * @param int $practice
     * @param int $knowledge
     */
    public function __construct(public string $teacher, public string $subject, public string $user,
                                public ?bool $main, public ?bool $evaluation, public ?bool $distance,
                                public ?int $punctuality, public ?int $objectivity, public ?int $politeness,
                                public ?int $conformity, public ?int $practice, public ?int $knowledge,
                                private ?int $id = 0) {
        $this->db = $this->getDB();
    }

    public static function search(?int $id = null, string $teacher = null, ?string $subject = null, ?string $user = null,
                                  int $limit = 0):self|array|null {
        $result = [];

        if (isset($teacher) && !isset($id) && !isset($subject) && !isset($user)) {
            $subjects = self::getDB() -> select(['Practician' => ['subject' => 'subject']]);
            $filters['teacher'] = $teacher;
            $subjects->where(['Practician' => $filters]);
            $result[] = $subjects->many($limit, 'subject');

            return $result;
        }

        else {
            $polls = self::getDB()->select(['Practician' => []]);

            foreach (['id', 'teacher', 'subject', 'user'] as $var)
                if ($$var)
                    $filters[$var] = $$var;
            if (!empty($filters))
                $polls->where(['Practician' => $filters]);

            foreach ($polls->many($limit) as $poll) {
                $class = __CLASS__;
                $result[] = new $class($poll['teacher'], $poll['subject'], $poll['user'], $poll['main'], $poll['evaluation'],
                    $poll['distance'], $poll['punctuality'], $poll['objectivity'], $poll['politeness'], $poll['conformity'],
                    $poll['practice'], $poll['knowledge']);
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
            'conformity' => 0,
            'practice' => 0,
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
            foreach (['punctuality', 'objectivity', 'politeness', 'conformity', 'practice'] as $param)
                $result[$param]+=$var->$param;
            $result['knowledge'][strval($var->$param)]++;
        }

        $num = count($array);
        $result['count'] = $num;
        foreach (['main', 'evaluation', 'distance'] as $param)
            $result[$param] = round(($result[$param] * 100) / $num, 2);
        foreach (['punctuality', 'objectivity', 'politeness', 'conformity', 'practice'] as $param)
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
                'conformity' => $this->conformity,
                'practice' => $this->practice,
                'knowledge' => $this->knowledge
            ];
            $this->id = $db->insert(['Practician' => $insert])->run(true)->storage['inserted'];
        }
        // Todo: тут надо доделать
        if ($this->_changed)
            $db -> update('Practician', $this->_changed )
                -> where(['Practician'=> ['id' => $this->id]])
                -> run();
        return $this;
    }

}