<?php declare(strict_types=1);

namespace App\Http\Controller;

use App\Model\Entity\SunnyMember;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Throwable;

/**
 * Class HomeController
 * @Controller()
 */
class HomeController
{

    /**
     * @RequestMapping("/")
     * @throws Throwable
     */
    public function index(): Response
    {
        $data = SunnyMember::find(1)->toArray();
        return \context()->getResponse()->withData($data);
    }

}
