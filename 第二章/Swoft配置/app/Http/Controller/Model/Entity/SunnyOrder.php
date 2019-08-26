<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 订单管理
 * Class SunnyOrder
 *
 * @since 2.0
 *
 * @Entity(table="sunny_order")
 */
class SunnyOrder extends Model
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
     * 所属用户
     *
     * @Column()
     *
     * @var int|null
     */
    private $member;

    /**
     * 订单编号
     *
     * @Column(name="order_number", prop="orderNumber")
     *
     * @var string|null
     */
    private $orderNumber;

    /**
     * 商品id
     *
     * @Column(name="good_id", prop="goodId")
     *
     * @var int|null
     */
    private $goodId;

    /**
     * 独立订单号
     *
     * @Column()
     *
     * @var string|null
     */
    private $combining;

    /**
     * 下单时间
     *
     * @Column()
     *
     * @var int|null
     */
    private $addtime;

    /**
     * 订单状态
     *
     * @Column()
     *
     * @var int|null
     */
    private $status;

    /**
     * 订单价格
     *
     * @Column(name="order_price", prop="orderPrice")
     *
     * @var float|null
     */
    private $orderPrice;

    /**
     * 支付方式
     *
     * @Column()
     *
     * @var string|null
     */
    private $method;

    /**
     * 商品价格
     *
     * @Column(name="good_price", prop="goodPrice")
     *
     * @var float|null
     */
    private $goodPrice;

    /**
     * 购买数量
     *
     * @Column(name="good_count", prop="goodCount")
     *
     * @var int|null
     */
    private $goodCount;

    /**
     * 总订单id
     *
     * @Column()
     *
     * @var int|null
     */
    private $pid;

    /**
     * 类型
     *
     * @Column()
     *
     * @var string|null
     */
    private $type;

    /**
     * 付款价格
     *
     * @Column(name="payable_price", prop="payablePrice")
     *
     * @var float|null
     */
    private $payablePrice;

    /**
     * 付款时间
     *
     * @Column()
     *
     * @var int|null
     */
    private $paytime;


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
     * @param int|null $member
     *
     * @return void
     */
    public function setMember(?int $member): void
    {
        $this->member = $member;
    }

    /**
     * @param string|null $orderNumber
     *
     * @return void
     */
    public function setOrderNumber(?string $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @param int|null $goodId
     *
     * @return void
     */
    public function setGoodId(?int $goodId): void
    {
        $this->goodId = $goodId;
    }

    /**
     * @param string|null $combining
     *
     * @return void
     */
    public function setCombining(?string $combining): void
    {
        $this->combining = $combining;
    }

    /**
     * @param int|null $addtime
     *
     * @return void
     */
    public function setAddtime(?int $addtime): void
    {
        $this->addtime = $addtime;
    }

    /**
     * @param int|null $status
     *
     * @return void
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @param float|null $orderPrice
     *
     * @return void
     */
    public function setOrderPrice(?float $orderPrice): void
    {
        $this->orderPrice = $orderPrice;
    }

    /**
     * @param string|null $method
     *
     * @return void
     */
    public function setMethod(?string $method): void
    {
        $this->method = $method;
    }

    /**
     * @param float|null $goodPrice
     *
     * @return void
     */
    public function setGoodPrice(?float $goodPrice): void
    {
        $this->goodPrice = $goodPrice;
    }

    /**
     * @param int|null $goodCount
     *
     * @return void
     */
    public function setGoodCount(?int $goodCount): void
    {
        $this->goodCount = $goodCount;
    }

    /**
     * @param int|null $pid
     *
     * @return void
     */
    public function setPid(?int $pid): void
    {
        $this->pid = $pid;
    }

    /**
     * @param string|null $type
     *
     * @return void
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param float|null $payablePrice
     *
     * @return void
     */
    public function setPayablePrice(?float $payablePrice): void
    {
        $this->payablePrice = $payablePrice;
    }

    /**
     * @param int|null $paytime
     *
     * @return void
     */
    public function setPaytime(?int $paytime): void
    {
        $this->paytime = $paytime;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getMember(): ?int
    {
        return $this->member;
    }

    /**
     * @return string|null
     */
    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    /**
     * @return int|null
     */
    public function getGoodId(): ?int
    {
        return $this->goodId;
    }

    /**
     * @return string|null
     */
    public function getCombining(): ?string
    {
        return $this->combining;
    }

    /**
     * @return int|null
     */
    public function getAddtime(): ?int
    {
        return $this->addtime;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return float|null
     */
    public function getOrderPrice(): ?float
    {
        return $this->orderPrice;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @return float|null
     */
    public function getGoodPrice(): ?float
    {
        return $this->goodPrice;
    }

    /**
     * @return int|null
     */
    public function getGoodCount(): ?int
    {
        return $this->goodCount;
    }

    /**
     * @return int|null
     */
    public function getPid(): ?int
    {
        return $this->pid;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return float|null
     */
    public function getPayablePrice(): ?float
    {
        return $this->payablePrice;
    }

    /**
     * @return int|null
     */
    public function getPaytime(): ?int
    {
        return $this->paytime;
    }

}
