<?php

namespace Gus\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Gus\Foundation\Observer;
use LogicException;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $kernels = $this->getObserverKernels();
        foreach ($kernels as $kernel) {
            if ( ! class_exists($kernel)) {
                continue;
            }

            $observers = $kernel::observers();

            foreach ($observers as $model => $observer) {
                if ( ! (new $observer) instanceof Observer)
                    throw new LogicException(
                        'The observer: '.$observer.' must implements '.Observer::class
                    );

                $model::observe($observer);
            }
        }
    }

    /**
     * @return array
     */
    private function getObserverKernels()
    {
        $kernels = config('gus_foundation.observer.kernel');
        if (is_string($kernels)) $kernels = [$kernels];
        return $kernels;
    }
}
