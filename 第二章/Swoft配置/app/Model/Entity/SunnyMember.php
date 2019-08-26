<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class SunnyMember
 *
 * @since 2.0
 *
 * @Entity(table="sunny_member")
 */
class SunnyMember extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 
     *
     * @Column()
     *
     * @var string|null
     */
    private $username;

    /**
     * 密码
     *
     * @Column()
     *
     * @var string|null
     */
    private $passwd;

    /**
     * 查看次数
     *
     * @Column()
     *
     * @var int|null
     */
    private $views;


    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string|null $username
     *
     * @return void
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string|null $passwd
     *
     * @return void
     */
    public function setPasswd(?string $passwd): void
    {
        $this->passwd = $passwd;
    }

    /**
     * @param int|null $views
     *
     * @return void
     */
    public function setViews(?int $views): void
    {
        $this->views = $views;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string|null
     */
    public function getPasswd(): ?string
    {
        return $this->passwd;
    }

    /**
     * @return int|null
     */
    public function getViews(): ?int
    {
        return $this->views;
    }

}
