<?php

namespace RedefineLab\Benchmark;

class Benchmark
{

    const START = 'START';
    const STOP = 'STOP';

    private $defaultTimerName;
    private $timers;

    public function __construct($defaultTimerName = 'default')
    {
        $this->defaultTimerName = $defaultTimerName;
        $this->timers = array();
    }

    public function start($timerName = null)
    {
        $this->timers[$this->getTimerName($timerName)][self::START] = $this->getTime();
        $this->timers[$this->getTimerName($timerName)][self::STOP] = null;
    }

    public function stop($timerName = null)
    {
        $this->timers[$this->getTimerName($timerName)][self::STOP] = $this->getTime();
    }

    public function reset($timerName = null)
    {
        $this->timers[$this->getTimerName($timerName)] = array();
    }

    public function getInterval($timerName = null)
    {
        $timerName = $this->getTimerName($timerName);

        if (!array_key_exists($timerName, $this->timers))
        {
            return null;
        }

        if (!array_key_exists(self::START, $this->timers[$timerName]) || !array_key_exists(self::STOP, $this->timers[$timerName]))
        {
            return null;
        }

        return $this->timers[$timerName][self::STOP] - $this->timers[$timerName][self::START];
    }

    private function getTimerName($timerName)
    {
        return $timerName ? : $this->defaultTimerName;
    }

    private function getTime()
    {
        return microtime(true);
    }

}

