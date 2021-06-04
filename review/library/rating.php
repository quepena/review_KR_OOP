<?php

/**
 * @author Yana Bielik
 */

namespace Library;

// Класс, який збирає інформацію для відповіді на запит 'отримання рейтингу викладача'
// Викладач може бути окремо оцінений як лектор і як практик
trait Rating
{
    private $name; // ПІБ викладача
    private $subject;
    private Lecturer $lecturer;
    private Practician $practician;
    
    public function drawImage() {
        // Створює інфографіку для даного викладача
        // Якщо існує й рейтинг лектора і практика, то повертає 2 зображення
    }

    public function getName(): String {
        return $this->name;
    }

    public function getSubject(): String {
        return $this->subject;
    }

    public function getLecturer(): Lecturer {
        return $this->lecturer;
    }

    public function getPractician(): Lecturer {
        return $this->practician;
    }

    public function __construct(String $name, String $subject){
        $this->name = $name;
        $this->subject = $subject;
        // Саме знаходить рейтинг викладача за даною дисципліною і додає
        // $this->lecturer = $lecturer;
        // $this->practician = $practician;
    }
}
