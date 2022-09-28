<?php

namespace app\core;

abstract class Model {
    protected $callback;

    public function callback($callback = null): ?string {
        if ($callback) {
            $this->callback = $callback;
            return null;
        }
        $callback = $this->callback;
        unset($this->callback);
        return $callback;
    }
}
