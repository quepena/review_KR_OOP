SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База даних: `core`
--

-- --------------------------------------------------------

--
-- Структура таблиці `Messages`
--

CREATE TABLE `Message` (
                           `id` int UNSIGNED NOT NULL,
                           `parent` int UNSIGNED DEFAULT NULL,
                           `type` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 - повідомлення, - 1 кнопка, 2 - форма, 3 - поле форми',
                           `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `Messages`
--

INSERT INTO `Message` (`id`, `parent`, `type`, `text`) VALUES
(1, NULL, 0, '/start'),
(2, 1, 1, 'Оцінити викладача'),
(3, 1, 1, 'Рейтинг викладача'),
(4, 2, 0, 'Введіть ПІБ викладача. Наприклад: Р.С.Іванов'),
(5, 3, 0, 'Введіть ПІБ викладача. Наприклад: Р.С.Іванов'),
(6, NULL, 0, 'Некоректний формат введення. Спробуйте ще раз'),
(7, NULL, 0, '◀ Повернутися'),
(8, NULL, 0, 'Такого викладача не знайдено у вашому розкладі'),
(9, NULL, 0, 'У цього викладача ще не має рейтингу'),
(10, 4, 0, 'Оберіть дисципліну, за яким бажаєте оцінити викладача\n\nВикладача можна оцінити окремо як лектора і як практика.\nЛектор - той, хто проводить лекційні заняття\nПрактик - той, хто проводить практичні й лабораторні заняття'),
(11, 5, 0, 'Оберіть дисципліну, за якою бажаєте переглянути рейтинг обраного викладача\n\nНижче перераховані всі дисципліни, за якими було оцінено даного викладача'),
(12, 11, 0, 'Зачекайте, генеруємо зображення...'),

(13, 10, 0, 'Зверніть увагу! Результати ваших відповідей будуть зараховані лише після проходження усього опитування (8-10 питань)\n\nІснує два типи питань:\nПерший тип - оберіть відповідь “ТАК” або “Ні”\nДругий тип - оцініть від 1 до 5 за певним критерієм'),

(14, 13, 0, 'Пунктуальність\n\n1️⃣ - Заняття скасовували без пояснень та відпрацювань або викладач систематично запізнюється на 15+ хвилин\n5️⃣ - Заняття проводились відповідно до розкладу'),
(15, 14, 0, 'Об`єктивність оцінювання\n\n1️⃣ - Викладач оцінює необ`єктивно (як на користь студента, так і ні)\n5️⃣ - Викладач оцінює об`єктивно'),
(16, 15, 0, 'Ввічливість\n\n1️⃣ - Кричить/принижує честь та гідність студентів/проявляє сексизм тощо\n5️⃣ - Ввічливий, спокійний, доброзичливий'),


(17, 16, 0, 'Актуальність матеріалу\n\n1️⃣ - Матеріал неактуальний\n5️⃣ - Матеріал актуальний'),
(18, 17, 0, 'Надання питань до заліку\n\n1️⃣ - Перелік не наданий або наданий занадто пізно для підготовки/Буде те, що проходили\n5️⃣ - Перелік наданий вчасно/проблем з нестачею часу на підготовку не виникло'),
(19, 18, 0, 'Організація лекційного часу\n\n1️⃣ - Забагато часу витрачається на сторонні теми/Лектор не володіє матеріалом або читає з папірця\n5️⃣ - Лекції інформативні, не містять "води"'),

(20, 16, 0, 'Організація часу на занятті\n\n1️⃣ - Забагато часу витрачається на сторонні теми/Викладач не встигає оцінити роботи/Занять немає\n5️⃣ - Втрати часу на сторонні теми мінімальні, викладач спроможний працювати з кожним студентом'),
(21, 20, 0, 'Відповідність практик лекціям\n\n1️⃣ - Завдання не відповідають матеріалу взагалі\n5️⃣ - Завдання повністю відповідають пройденому матеріалу'),

(22, NULL, 0, 'Самооцінка власних знань, після проходження курсу\n\n1️⃣ - Я не отримав жодних актуальних та змістовних знань з даної дисципліни\n5️⃣ - Я отримав актуальні та змістовні знання з даної дисципліни'),
(23, 22, 0, 'Чи вважаєте ви, що предмет можна закрити без знань?\n\n (Викладач систематично оцінює таким чином, що бали можна набрати без фактичних знань)'),
(24, 23, 0, 'Чи задоволені ви організацією дистанційного навчання цим викадачем?'),
(25, 24, 0, 'Чи варто, на вашу думку, продовжувати контракт цьому викладачу?'),

(26, NULL, 0, 'Опитування закінчено. Дякую!');


CREATE TABLE `User` (
                        `guid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                        `context` int UNSIGNED DEFAULT NULL,
                        `group_name` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `Teacher` (
                           `guid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                           `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `Subject` (
                           `guid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                           `title` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `Lecturer` (
                            `id` int UNSIGNED NOT NULL,
                            `teacher` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                            `subject` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                            `user` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                            `main` tinyint(1) DEFAULT NULL,
                            `evaluation` tinyint(1) DEFAULT NULL,
                            `distance` tinyint(1) DEFAULT NULL,
                            `punctuality` int UNSIGNED DEFAULT NULL,
                            `objectivity` int UNSIGNED DEFAULT NULL,
                            `politeness` int UNSIGNED DEFAULT NULL,
                            `relevance` int UNSIGNED DEFAULT NULL,
                            `exams` int UNSIGNED DEFAULT NULL,
                            `lecture` int UNSIGNED DEFAULT NULL,
                            `knowledge` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `Practician` (
                              `id` int UNSIGNED NOT NULL,
                              `teacher` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                              `subject` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                              `user` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                              `main` tinyint(1) DEFAULT NULL,
                              `evaluation` tinyint(1) DEFAULT NULL,
                              `distance` tinyint(1) DEFAULT NULL,
                              `punctuality` int UNSIGNED DEFAULT NULL,
                              `objectivity` int UNSIGNED DEFAULT NULL,
                              `politeness` int UNSIGNED DEFAULT NULL,
                              `conformity` int UNSIGNED DEFAULT NULL,
                              `practice` int UNSIGNED DEFAULT NULL,
                              `knowledge` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `Message`
    ADD PRIMARY KEY (`id`),
 ADD KEY `parent` (`parent`);

ALTER TABLE `User`
    ADD PRIMARY KEY (`guid`),
 ADD KEY `context` (`context`);

ALTER TABLE `Teacher`
    ADD PRIMARY KEY (`guid`);

ALTER TABLE `Subject`
    ADD PRIMARY KEY (`guid`);

ALTER TABLE `Lecturer`
    ADD PRIMARY KEY (`id`),
 ADD KEY `user` (`user`),
 ADD KEY `teacher` (`teacher`),
 ADD KEY `subject` (`subject`);

ALTER TABLE `Practician`
    ADD PRIMARY KEY (`id`),
 ADD KEY `user` (`user`),
 ADD KEY `teacher` (`teacher`),
 ADD KEY `subject` (`subject`);

ALTER TABLE `Lecturer`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `Practician`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `Message`
    MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 40;

ALTER TABLE `Message`
    ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `Message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `User`
    ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`context`) REFERENCES `Message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Lecturer`
    ADD CONSTRAINT `Lecturer_ibfk_1` FOREIGN KEY (`user`) REFERENCES `User` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `Lecturer_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `Teacher` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `Lecturer_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `Subject` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Practician`
    ADD CONSTRAINT `Practician_ibfk_1` FOREIGN KEY (`user`) REFERENCES `User` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `Practician_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `Teacher` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE,
 ADD CONSTRAINT `Practician_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `Subject` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;



