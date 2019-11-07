<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace App\Modules\Users\Models;

use Phalcon\Mvc\Model;

class UserPageComments extends Model
{
    /**
     * @var int
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;
    /**
     * @var int
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $user_page_id;
    /**
     * @var string
     * @Column(type="varchar", length=255, default='', nullable=false)
     */
    protected $author;
    /**
     * @var string|null
     * @Column(type="mediumtext", default='', nullable=false)
     */
    protected $message;
    /**
     * @var int
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $rating;
    /**
     * @var string
     * @Column(type="datetime", default='0000-00-00 00:00:00', nullable=false)
     */
    protected $created_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserPageComments
     */
    public function setId(int $id): UserPageComments
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserPageId(): int
    {
        return $this->user_page_id;
    }

    /**
     * @param int $user_page_id
     * @return UserPageComments
     */
    public function setUserPageId(int $user_page_id): UserPageComments
    {
        $this->user_page_id = $user_page_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return UserPageComments
     */
    public function setAuthor(string $author): UserPageComments
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return UserPageComments
     */
    public function setMessage(string $message): UserPageComments
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     * @return UserPageComments
     */
    public function setRating(int $rating): UserPageComments
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     * @return UserPageComments
     */
    public function setCreatedAt(string $created_at): UserPageComments
    {
        $this->created_at = $created_at;
        return $this;
    }

}
