<?php

namespace Model\Entities;

class Message {

	use \Library\Shared;
	use \Library\Entity;

    /**
     * Message constructor.
     * @param int|null $id
     * @param int|null $parent
     * @param int $type
     * @param string $text
     */

    public function __construct(public int $type, public string $text,
                                public ?int $parent = 0, public ?int $id = 0) {
        $this->db = $this->getDB();
    }

	public static function search(int $id = 0, ?int $parent = 0, ?int $type = 0, int $limit = 0):self|array|null {

        $result = [];
        $messages = self::getDB() -> select(['Message' => []]);

		foreach (['id', 'parent', 'type'] as $var)
			if ($$var)
				$filters[$var] = $$var;
		if (!empty($filters))
			$messages->where(['Message'=> $filters]);
		foreach ($messages->many($limit) as $message) {
			$class = __CLASS__;
			$result[] = new $class($message['type'], $message['text'], $message['parent'], $message['id']);
		}

		return $limit == 1 ? ($result[0] ?? null) : $result;
	}

	public function save():self {
		$db = $this->db;
		if (!$this->id) {}
		return $this;
	}

	public function getChildren($limit = 0):array|self {
		return $this::search(parent: $this->id, limit: $limit);
	}

	public function getKeyboard():array
    {
        $buttons = [];
		foreach ($this->getChildren() as $button) {
			if ($button->text) {
                $buttons[] = [
                    'id' => $button->id,
                    'title' => $button->text
                ];
            }
		}
        return [$buttons];
    }
}