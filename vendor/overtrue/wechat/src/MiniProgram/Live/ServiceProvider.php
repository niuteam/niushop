<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\MiniProgram\Live;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['live'] = function ($app) {
            return new Live($app);
        };

        $app['live.goods'] = function ($app) {
            return new GoodsClient($app);
        };

        $app['live.room'] = function ($app) {
            return new RoomClient($app);
        };
    }
}
