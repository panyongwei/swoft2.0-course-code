<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 用户信息
 * Class SunnyMemberInfo
 *
 * @since 2.0
 *
 * @Entity(table="sunny_member_info")
 */
class SunnyMemberInfo extends Model
{
    /**
     * 
     * @Id(incrementing=false)
     * @Column()
     *
     * @var int
     */
    private $user;

    /**
     * 
     *
     * @Column()
     *
     * @var string|null
     */
    private $nickname;


    /**
     * @param int $user
     *
     * @return void
     */
    public function setUser(int $user): void
    {
        $this->user = $user;
    }

    /**
     * @param string|null $nickname
     *
     * @return void
     */
    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return int
     */
    public function getUser(): ?int
    {
        return $this->user;
    }

    /**
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

}
