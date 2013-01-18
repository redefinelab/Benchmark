<?php

namespace RedefineLab\Benchmark;

class BenchmarkSilexServiceProvider implements \Silex\ServiceProviderInterface
{

    public function boot(\Silex\Application $app)
    {
        // Nothing to do here
    }

    public function register(\Silex\Application $app)
    {
        $app['uuid'] = $app->share(function () use ($app) {
            return new Benchmark();
        });
    }

}