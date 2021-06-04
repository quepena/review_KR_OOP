<?php

namespace Model\Entities;

class Subject {

    use \Library\Shared;
    use \Library\Entity;

    /**
     * Subject constructor.
     * @param string $guid
     * @param string $title
     */
    public function __construct(public string $guid, public string $title) {
        $this->db = $this->getDB();
    }

    public static function search(string $guid, int $limit = 0):self|array|null {
        $result = [];
        $subjects = self::getDB() -> select(['Subject' => []]);
        $filters['guid'] = $guid;
        $subjects->where(['Subject'=> $filters]);

        foreach ($subjects->many($limit) as $subject) {
            $class = __CLASS__;
            $result[] = new $class($subject['guid'], $subject['title']);
        }
        return $limit == 1 ? ($result[0] ?? null) : $result;
    }

    public function save():self {
        $db = $this->db;
        if (!$this->guid) {
            $insert = [
                'guid' => $this->guid,
                'title' => $this->title,
            ];
            $this->guid = $db->insert(['Subject' => $insert])->run(true)->storage['inserted'];
        }
        // Todo: тут надо доделать
        if ($this->_changed)
            $db -> update('Subject', $this->_changed )
                -> where(['Subject'=> ['guid' => $this->guid]])
                -> run();
        return $this;
    }
}