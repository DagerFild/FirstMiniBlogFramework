<?php

    namespace MyProject\Models\Articles;

    use MyProject\Exceptions\InvalidArgumentException;
    use MyProject\Models\ActiveRecordEntity;
    use MyProject\Models\Users\User;
    use MyProject\Services\Db;

    class Article extends ActiveRecordEntity
    {

        /** @var string */
        protected $name;

        /** @var string */
        protected $text;

        /** @var int */
        protected $authorId;

        /** @var string */
        protected $createdAt;

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getText(): string
        {
            return $this->text;
        }

        /**
         * @return User
         */
        public function getAuthor(): User
        {
            return User::getById($this->authorId);
        }

        /**
         * @param $name
         */
        public function setName($name): void
        {
            $this->name = $name;
        }

        /**
         * @param $text
         */
        public function setText($text): void
        {
            $this->text = $text;
        }

        /**
         * @param User $author
         */
        public function setAuthor(User $author): void
        {
            $this->authorId = $author->getId();
        }

        public function getParsedText(): string
        {
            return (new \Parsedown())->text($this->getText());
        }

        /**
         * @return Article[]
         */
        public static function getPageBefore(int $id, int $limit): array
        {
            $db = Db::getInstance();
            $sql = sprintf('SELECT * FROM (SELECT * FROM '.self::getTableName().' WHERE id > :id ORDER BY id ASC LIMIT %d) as articles ORDER BY id DESC;', $limit);
            return $db->query($sql, ['id' => $id], self::class);
        }

        /**
         * @return Article[]
         */
        public static function getPageAfter(int $id, int $limit): array
        {
            $db = Db::getInstance();
            $sql = sprintf('SELECT * FROM '.self::getTableName().' WHERE id < :id ORDER BY id DESC LIMIT %d;', $limit);
            return $db->query($sql, ['id' => $id], self::class);
        }

        public static function hasNextPage(int $pageLastId): bool
        {
            $db = Db::getInstance();
            $sql = 'SELECT id FROM '.self::getTableName().' WHERE id < :id LIMIT 1;';
            $result = $db->query($sql, ['id' => $pageLastId]);
            return !empty($result);
        }

        public static function hasPreviousPage(int $pageFirstId): bool
        {
            $db = Db::getInstance();
            $sql = 'SELECT id FROM '.self::getTableName().' WHERE id > :id LIMIT 1;';
            $result = $db->query($sql, ['id' => $pageFirstId]);
            return !empty($result);
        }

        public static function getLastID(): ?int
        {
            $db = Db::getInstance();
            $sql = 'SELECT id FROM '.self::getTableName().' ORDER BY id DESC LIMIT 1;';
            $result = $db->query($sql);
            return !empty($result) ? $result[0]->id : null;
        }

        public static function createFromArray(
          array $fields,
          User $author
        ): Article {
            if (empty($fields['name'])) {
                throw new InvalidArgumentException(
                  'Не передано название статьи'
                );
            }

            if (empty($fields['text'])) {
                throw new InvalidArgumentException('Не передан текст статьи');
            }


            $article = new Article();

            $article->setAuthor($author);
            $article->setName($fields['name']);
            $article->setText($fields['text']);

            $article->save();

            return $article;
        }

        public function updateFromArray(array $fields): Article
        {
            if (empty($fields['name'])) {
                throw new InvalidArgumentException(
                  'Не передано название статьи'
                );
            }

            if (empty($fields['text'])) {
                throw new InvalidArgumentException('Не передан текст статьи');
            }

            $this->setName($fields['name']);
            $this->setText($fields['text']);

            $this->save();

            return $this;
        }

        protected static function getTableName(): string
        {
            return 'articles';
        }

    }