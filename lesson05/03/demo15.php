<?php

namespace lesson05\player\demo15;

class DiscException extends \RuntimeException
{

}

class Event
{
    /** @var Player */
    public $sender;

    public function __construct($sender)
    {
        $this->sender = $sender;
    }
}

class PlayStartEvent extends Event
{
    public $track;

    public function __construct(Player $sender, $track)
    {
        $this->track = $track;
        parent::__construct($sender);
    }
}

class Disc
{
    private $tracks = [];

    public function __construct(array $tracks)
    {
        $this->tracks = $tracks;
    }

    public function getTrack($id)
    {
        if (!isset($this->tracks[$id - 1])) {
            throw new \OutOfBoundsException('Трек не найдет');
        }
        return $this->tracks[$id-1];
    }

    public function getTracksCount()
    {
        return count($this->tracks);
    }
}

class Player
{
    const STATE_STOP = 0;
    const STATE_START = 1;
    const STATE_PLAY = 2;

    const EVENT_PALY_START = 'playStart';
    const EVENT_DISC_COMPLETE = 'discComplete';

    private $listeners = [];

    /** @var Disc */
    private $disc;

    private $currentTrack;
    private $track;
    private $volume = 5;
    private $state;

    // добавляем слушателя
    public function on($name, $callback)
    {
        $this->listeners[$name][] = $callback;
    }

    // удаляем слушателя
    public function off($name, $callback)
    {
        if (isset($this->listeners[$name])) {
            foreach ($this->listeners[$name] as $i => $listener) {
                if ($listener === $callback) {
                    unset($this->listeners[$name][$i]);
                }
            }
        }
    }

    private function trigger($name, Event $event)
    {
        if (isset($this->listeners[$name])) {
            foreach ($this->listeners[$name] as $listener) {
                call_user_func($listener, $event);
            }
        }
    }

    public function insert(Disc $disc)
    {
        $this->disc = $disc;
    }

    public function play()
    {
        if (empty($this->disc)) {
            throw new DiscException('Вставьте диск');
        }

        if (empty($this->track)) {
            $this->track = 1;
        }

        $this->currentTrack = $this->disc->getTrack($this->track);
        $this->state = self::STATE_START;

        // дёргаем события `старт воспроизведения`
        $this->trigger(self::EVENT_PALY_START, new PlayStartEvent($this, $this->track));
    }

    public function stop()
    {
        $this->state = self::STATE_STOP;
    }

    public function prev()
    {
        $newTrack = $this->track - 1;
        if ($newTrack < 1) {
            throw new \LogicException('Первый трек');
        }
        $this->changeTrack($newTrack);
    }

    public function next()
    {
        $newTrack = $this->track + 1;
        if ($newTrack < $this->disc->getTracksCount()) {
            $this->changeTrack($newTrack);
        } else {
            // Диск завершён!
            $this->trigger(self::EVENT_DISC_COMPLETE, new Event($this));
        }
    }


    public function getVolume()
    {
        return $this->volume;
    }

    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    private function changeTrack($newTrack)
    {
        if ($this->state === self::STATE_PLAY) {
            $this->stop();
            $this->track = $newTrack;
            $this->play();
        } else {
            $this->track = $newTrack;
        }
    }
}






$player = new Player();
$player->insert(new Disc(['Track 1', 'Track 2', 'Track 3']));

$player->on(Player::EVENT_PALY_START, function (PlayStartEvent $event) {
    echo 'Начало воспроизведения' . PHP_EOL;
});

$player->on(Player::EVENT_PALY_START, function (PlayStartEvent $event) {
    echo '#' . $event->track . ': ' . $event->sender->getCurrentTrack() . PHP_EOL;
});

$player->on(Player::EVENT_DISC_COMPLETE, function (PlayStartEvent $event) {
    echo 'Диск завершён.' . PHP_EOL;
});


$player->play();
$player->next();
$player->next();
$player->next();
$player->stop();
$player->prev();





































