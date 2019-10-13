<?php
/**
 * Bulletin Board Project @ 2019
 * @author Daniil Savin
 */

namespace BulletinBoardProject\Models;

interface UserInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @return string
     */
    public function getFirstName(): string;

}
